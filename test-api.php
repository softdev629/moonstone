<?php

$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => "https://dvlaregistrations.dvla.gov.uk/api/latest_snapshot",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 15000,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_HTTPHEADER => array(
"cache-control: no-cache",
"X-API-KEY: skgg8kg0ssw4wsskgso0o4wkcsgo4k80sc840wck",
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
echo $response;
}