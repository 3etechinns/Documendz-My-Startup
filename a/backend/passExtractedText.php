<?php

extract($_POST);

session_start();

include 'connect.php';

$w = $_POST['jobId'];
$wn = mysqli_fetch_assoc(mysqli_query($dbhandle, "SELECT wname FROM workgroups WHERE  uniqueId = '".$w."' LIMIT 1"));

//set POST variables
$url = 'http://54.210.52.149/documendz-api.php';

$fields = array(
						"Api_ID" => "apiauthkey",
						"Job_ID" => $wn['wname'],
						"Filename_TEXT" => $_POST['fileName'],
						"Extracted_TEXT" => $_POST['highlights'],
						"Email_ID" => $_SESSION['email'],
						"Timestamp_TEXT" => time(),	
				);

$fields_string = '';

//url-ify the data for the POST
foreach($fields as $key=>$value) { 

	$fields_string .= $key.'='.urlencode($value).'&'; 

}

rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_URL, $url.'?'.$fields_string);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

//execute request
$result = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


$r = json_decode($result,true);

//echo $r['code'];



if($r['code'] == 200) {

 $e = $_SESSION['email'];
 $f = $_POST['fileName'];
 $j = $wn['wname'];

 $res = mysqli_query($dbhandle, 'INSERT INTO ezhire_api_data (username,filename,wkname,time,month) VALUES ("'.$e.'","'.$f.'","'.$j.'",now(),month(now()))');

echo $r;

 echo "1";

}

 else{

 	echo "0";

 	//there seems to be an error
 	 }

//close connection
curl_close($ch);

?>