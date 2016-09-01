<?php

define('GOOGLE_API_KEY', 'AIzaSyCvlgKL91DhXwlnhYTiZfiHf2QfQhoEvFQ');

 function send_notification_iphone ($registatoin_ids, $data)
    { 
// Put your device token here (without spaces):
//$deviceToken = '3532b5c12082e635b79b034905f04ecbba81008fd99330c0be22242e5d32d626';
$deviceToken=$registatoin_ids;
// Put your private key's passphrase here:
$passphrase = "success@123";

// Put your alert message here:
//$message = 'You have a notification!';
 $pem = 'ck.pem';
//dQQebwI5cKA:APA91bHD_jof3PX230j2vIYc5n8WSpqmfJEw_Rg0yqwWgzTqp1VtJ_rcmeZNofEAl3_U1tAV5XD8V0SKmTUmie-18Ec-StNFn4uorSo4CtADvS6FPN8PGxHl7ccp7xd6Is7IuZphOS9i
////////////////////////////////////////////////////////////////////////////////

$ctx = stream_context_create();


stream_context_set_option($ctx, 'ssl', 'local_cert', $pem);
//stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
$fp = stream_socket_client(
	'ssl://gateway.sandbox.push.apple.com:2195', $err,
	$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

if (!$fp)
	exit("Failed to connect: $err $errstr" . PHP_EOL);

echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
//$body['aps'] = array(
//	'alert' => $message,
//        'badge' => 3,
//	'sound' => 'cat.caf'
//	);
//print_r($data); exit;
  $message['body'] = $data['body'];
 $body['aps'] = array( 'alert' => $message, 'type'=> $data['type'] );
  $body['badge'] =3;
   $body['sound'] ='cat.caf';
// Encode the payload as JSON
echo $payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));

if (!$result)
	echo 'Message not delivered' . PHP_EOL;
else
	echo 'Message successfully delivered' . PHP_EOL;

// Close the connection to the server
fclose($fp);
    }
    
    
    
    /* for andriod*/
    
    function send_notification($registration_ids,$resp)
    {   //Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';
        // $ids= "APA91bEQP9ib2b3bWEA8OgO3W1legf8N4Ye2cdONlgmUEAeUTobLyipRqylXJib32Vs61BfSfL";
        $fields = array(
            'registration_ids' =>array($registration_ids),
        //'user_ids' =>array($user_ids),
	    'data'=> array( "message" => $resp),
        );
        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
       
		// Disabling SSL Certificate support temporarly
	
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
       //echo $result;
       return $result;
    }
//   
//    function send_notifications($registration_ids,$response) { // function send_notification($registatoin_ids, $message)
//
//	// Set POST variables
//	$url = 'https://android.googleapis.com/gcm/send';
//    // $ids= "APA91bEQP9ib2b3bWEA8OgO3W1legf8N4Ye2cdONlgmUEAeUTobLyipRqylXJib32Vs61BfSfL";
//	
//	$fields = array(
//	    'registration_ids' =>array($registration_ids),
//	   //'user_ids' =>array($user_ids),
//	    'data'=> array( "message" => $response),
//	);
//    
//	//$headers = array(
//	//    'Authorization: key=' . GOOGLE_API_KEY,
//	//    'Content-Type: application/json',
//	//    'project_id:'.Project_id
//	//);
//	$headers = array(
//	    'Authorization: key=' . GOOGLE_API_KEY,
//	    'Content-Type: application/json'	    
//	);
//	// Open connection
//	$ch = curl_init();
//    
//	// Set the url, number of POST vars, POST data
//	curl_setopt($ch, CURLOPT_URL, $url);
//	curl_setopt($ch, CURLOPT_POST, true);
//	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    
//        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
//	// Disabling SSL Certificate support temporarly
//	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//	
//	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
//    
//	// Execute post
//	$result = curl_exec($ch);
//	if ($result === FALSE) {
//	    die('Curl failed: ' . curl_error($ch));
//	}
//	
//    
//	// Close connection
//	curl_close($ch);
//	//echo $result;
//	return $result;
//    }
    
    ?>