<?php
function get_midtrans_status($order_id) {
    $url = "https://api.sandbox.midtrans.com/v2/".$order_id."/status";
    $server_key = "SB-Mid-server-8VZnT2lPZk4zLWN9mCVBM2mP"; // Ganti dengan server key Anda
    $auth = base64_encode($server_key . ":");

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            "Authorization: Basic " . $auth
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return json_decode($response, true);
    }
}
?>
