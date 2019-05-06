<?php

namespace app\database;
use PDO;

class Conexao{

    private $host = 'localhost';
    private $user = 'root' ;
    private $password = '';
    private $database = 'ubipri';


    public function conectar(){
        try{

            $con = 'mysql:host='.$this->host.';dbname='.$this->database.';charset=utf8';
            $pdo = new PDO ($con, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $pdo;

        }catch(PDOException $erro){
            return $erro->getMessage();
        }
    }



}