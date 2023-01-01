<?php
require_once './inc/functions.php';
require_once './headers.php';

try {
    $db = createSqliteConnection("./verkkokauppa.db");
    selectAsJson($db, 'select * from tuoteryhma');
} catch (PDOException $pdoex) {
    returnError($pdoex);
}