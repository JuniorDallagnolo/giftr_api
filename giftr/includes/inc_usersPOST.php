<?php

//CHECK THE PARAMETER FIELD IS OK
if (isset($_POST['device_id']) && !empty($_POST['device_id'])) {

    $device_id = $_POST['device_id'];

    try {
        //CHECK IF THE USER IS ALREADY ON THE DATABASE
        $sql = "SELECT * FROM users WHERE user_device_id = ? LIMIT 1";
        $rs = $pdo_link->prepare($sql);
        $rs->execute(array($device_id));

        //IF THE USER IS REGISTERED ALREADY RETURN THE TOKEN AND ID BACK TO IT WITH THE GET METHOD, ELSE REGISTER IT
        if ($rs->rowCount() == 1) {
            $match = $rs->fetch();
            $data = array(
                "user_id" => $match['user_id'],
                "token" => $match['user_token']
            );
            $resp = new Response(200, $data, 'User Already Registered and TOKEN is still valid');

        } else {

            //GENERATE THE USER TOKEN
            $token = sha1(time() . $device_id);
            $username = isset($_POST['username']) ? $_POST['username'] : null;
            $password = isset($_POST['password']) ? $_POST['password'] : null;

            $sql = "INSERT INTO users( user_name, user_device_id, user_password, user_token) VALUES('$username','$device_id','$password','$token')";
            $rs = $pdo_link->prepare($sql);
            $rs->execute();

            $data = array(
                "user_id" => $pdo_link->lastInsertId(),
                "token" => $token
            );
            $resp = new Response(201, $data, 'User Added');
        }

    } catch (Exception $e) {
        $resp = new Response(500, array($e), 'Internal Server Error');
    }

} else {
    $resp = new Response(400, array(), 'Missing Required Parameter: device_id on the body request');
}
