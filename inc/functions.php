<?php

function createSqliteConnection(){
    try{
        $dbcon = new PDO("sqlite:./verkkokauppa.db");
        return $dbcon;
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    return null;
}

function returnError(PDOException $pdoex) {
    echo header('HTTP/1.1 500 Internal Server Error');
    $error = array('error' => $pdoex->getMessage());
    echo json_encode($error);
    exit;
}

function selectAsJson(object $db,string $sql): void {
    $query = $db->query($sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    header('HTTP/1.1 200 OK');
    echo json_encode($results);
}

function executeInsert(object $db,string $sql): int {
    $query = $db->query($sql);  
    return $db->lastInsertId();
}