<?php
require("./inc/functions.php");

function registerUser($uname, $pw){
    $db = createSqliteConnection();

    $pw = password_hash($pw, PASSWORD_DEFAULT);

    $sql = "INSERT INTO kayttaja (knimi, salasana) VALUES (?,?)";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname, $pw));
}

function checkUser($uname, $pw){
    $db = createSqliteConnection();

    $sql = "SELECT salasana FROM kayttaja WHERE knimi=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($uname));

    $hashedpw = $statement->fetchColumn();

    if(isset($hashedpw)){
        return password_verify($pw, $hashedpw) ? $uname : null;
    }
    return null;
}
