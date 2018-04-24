<?php
//TRANSFORMING PUT INTO A GLOBAL VARIABLE USING A STREAM CLASS TO READ RAW DATA
//require_once "class_Stream.php";
//$data = array();
//new stream($data);
//$_PUT = $data['post'];

//WORKING SOLUTION
$rawString = file_get_contents("php://input");
$_PUT = json_decode($rawString, true);

//CHECK AND VALIDATE THE PARAMETERS PASSED
require_once "inc_giftValidation.php";

//IF THERE IS NOT A MESSAGE IT'S BECAUSE THE DATA IS VALID THEN DO THE PUT
// NOTE THE ! ELSE IT WILL GO OUT AND DISPLAY MESSAGE ON THE PEOPLE CONTROLLER
if (!$resp) {
    //FIRST CHECK IF THERES ALREADY GIFT WITH THAT ID
    require_once "inc_giftCheck.php";

    //IF THE GIFT IS FOUND EDIT IT, ELSE CREATE A NEW ENTRY
    if ($rowFound) {

        try {
            $sql = "UPDATE gifts SET person_id='$person_id', gift_title='$title', gift_url='$url', gift_price='$price', gift_store='$store' WHERE gift_id = '$pathParam' LIMIT 1";
            $rs = $pdo_link->prepare($sql);
            $rs->execute();

            $data = array(
                "person_id" => $rowFound['person_id'],
                "gift_id" => $pathParam,
                "gift_title" => $rowFound['gift_title'],
                "gift_url" => $rowFound['gift_url'],
                "gift_price" => $rowFound['gift_price'],
                "gift_store" => $rowFound['gift_store']
            );
            $resp = new Response(200, $data, 'Person Edited');

        } catch (Exception $e) {
            $resp = new Response(500, array($e), 'Internal Server Error');
        }
        //CREATE THE NEW PERSON IF NO ENTRY WAS FOUND WITH A NEW ID
    } else {
        try {
            $sql = "INSERT INTO gifts ( gift_title, person_id, gift_url, gift_price, gift_store ) VALUES ('$title','$person_id','$url','$price','$store')";
            $rs = $pdo_link->prepare($sql);
            $rs->execute();

            $data = array(
                "person_id" => $person_id,
                "gift_id" => $pdo_link->lastInsertId(),
                "gift_title" => $title,
                "gift_url" => $url,
                "gift_price" => $price,
                "gift_store" => $store
            );
            $resp = new Response(201, $data, 'Gift Added');

        } catch (Exception $e) {
            $resp = new Response(500, array($e), 'Internal Server Error');
        }
    }
}
