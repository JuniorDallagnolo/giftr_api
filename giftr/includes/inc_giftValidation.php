<?php //USED TO VALIDATE THE DATA BEING PASSED TO PUT AND POST METHODS

$errMessage = null;
//CHECK THE METHOD TO TARGET RIGHT VARIABLE - POST else PUT
switch ($httpMethod) {
    //IF PARAMETERS ARE MISSING SEND A RESPONSE TO THE USER TELLING WHAT'S WRONG - NOTE THE ! INVERTING LOGIC
    case "POST":
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (!isset($_POST['person_id']) && empty($_POST['person_id'])) {
            $errMessage = 'Missing Required Parameter: person_id on the body request';
        } else if (!isset($_POST['gift_title']) && empty($_POST['gift_title'])) {
            $errMessage = 'Missing Required Parameter: gift_title on the body request';
        } else if (!isset($_POST['gift_url']) && empty($_POST['gift_url'])) {
            $errMessage = 'Missing Required Parameter: gift_url on the body request';
        } else if (!isset($_POST['gift_price']) && empty($_POST['gift_price'])) {
            $errMessage = 'Missing Required Parameter: gift_price on the body request';
        } else if (!isset($_POST['gift_store']) && empty($_POST['gift_store'])) {
            $errMessage = 'Missing Required Parameter: gift_store on the body request';
        } else {
            // IF ALL PARAMETERS ARE SET RUN THE VALIDATION
            $person_id = trim($_POST['person_id']);
            $title = trim($_POST['gift_title']);
            $url = trim($_POST['gift_url']);
            $price = trim($_POST['gift_price']);
            $store = trim($_POST['gift_store']);

            //DATA VALIDATION
            if (!preg_match("/^[0-9]*$/", $person_id)) {
                $errMessage = 'Wrong Parameter Format: Only integers numbers allowed to person_id';
            } else if (!preg_match("/^(http|https):/", $url)) {
                $errMessage = 'Wrong Parameter Format: Not a valid url for gift_url';
            } else if (!preg_match("/^[+\-]?\d+(\.\d+)?$/", $price)) {
                $errMessage = 'Wrong Parameter Format: Should be XX.yy format for gift_price';
            }
        }
        break;
    case "PUT":
        if (!isset($_PUT['person_id']) && empty($_PUT['person_id'])) {
            $errMessage = 'Missing Required Parameter: person_id on the body request';
        } else if (!isset($_PUT['gift_title']) && empty($_PUT['gift_title'])) {
            $errMessage = 'Missing Required Parameter: gift_title on the body request';
        } else if (!isset($_PUT['gift_url']) && empty($_PUT['gift_url'])) {
            $errMessage = 'Missing Required Parameter: gift_url on the body request';
        } else if (!isset($_PUT['gift_price']) && empty($_PUT['gift_price'])) {
            $errMessage = 'Missing Required Parameter: gift_price on the body request';
        } else if (!isset($_PUT['gift_store']) && empty($_PUT['gift_store'])) {
            $errMessage = 'Missing Required Parameter: gift_store on the body request';
        } else {
            // IF ALL PARAMETERS ARE SET RUN THE VALIDATION
            $person_id = trim($_PUT['person_id']);
            $title = trim($_PUT['gift_title']);
            $url = trim($_PUT['gift_url']);
            $price = trim($_PUT['gift_price']);
            $store = trim($_PUT['gift_store']);

            //DATA VALIDATION
            if (!preg_match("/^[0-9]*$/", $person_id)) {
                $errMessage = 'Wrong Parameter Format: Only integers numbers allowed to person_id';
            } else if (!preg_match("^(http|https):", $url)) {
                $errMessage = 'Wrong Parameter Format: Not a valid url for gift_url';
            } else if (!preg_match("/^[+\-]?\d+(\.\d+)?$/", $price)) {
                $errMessage = 'Wrong Parameter Format: Should be XX.yy format for gift_price';
            }
        }
        break;
}
//IF ANY ERROR MESSAGE WAS GENERATED CREATE THE RESPONSE
if ($errMessage) {
    $resp = new Response(400, array(), $errMessage);
}