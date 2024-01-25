<?php
session_set_cookie_params([
 'lifetime' => 3600,
 'path' => '/',
 'domain' => _DOMAIN_,
 // 'secure' => true, a rajouter quand on deploie
 'httponly' => true,
]);

session_start();


define('ROLE_EMPLOYE', 'employe');
define('ROLE_ADMINISTRATOR', 'administrator');

function adminOnly()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ../login.php');
    }else if($_SESSION['user']['role_name'] !== ROLE_ADMINISTRATOR){
        header('Location: ../admin/index.php');
 }
}

function employeAndAdmin()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ../login.php');
        exit();
    } else if ($_SESSION['user']['role_name'] !== ROLE_EMPLOYE && $_SESSION['user']['role_name'] !== ROLE_ADMINISTRATOR) {
        header('Location: ../admin/index.php');
        exit();
    }
}
