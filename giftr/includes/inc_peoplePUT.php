<?php
//TRANSFORMING PUT INTO A GLOBAL VARIABLE USING A STREAM CLASS TO READ RAW DATA
require_once "class_Stream.php";
$data = array();
new stream($data);
$_PUT = $data['post'];

//CHECK AND VALIDATE THE PARAMETERS PASSED
require_once "inc_personValidation.php";

//IF THERE IS NOT A MESSAGE IT'S BECAUSE THE DATA IS VALID THEN DO THE PUT
// NOTE THE ! ELSE IT WILL GO OUT AND DISPLAY MESSAGE ON THE PEOPLE CONTROLLER
if (!$resp) {
    //FIRST CHECK IF THERES ALREADY PERSON WITH THAT ID
    require_once "inc_personCheck.php";

    //IF THE PERSON IS FOUND EDIT IT, ELSE CREATE A NEW ENTRY
    if ($rowFound) {

        try {
            $sql = "UPDATE people SET person_name='$name', person_dob='$dob' WHERE person_id = '$pathParam' LIMIT 1";
            $rs = $pdo_link->prepare($sql);
            $rs->execute();

            $data = array(
                "person_id" => $pathParam,
                "person_name" => $rowFound['person_name'],
                "person_dob" => $rowFound['person_dob']
            );
            $resp = new Response(200, $data, 'Person Edited');

        } catch (Exception $e) {
            $resp = new Response(500, array($e), 'Internal Server Error');
        }
        //CREATE THE NEW PERSON IF NO ENTRY WAS FOUND WITH A NEW ID
    } else {
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
}
