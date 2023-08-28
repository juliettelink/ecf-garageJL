<?php
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => _DOMAIN_,
    // 'secure' => true, a rajouter quand on deploie
    'httponly' => true
    ]);

session_start();

function adminOnly(){
    if (!isset($_SESSION['user'])){
        header('location : ../login.php');
    // }else if($_SESSION['user']['role_name'] !='administrator'){
    //     header('location : ../index.php');
    }
}