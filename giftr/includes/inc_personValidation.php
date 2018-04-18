<?php //USED TO VALIDATE THE DATA BEING PASSED TO PUT AND POST METHODS

$errMessage = null;
//CHECK THE METHOD TO TARGET RIGHT VARIABLE - POST else PUT
switch ($httpMethod) {
    //IF PARAMETERS ARE MISSING SEND A RESPONSE TO THE USER TELLING WHAT'S WRONG - NOTE THE ! INVERTING LOGIC
    case "POST":
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (!isset($_POST['person_name']) && empty($_POST['person_name'])) {
            $errMessage = 'Missing Required Parameter: person_name on the body request';
        } else if (!isset($_POST['person_dob']) && empty($_POST['person_dob'])) {
            $errMessage = 'Missing Required Parameter: person_dob on the body request';
        } else {
            // IF ALL PARAMETERS ARE SET RUN THE VALIDATION
            $name = trim($_POST['person_name']);
            $dob = $_POST['person_dob'];

            //DATA VALIDATION FOR NAME AND DOB FIELDS
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $errMessage = 'Wrong Parameter Format: Only letters and white space allowed for person_name';
            } else if (!preg_match("/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/", $dob)) {
                $errMessage = 'Wrong Parameter Format: Should be YYYY-MM-DD for person_dob';
            }
        }
        break;
    case "PUT":
        if (!isset($_PUT['person_name']) && empty($_PUT['person_name'])) {
            $errMessage = 'Missing Required Parameter: person_name on the body request';
        } else if (!isset($_PUT['person_dob']) && empty($_PUT['person_dob'])) {
            $errMessage = 'Missing Required Parameter: person_dob on the body request';
        } else {
            // IF ALL PARAMETERS ARE SET RUN THE VALIDATION
            $name = trim($_PUT['person_name']);
            $dob = $_PUT['person_dob'];

            //DATA VALIDATION FOR NAME AND DOB FIELDS
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $errMessage = 'Wrong Parameter Format: Only letters and white space allowed for person_name';
            } else if (!preg_match("/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/", $dob)) {
                $errMessage = 'Wrong Parameter Format: Should be YYYY-MM-DD for person_dob';
            }
        }
}
//IF ANY ERROR MESSAGE WAS GENERATED CREATE THE RESPONSE
if ($errMessage) {
    $resp = new Response(400, array(), $errMessage);
}