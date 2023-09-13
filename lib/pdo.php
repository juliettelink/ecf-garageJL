<?php

try
{
    $pdo = new PDO("mysql:dbname="._DB_NAME_.";host="._DB_SERVER_.";charset=utf8mb4", _DB_USER_, _DB_PASSSWORD_);
    echo "COnnexion à la base de donnée réussie!";
}
catch (Exception $e)
{
    die('Erreur : ' .$e->getMessage());
}