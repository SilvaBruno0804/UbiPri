<?php
if (!$login->login_check()) {
    header("Location:" . VIEW . "login/logar");
    exit;
}