<?php
session_start();
require('./inc/functions.php');
require('./headers.php');

if(!isset($_SESSION['knimi'])){
    http_response_code(403);
    echo "Ei oikeuksia";
    return;
}

$db = null;

$input = json_decode(file_get_contents('php://input'));
$name = filter_var($input->name,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

