<?php
require('./headers.php');
session_start();
require('./db_user_controller.php');

if(isset($_SESSION['knimi'])){
    http_response_code(200);
    echo $_SESSION['knimi'];
    return;
}

if(!isset($_POST['knimi']) || !isset($_POST['salasana'])){
    http_response_code(401);
    echo "Kirjautuminen ei onnistunut.";
    return;
}

$uname = $_POST['knimi'];
$pw = $_POST['salasana'];

$verified_uname = checkUser($uname, $pw);

if($verified_uname){
    $_SESSION["knimi"] = $verified_uname;
    http_response_code(200);
    echo $verified_uname;
}else{
    http_response_code(401);
    echo "Tarkista käyttäjätunnus ja salasana.";
}
