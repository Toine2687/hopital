<?php

require_once __DIR__ . '/../config/config.php';

// function connect()
// {
//     $db = new PDO(DSN, USER, PASSWORD);
//     $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    // var_dump($db);
//     return $db;
// }

function connect(){
    $instance = Singleton::getInstance();
    $db = $instance->sConnect();
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $db;
}