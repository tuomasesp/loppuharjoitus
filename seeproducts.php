<?php
require_once './inc/functions.php';
require_once './headers.php';

$uri = parse_url(filter_input(INPUT_SERVER,'PATH_INFO'),PHP_URL_PATH);
$parameters = explode('/',$uri);
$category_id = $parameters[1];

try {
    $db = createSqliteConnection("./verkkokauppa.db");
    $sql = "select * from tuoteryhma where id = $category_id";
    $query = $db->query($sql);
    $category = $query->fetch(PDO::FETCH_ASSOC);

    $sql = "select * from tuote where tuoteryhmaid = $category_id";
    $query = $db->query($sql);
    $products = $query->fetchAll(PDO::FETCH_ASSOC);

    header('HTTP/1.1 200 OK');
    echo json_encode(array(
        "category" => $category['trnimi'],
        "products" => $products
    ));
}

catch (PDOException $pdoex) {
    returnError($pdoex);
}