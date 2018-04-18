<?php //USED TO CHECK IF THERE IS A GIFT WITH THE ID ON DATABASE

$pathParam = null;
$rowFound = null;
//CHECK IF THE gift_id WAS PASSED AS A PATH PARAMETER
if (isset($_SERVER['PATH_INFO']) && !empty($_SERVER['PATH_INFO'])) {
    $pathParam = ltrim($_SERVER['PATH_INFO'], '/');
}

//IF PARAMETER WAS PASSED CHECK IF THE GIFT IS ON THE DATABASE
if ($pathParam) {

    try {
        $sql = "SELECT * FROM gifts WHERE gift_id = '$pathParam' LIMIT 1";
        $rs = $pdo_link->prepare($sql);
        $rs->execute();

        //IF A MATCH IS FOUND PASS IT TO THE MATCH VARIABLE
        if ($rs->rowCount() == 1) {
            $rowFound = $rs->fetch();
        }
    } catch (Exception $e) {
        $resp = new Response(500, array($e), 'Internal Server Error');
    }

} else {
    $resp = new Response(400, array(), 'Missing Required Parameter: gift_id on http path');
}