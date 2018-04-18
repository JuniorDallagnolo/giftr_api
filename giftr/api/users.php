<?php
//giftr_api/api/users RESOURCE

//ERROR REPORTING
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../includes/class_Response.php";
require_once "../includes/inc_dblink.php";

$resp = null;
$httpMethod = $_SERVER['REQUEST_METHOD'];

//POST REGISTERS USER AND GET CHECK THEM WITH A DEVICE_ID QUERY STRING
switch ($httpMethod) {

    case 'POST':
        include "../includes/inc_usersPOST.php";
        break;

    case 'GET':
        include "../includes/inc_usersGET.php";
        break;

    default:
        $resp = new Response(405, array(), 'Method Not Allowed: Use POST for registration or GET with a device_id as a QUERY_STRING');
        break;
}

//CLOSE THE DATABASE LINK AND SEND RESPONSE
$pdo_link = null;
$resp->send();

