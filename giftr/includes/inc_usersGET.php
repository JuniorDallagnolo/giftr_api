<?php

//CHECK THE PARAMETER FIELD IS OK
if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {

    //GET THE PARAMETER INTO A VARIABLE
    parse_str($_SERVER['QUERY_STRING'], $query);
    $device_id = $query['device_id'];

    try {
        $sql = "SELECT * FROM users WHERE user_device_id = '$device_id' LIMIT 1";
        $rs = $pdo_link->prepare($sql);
        $rs->execute();

        //Check if the user is on the database
        if ($rs->rowCount() == 1) {
            $match = $rs->fetch();
            $data = array(
                "user_id" => $match['user_id'],
                "token" => $match['user_token']);
            $resp = new Response(200, $data, 'User Found');

        } else {
            $resp = new Response(404, array(), 'User Not Found: Use POST with a device_id on body to register');
        }

    } catch (Exception $e) {
        $resp = new Response(500, array($e), 'Internal Server Error');
    }

} else {
    $resp = new Response(400, array(), 'Missing Required Parameter: device_id as a QUERY_STRING');
}

