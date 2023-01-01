<?php
require_once './inc/functions.php';
session_start();
require_once './headers.php';

$db = null;

$input = json_decode(file_get_contents('php://input'));
$name = filter_var($input->name,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$address = filter_var($input->address,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$zip = filter_var($input->zip,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$city = filter_var($input->city,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$cart = $input->cart;

try {
    $db = createSqliteConnection("./verkkokauppa.db");
    $db->beginTransaction();

    $sql = "insert into asiakas (asiakasnimi,osoite,postinro,postitmp) values
    ('" .
        filter_var($name,FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "','" . 
        filter_var($address,FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "','" . 
        filter_var($zip,FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "','" . 
        filter_var($city,FILTER_SANITIZE_FULL_SPECIAL_CHARS) 
    .    "')";

    $customer_id = executeInsert($db,$sql);

    $sql = "insert into tilaus (asiakasnro) values ($customer_id)";
    $order_id = executeInsert($db,$sql);

    foreach ($cart as $product) {
        $sql = "insert into tilausrivi (tilausnro,tuotenro) values ("
        .
            $order_id . "," .
            $product
        .    ")";
        executeInsert($db,$sql);
    }

$db->commit();

header('HTTP/1.1 200 OK');
$data = array('id' => $customer_id);
echo json_encode($data);
}
catch (PDOException $pdoex) {
    $db->rollback();
    returnError($pdoex);
}