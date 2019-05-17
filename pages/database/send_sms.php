<?php
$ch = curl_init();
$parameters = array(
    'apikey' => 'c8a9802346f27096d84f883e93e5d244', //Your API KEY
    'number' => '09167980594',
    'message' => 'A New Event is Available! Event Name: Test Event, Event Venue: Test Venue, Start Date & Time: 05/05/2019 10:00am',
    'sendername' => 'SEMAPHORE'
);
curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
curl_setopt( $ch, CURLOPT_POST, 1 );

//Send the parameters set above with the request
curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

// Receive response from server
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$output = curl_exec( $ch );
curl_close ($ch);

//Show the server response
echo $output;
?>