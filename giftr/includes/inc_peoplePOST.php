<?php
//CHECK AND VALIDATE THE PARAMETERS PASSED
require_once "inc_personValidation.php";

//IF THERE IS NOT A MESSAGE IT'S BECAUSE THE DATA IS VALID THEN DO THE INSERT -
// NOTE THE ! ELSE IT WILL GO OUT AND DISPLAY MESSAGE ON THE PEOPLE CONTROLLER
if (!$resp) {
    try {
        $sql = "INSERT INTO people (user_id , person_dob, person_name ) VALUES ('$user_id','$dob','$name')";
        $rs = $pdo_link->prepare($sql);
        $rs->execute();

        $data = array(
            "person_id" => $pdo_link->lastInsertId(),
            "person_name" => $name,
            "person_dob" => $dob
        );
        $resp = new Response(201, $data, 'Person Added');

    } catch (Exception $e) {
        $resp = new Response(500, array($e), 'Internal Server Error');
    }
}

