<?php   //3 DIFFERENT RETURNS =
        //FIRST WITH A QUERY STRING person_id BEING PASSED,
        //SECOND THAT RETURN A GIFT BASED ON ID,
        //THIRD THAT RETURNS ALL GIFTS FROM ALL PEOPLE FROM THE USER AUTHENTICATED


//CHECK IF ITS ASKING FOR GIFTS FROM A PERSON PASSING A QUERY STRING
if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {

    //GET THE PARAMETER INTO A VARIABLE
    parse_str($_SERVER['QUERY_STRING'], $query);
    $person_id = $query['person_id'];

    try {
        $sql = "SELECT * FROM gifts WHERE person_id = '$person_id'";
        $rs = $pdo_link->prepare($sql);
        $rs->execute();

        while($row = $rs->fetch(PDO::FETCH_ASSOC)){
            //push each data record in data array
            $data[]=$row;
        }
        if (!$data) {
            $resp = new Response(  404, $data,  'No Gifts found for this Person');
        } else {
            $resp = new Response(  200, $data, sizeof($data) . " Gifts found for this Person");
        }

    } catch (Exception $e) {
        $resp = new Response(500, array($e), 'Internal Server Error');
    }

} else {
    //INCLUDE TO VERIFY IF A PARAMETER HAS BEEN PASSED
    include "inc_giftCheck.php";

    //IF A ROW AS FOUND IT'S BECAUSE THERE WAS A PATH PARAM PASSED TO RETURN A SINGLE GIFT
    if ($rowFound) {
        $data = array(
            "person_id" => $rowFound['person_id'],
            "gift_id" => $pathParam,
            "gift_title" => $rowFound['gift_title'],
            "gift_url" => $rowFound['gift_url'],
            "gift_price" => $rowFound['gift_price'],
            "gift_store" => $rowFound['gift_store']
        );
        $resp = new Response(200, $data, 'Gift Found');

     //PARAM WAS PASSED BUT NO RECORD FOUND
    } else if ($pathParam) {
        $resp = new Response(404, array(), 'Gift Not Found');

    } else {
    //IF NO QUERY STRING OR ID PASSED RETURN ALL ASSOCIATED GIFTS FROM ALL PEOPLE FROM THE AUTHENTICATED USER

        try {
            $sql = "SELECT people.person_id, gift_id, gift_url, gift_price, gift_store FROM gifts INNER JOIN people ON gifts.person_id=people.person_id WHERE people.user_id='$user_id' ORDER BY people.person_id, gifts.gift_id";
            $rs = $pdo_link->prepare($sql);
            $rs->execute();
            $data = null;

            while($row = $rs->fetch(PDO::FETCH_ASSOC)){
                $data[]=$row;
            }

            if (!$data) {
                $resp = new Response(  404, array(),  'No Records found for this User yet');
            } else {
                $resp = new Response(  200, $data, 'All gifts retrieved');
            }
        } catch (Exception $e) {
            $resp = new Response(500, array($e), 'Internal Server Error');
        }

    }
}
