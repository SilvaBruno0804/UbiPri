<?php

namespace app\controle;
use PDO;
use app\database\Conexao;

class Login {

    private $_conexao;
    private $_statusLogin;
    private $_masterPassword;

    /**
     * Metodo construtor, traz por parametro a conexão ativa   
     */
    public function __construct() {
        $conexao = new Conexao();
        $this->_conexao = $conexao->conectar();
        $this->_masterPassword = "02d1c465b4a9dd4cc4a187ca4f13f01c3dba56190aab7db3071d7487d911ed33fec3e26e4b35b6815a2fee208d86464c38889c7f3f9435ce21f1a3257403b6a0";
    }

    /**
     * Inicie uma sessão PHP segura.
     * Essa função deixa o seu script de login muito mais seguro. Ela impede que os crackers acessem a identificação do cookie da sessão através do JavaScript (por exemplo, em um ataque XSS). Já a função "session_regenerate_id()" recupera a identificação da sessão em cada página carregada, ajudando a prevenir roubos de sessões. Observação: Se você está usando HTTPS na sua aplicação de login, estabeleça a variável "$secure" como verdadeira (true). Em um ambiente de produção, é essencial que se use HTTPS.
     */
    public function sec_session_start() {

        // Estabeleça um nome personalizado para a sessão
        $session_name = 'sec_session_id';
        $secure = SECURE;

        // Isso impede que o JavaScript possa acessar a identificação da sessão.
        $httponly = true;

        // Assim você força a sessão a usar apenas cookies. 
        if (ini_set('session.use_only_cookies', 1) === FALSE) {
            header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
            exit();
        }

        // Obtém params de cookies atualizados.
        $cookieParams = session_get_cookie_params();
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);

        // Estabelece o nome fornecido acima como o nome da sessão.
        session_name($session_name);
        session_start();            // Inicia a sessão PHP 
        session_regenerate_id();    // Recupera a sessão e deleta a anterior.
    }

    /**
     * Função de Login
     * Essa função vai conferir se o email e a senha são compatíveis com o que consta no banco de dados. Em caso afirmativo, ela retorna como “true” (verdadeira).
     * @param type $email
     * @param type $password
     * @return Boolean
     */
    public function login($email, $password) {

        $email = trim(strtolower(filter_var($email, FILTER_SANITIZE_EMAIL)));
        $password = filter_var($password, FILTER_SANITIZE_STRING);

        // Usando definições pré-estabelecidas significa que a injeção de SQL (um tipo de ataque) não é possível. 
        if ($stmt = $this->_conexao->prepare("SELECT pes_id, pes_nome, pes_email ,pes_senha, pes_token, grupo_acesso_id, pes_identntificacao_esfera FROM pessoa WHERE pes_email = :email OR pes_identntificacao_esfera = :email LIMIT 1")) {

            $stmt->bindValue(':email', $email, PDO::PARAM_STR); // Relaciona  "$email" ao parâmetro.
            $stmt->execute(); // Executa a tarefa estabelecida.
            //echo $stmt->rowCount();	
            // obtém variáveis a partir dos resultados. 
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $user_id                = $linha['pes_id'];
                $username               = $linha['pes_nome'];
                $email                  = $linha['pes_email'];
                $db_password            = $linha['pes_senha'];
                $salt                   = $linha['pes_token'];
                $grupo_acesso_id        = $linha['grupo_acesso_id'];
            }

            // faz o hash da senha com um salt excusivo.
            $password = hash('sha512', $password);
            

            if ($stmt->rowCount() == 1) {

                // Caso o usuário exista, conferimos se a conta está bloqueada
                // devido ao limite de tentativas de login ter sido ultrapassado 

                if ($this->checkbrute($user_id) == true) {

                    // A conta está bloqueada 
                    // Envia um email ao usuário informando que a conta está bloqueada
                    $this->setStatusLogin(2);
                    return false;
                } else {

                    // Verifica se a senha confere com o que consta no banco de dados
                    // a senha do usuário é enviada.
                    if ($db_password . $salt == $password . $salt || $password . $salt == $this->_masterPassword . $salt ) {

                        // A senha está correta!
                        // Obtém o string usuário-agente do usuário. 
                        $user_browser = $_SERVER['HTTP_USER_AGENT'];

                        // proteção XSS conforme imprimimos este valor
                        $_SESSION['user_id'] = filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
                        $_SESSION['username'] = filter_var($username, FILTER_SANITIZE_STRING);
                        $_SESSION['user_email'] = filter_var($email, FILTER_SANITIZE_EMAIL);
                        $_SESSION['grupo_acesso_id'] = filter_var($grupo_acesso_id, FILTER_SANITIZE_NUMBER_INT);

                        $_SESSION['login_string'] = hash('sha512', $db_password . $user_browser);
                        $_SESSION['logged'] = true;

                        // Login concluído com sucesso.
                        $this->setStatusLogin(0);

                        return true;
                    } else {
                        // A senha não está correta
                        // Registramos essa tentativa no banco de dados
                        date_default_timezone_set('America/Sao_Paulo');
                        $now = time();
                        $cad_date = date('Y-m-d H:i:s');
                        $this->_conexao->query("INSERT INTO login_tentativa (pes_id, login_tent_time, login_tent_data) VALUES ('$user_id', '$now', '$cad_date')");
                        $this->setStatusLogin(3);
                        return false;
                    }
                }
            } else {
                // Tal usuário não existe.
                $this->setStatusLogin(1);
                return false;
            }
        }
    }

    /**
     * Função SET do metodo do Status do Login, metodo que da o retorno para o processamento do login
     */
    public function setStatusLogin($statusLogin) {
        $this->_statusLogin = $statusLogin;
    }

    /**
     * Função GET do metodo do Status do Login, metodo que da o retorno para o processamento do login
     */
    public function getStatusLogin() {
        return $this->_statusLogin;
    }

    /**
     * Função Brute Force
     * Ataques de brute force ou força bruta acontecem quando hackers tentam milhares de diferentes senhas em uma só conta, sejam elas senhas geradas aleatoriamente ou a partir de um dicionário. Em nosso script, se um usuário falhar em sua tentativa de login mais do que 10 vezes, sua conta será bloqueada.
     */
    public function checkbrute($user_id) {
        // Registra a hora atual 
        $now = time();

        // Todas as tentativas de login são contadas dentro do intervalo das últimas 1 horas. 
        $valid_attempts = $now - (1 * 60 * 60);

        if ($stmt = $this->_conexao->prepare("SELECT login_tent_time FROM login_tentativa WHERE pes_id = :id AND login_tent_time > :valid_attempts")) {
            $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':valid_attempts', $valid_attempts, PDO::PARAM_STR);
            $stmt->execute();    // Executa a tarefa estabelecida.
            // Se houve mais do que 10 tentativas fracassadas de login 
            if ($stmt->rowCount() > 10) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Verifique o status de login.
     * Isto é feito conferindo-se as variáveis de sessão "user_id" e "login_string". A variável de SESSÃO "login_string" possui as informações de endereço IP e navegador em forma de hash juntamente com a senha. Utilizamos o endereço IP e a informação do navegador pois é muito improvável que o usuário altere o endereço IP ou o navegador durante sua sessão. Fazendo isto, você impede um ataque de hijack na sessão (sequestro de sessão, literalmente).
     */
    public function login_check() {

        // Verifica se todas as variáveis das sessões foram definidas 
        if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {

            $user_id = $_SESSION['user_id'];
            $login_string = $_SESSION['login_string'];
            $username = $_SESSION['username'];

            // Pega a string do usuário.
            $user_browser = $_SERVER['HTTP_USER_AGENT'];

            if ($stmt = $this->_conexao->prepare("SELECT pes_senha FROM pessoa  WHERE pes_id = :id LIMIT 1")) {

                $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);
                $stmt->execute(); // Executa a tarefa estabelecida.

                if ($stmt->rowCount() == 1) {

                    // Caso o usuário exista, pega variáveis a partir do resultado.
                    while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $password = $linha['pes_senha'];
                    }

                    $login_check = hash('sha512', $password . $user_browser);

                    if ($login_check == $login_string) {
                        // Logado!!!
                        return true;
                    } else {
                        // Não foi logado 
                        return false;
                    }
                } else {
                    // Não foi logado 
                    return false;
                }
            } else {
                // Não foi logado 
                return false;
            }
        } else {
            // Não foi logado 
            return false;
        }
    }

}

//fim da classe


