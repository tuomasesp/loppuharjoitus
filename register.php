<?php
require './headers.php';
session_start();
require ('./db_user_controller.php');

$body = file_get_contents("php://input");
$user = json_decode($body);

if(!isset($user->uname) || !isset($user->pw)){
    http_response_code("400");
    echo "User not defined. Give valid username and password";
    return;
}

registerUser($user->uname, $user->pw);

$_SESSION['knimi'] = $user->uname;

http_response_code(200);
echo "User ".$user->uname." registered"; 
