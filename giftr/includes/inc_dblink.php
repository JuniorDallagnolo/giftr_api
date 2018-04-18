<?php

//local connection
const DB_NAME = "giftr";
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASSWORD = "root";

const DSN = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;

try {

    $pdo_link = new PDO(DSN, DB_USER, DB_PASSWORD);

//turn off in prod
    $pdo_link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo_link->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch (PODException $exception) {
    echo $exception->getMessage();
}