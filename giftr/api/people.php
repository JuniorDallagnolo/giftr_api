<?php
//giftr_api/api/people RESOURCE

//ERROR REPORTING
error_reporting(E_ALL);
ini_set('display_errors', 1);

$resp = null;
$user_id = null;

$httpMethod = $_SERVER['REQUEST_METHOD'];

require_once "../includes/class_Response.php";
require_once "../includes/inc_dblink.php";
require_once "../includes/inc_auth.php";

if($auth) {
    
    switch ($httpMethod) {
        case "GET":
            include "../includes/inc_peopleGET.php";
            break;
        case "POST":
            include "../includes/inc_peoplePOST.php";
            break;
        case "PUT":
            include "../includes/inc_peoplePUT.php";
            break;
        case "DELETE":
            include "../includes/inc_peopleDELETE.php";
            break;
        default:
            $resp = new Response(405, array(), 'Method Not Allowed');
    }
} else {
    $resp = new Response ( 401, array(), 'Unauthorized: Send a X-Api-Key parameter on the header to access resource');
}

//CLOSE THE DATABASE LINK AND SEND RESPONSE
$pdo_link = null;
$resp->send();