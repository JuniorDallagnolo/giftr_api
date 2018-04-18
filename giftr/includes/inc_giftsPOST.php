<?php
//CHECK AND VALIDATE THE PARAMETERS PASSED
require_once "inc_giftValidation.php";

//IF THERE IS NOT A MESSAGE IT'S BECAUSE THE DATA IS VALID THEN DO THE INSERT -
// NOTE THE ! ELSE IT WILL GO OUT AND DISPLAY MESSAGE ON THE PEOPLE CONTROLLER
if (!$resp) {
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

