<?php

function verifyUserLoginPassword(PDO $pdo, string $email, string $password):array|bool
{
    $query = $pdo->prepare("SELECT u.*, r.name AS role_name
                            FROM users u
                            INNER JOIN users_role ur ON u.mail_id = ur.mail_id
                            INNER JOIN role r ON ur.role_id = r.role_id
                            WHERE u.mail_id = :email");
    $query->bindValue(":email", $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    return $user;

    if($user && password_verify($password, $user["password"])){
        return $user;
    } else {
        return false;
    }
    
}

