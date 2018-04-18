<?php

$headers = apache_request_headers();
$auth = false;

if (isset($headers['X-Api-Key']) && !empty($headers['X-Api-Key'])) {
    $authToken = $headers['X-Api-Key'];
    $sql = "SELECT user_id FROM users WHERE user_token = ? LIMIT 1";

    try {
        $rs = $pdo_link->prepare($sql);
        $rs->execute(array($authToken));

        if ($rs->rowCount() == 1) {
            $auth = true;
            $user_id = $rs->fetch()['user_id'];
        }

    } catch (Exception $e) {
        $resp = new Response(500, array(), 'Internal Server Error');
    }
}
