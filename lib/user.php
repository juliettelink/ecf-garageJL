<?php


function addUser(PDO $pdo, string $mail_id, string $name,  string $firstname,  string $password, $role ="employe"){
    //hach du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insérer l'employé dans la bdd
    $sqlInsertUser = "INSERT INTO users (mail_id, name, firstname, password) 
                        VALUES (:mail_id, :name, :firstname, :password)";
    
    $queryInsertUser = $pdo->prepare($sqlInsertUser);
    $queryInsertUser->bindValue(":mail_id", $mail_id, PDO::PARAM_STR);
    $queryInsertUser->bindValue(":name", $name, PDO::PARAM_STR);
    $queryInsertUser->bindValue(":firstname", $firstname, PDO::PARAM_STR);
    $queryInsertUser->bindValue(":password", $hashedPassword, PDO::PARAM_STR);
    $queryInsertUser->execute();



    // Récupérer l'ID du rôle à partir de son nom
    $sqlSelectRoleId = "SELECT role_id FROM role WHERE name = :role";

    $querySelectRoleId = $pdo->prepare($sqlSelectRoleId);
    $querySelectRoleId->bindValue(":role", $role, PDO::PARAM_STR);
    $querySelectRoleId->execute();
    $roleId = $querySelectRoleId->fetchColumn();

    // insere le rôle dans la table des users_role
    $sqlInsertUserRole = "INSERT INTO users_role (mail_id, role_id) 
                            VALUES (:mail_id, :role_id)";

    $queryInsertUserRole = $pdo->prepare($sqlInsertUserRole);
    $queryInsertUserRole->bindValue(":mail_id", $mail_id, PDO::PARAM_STR);
    $queryInsertUserRole->bindValue(":role_id", $roleId, PDO::PARAM_INT);
    $queryInsertUserRole->execute();
}


// fontion qui vérifie le mot de passe et lie les table users, role et users_role
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
    
 // verifie le mot de passe et le compare avec le hach
    if($user && password_verify($password, $user["password"])){
        return $user;
    } else {
        return false;
    }
    
}

