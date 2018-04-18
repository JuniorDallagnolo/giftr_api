<?php
//CHECK FOR THE ID ON THE DATABASE RETURN A ROW IF FOUND
require_once "inc_giftCheck.php";

//WILL ONLY ALLOW TO DELETE THE ROW IF ALREADY ON THE DATABASE
if ($rowFound) {

    try {
        $sql = "DELETE FROM gifts WHERE gift_id = '$pathParam' LIMIT 1";
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
        $resp = new Response(200, $data, 'Gift Deleted');

    } catch (Exception $e) {
        $resp = new Response(500, array($e), 'Internal Server Error');
    }

} else {
    $resp = new Response(404, array(), 'Gift Not Found');
}