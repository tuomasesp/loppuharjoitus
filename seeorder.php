<?php
require('./headers.php');
session_start();

require("./db_user_controller.php");

if(!isset($_SESSION['käyttäjänimi'])){
    http_response_code(403);
    echo "Ei pääsyä tilaukseen";
    return;
}

try {
    $db = createSqliteConnection("./verkkokauppa.db");
    selectAsJson($db, 'select * from tilaus where asiakasnro=?');
} catch (PDOException $pdoex) {
    returnError($pdoex);
}

