<?php
//CHECK FOR THE ID ON THE DATABASE RETURN A ROW IF FOUND
require_once "inc_personCheck.php";

//WILL ONLY ALLOW TO DELETE THE ROW IF ALREADY ON THE DATABASE AND IT'S THE RIGHT USER
if ($rowFound) {

    try {
        $sql = "DELETE FROM people WHERE person_id = '$pathParam' LIMIT 1";
        $rs = $pdo_link->prepare($sql);
        $rs->execute();

        $data = array(
            "person_id" => $pathParam,
            "person_name" => $rowFound['person_name'],
            "person_dob" => $rowFound['person_dob']
        );
        $resp = new Response(200, $data, 'Person Deleted');

    } catch (Exception $e) {
        $resp = new Response(500, array($e), 'Internal Server Error');
    }

} else {
    $resp = new Response(404, array(), 'Person Not Found');
}