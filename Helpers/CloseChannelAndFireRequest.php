<?php
function closeChannelAndFireRequest($response)
{
    ob_end_clean();
    header("Connection: close");
    ignore_user_abort(true); // optional
    ob_start();
    //The returned data
    echo json_encode($response);
    $size = ob_get_length();
    header("Content-Length: $size");
    header('Content-Type: application/json');
    ob_end_flush();
    flush();
    fastcgi_finish_request();
}
