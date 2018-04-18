<?php   //2 DIFFERENT RETURNS =
        //FIRST THAT RETURN A GIFT BASED ON ID,
        //SECOND THAT RETURNS ALL PEOPLE FROM THE USER AUTHENTICATED

    //INCLUDE TO VERIFY IF A PARAMETER HAS BEEN PASSED
    include "inc_personCheck.php";

    //IF A ROW AS FOUND IT'S BECAUSE THERE WAS A PATH PARAM PASSED TO RETURN A SINGLE GIFT
    if ($rowFound) {
        $data = array(
            "person_id" => $pathParam,
            "person_name" => $rowFound['person_name'],
            "person_dob" => $rowFound['person_dob']
        );
        $resp = new Response(200, $data, 'Person Found');

        //PARAM WAS PASSED BUT NO RECORD FOUND
    } else if ($pathParam) {
        $resp = new Response(404, array(), 'Person Not Found');

    } else {

        //IF NO ID PASSED RETURN PEOPLE ASSOCIATED WITH THE USER SESSION
        try {
            $sql = "SELECT * FROM people WHERE user_id = '$user_id' ORDER BY person_id";
            $rs = $pdo_link->prepare($sql);
            $rs->execute();
            $data = null;

            while($row = $rs->fetch(PDO::FETCH_ASSOC)){
                $data[]=$row;
            }

            if (!$data) {
                $resp = new Response(  404, array(),  'No Records found for this User yet');
            } else {
                $resp = new Response(  200, $data, 'All people retrieved');
            }
        } catch (Exception $e) {
            $resp = new Response(500, array($e), 'Internal Server Error');
        }

    }
