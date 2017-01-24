<?php
//check command
if(isset($_REQUEST['cmd'])){
$cmd=$_REQUEST['cmd'];
	switch($cmd){
		case 1:
			addUser();
		break;
		case 2:
			login();
		break;
		case 3:
			addDevice();
		break;
		case 4:
			getDevices();
		break;
		case 5:
			editDevice();
		break;
		case 6:
			deleteDevice();
		break;
		case 7:
			getDeviceLocationXML();
		break;
		case 8:
			getSingleDeviceLocationXML();
		break;
		case 9:
			getDeviceLocation();
		break;
		case 10:
			getSingleDeviceLocation();
		break;
		case 11:
			findLocation();
		break;

		default:
			echo '{"result":0,"message":"Wrong command"}';
		break;
	}
}
function addUser(){
	if(!isset($_REQUEST['firstname'])){
		echo '{"result":0,"message":"First name is not given"}';
		return;
	}
	if(!isset($_REQUEST['lastname'])){
		echo '{"result":0,"message":"Last name is not given"}';
		return;
	}
	if(!isset($_REQUEST['email'])){
		echo '{"result":0,"message":"Email is not given"}';
		return;
	}
	if(!isset($_REQUEST['password'])){
		echo '{"result":0,"message":"Password is not given"}';
		return;
	}
	if(!isset($_REQUEST['phone'])){
		echo '{"result":0,"message":"Phone number is not given"}';
		return;
	}

	if($_REQUEST['firstname']==""){
		echo '{"result":0,"message":"First name is not given"}';
		return;
	}
	if($_REQUEST['lastname']==""){
		echo '{"result":0,"message":"Last name is not given"}';
		return;
	}
	if($_REQUEST['email']==""){
		echo '{"result":0,"message":"Email is not given"}';
		return;
	}
	if($_REQUEST['password']==""){
		echo '{"result":0,"message":"Password is not given"}';
		return;
	}
	if($_REQUEST['phone']==""){
		echo '{"result":0,"message":"Phone number is not given"}';
		return;
	}

	$firstname=$_REQUEST['firstname'];
	$lastname=$_REQUEST['lastname'];
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];
	$phone=$_REQUEST['phone'];

	include('user.php');
	$obj=new user();
	$row=$obj->addUser($firstname, $lastname, $email, $phone,$password);

	if($row==true){
		echo '{"result":1,"message":"Sign up successful"}';
	}

	else{
		echo '{"result":0,"message":"Sign up was not successful"}';
	}

}


function login(){
	
	if(!isset($_REQUEST['email'])){
		echo '{"result":0,"message":"Email is not given"}';
		return;
	}
	if(!isset($_REQUEST['password'])){
		echo '{"result":0,"message":"Password is not given"}';
		return;
	}
	if($_REQUEST['email']==""){
		echo '{"result":0,"message":"Email is not given"}';
		return;
	}
	if($_REQUEST['password']==""){
		echo '{"result":0,"message":"Password is not given"}';
		return;
	}
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];
	include('user.php');
	$obj=new user();
	$row=$obj->login($email, $password);
	if($row==true){
		$row=$obj->fetch();
		echo '{"result":1,"user":';
		echo json_encode($row);
		echo "}";
	}

	else{
		echo '{"result":0,"message":"Login failed"}';
	}

}
function getDevices(){

	include('user.php');
	$obj=new user();
	$row=$obj->getDevices();
	if($row==true){
		$row=$obj->fetch();
			echo '{"result":1,"device":[';
			while($row){
				echo json_encode($row);

				$row=$obj->fetch();
				if($row!=false){
					echo ",";
				}
			}
		echo "]}";
	}

	else{
		echo '{"result":0,"message":"Could not fetch pools"}';
	}

}


function addDevice(){
	if(!isset($_REQUEST['device'])){
		echo '{"result":0,"message":"Device name is not given"}';
		return;
	}
	if(!isset($_REQUEST['description'])){
		echo '{"result":0,"message":"Description is not given"}';
		return;
	}
	
	if(!isset($_REQUEST['tag'])){
		echo '{"result":0,"message":"Tag ID is not given"}';
		return;
	}
	if($_REQUEST['device']==""){
		echo '{"result":0,"message":"Device name is not given"}';
		return;
	}
	if($_REQUEST['description']==""){
		echo '{"result":0,"message":"Description is not given"}';
		return;
	}

	if($_REQUEST['tag']==""){
		echo '{"result":0,"message":"Tag ID is not given"}';
		return;
	}
	
	
	$device=$_REQUEST['device'];
	$description=$_REQUEST['description'];
	
	$tag=$_REQUEST['tag'];
	$userid=$_REQUEST['userid'];

	
	include('user.php');
	$obj=new user();

	
		$row=$obj->addDevice($device,$description, $tag, $userid);

		if($row==true){
			echo '{"result":1,"message":"Device added"}';
		}
		else{
			echo '{"result":0,"message":"Device not added"}';
		}
	

	

}


function editDevice(){
	if(!isset($_REQUEST['device'])){
		echo '{"result":0,"message":"Device name is not given"}';
		return;
	}
	if(!isset($_REQUEST['deviceid'])){
		echo '{"result":0,"message":"Device ID is not given"}';
		return;
	}
	if(!isset($_REQUEST['description'])){
		echo '{"result":0,"message":"Description is not given"}';
		return;
	}
	
	if(!isset($_REQUEST['tag'])){
		echo '{"result":0,"message":"Tag ID is not given"}';
		return;
	}
	if($_REQUEST['device']==""){
		echo '{"result":0,"message":"Device name is not given"}';
		return;
	}

	if($_REQUEST['deviceid']==""){
		echo '{"result":0,"message":"Device ID is not given"}';
		return;
	}
	if($_REQUEST['description']==""){
		echo '{"result":0,"message":"Description is not given"}';
		return;
	}

	if($_REQUEST['tag']==""){
		echo '{"result":0,"message":"Tag ID is not given"}';
		return;
	}
	
	
	$device=$_REQUEST['device'];
	$description=$_REQUEST['description'];
	$deviceid=$_REQUEST['deviceid'];
	$tag=$_REQUEST['tag'];
	$userid=$_REQUEST['userid'];

	
	include('user.php');
	$obj=new user();

	
		$row=$obj->editDevice($device,$description, $tag, $userid,$deviceid);

		if($row==true){
			echo '{"result":1,"message":"Device edited"}';
		}
		else{
			echo '{"result":0,"message":"Device not edited"}';
		}

}




function deleteDevice(){
	 if(!isset($_REQUEST['deviceid'])){
	 	echo '{"result":0,"message":"Device details cannot be found"}';
		return;
	 }
	 if($_REQUEST['deviceid']==""){
		echo '{"result":0,"message":"Device ID is not given"}';
		return;
	}
	
	 $deviceid=$_REQUEST['deviceid'];

	include('user.php');
	$obj=new user();
	$row=$obj->deleteDevice($deviceid);

	if($row==true){
		echo '{"result":1,"message":"Deletion successful"}';
	}
	else{
		echo '{"result":0,"message":"Deletion not successful"}';
	}

}

function parseToXML($htmlStr)
{
	$xmlStr=str_replace('<','&lt;',$htmlStr);
	$xmlStr=str_replace('>','&gt;',$xmlStr);
	$xmlStr=str_replace('"','&quot;',$xmlStr);
	$xmlStr=str_replace("'",'&#39;',$xmlStr);
	$xmlStr=str_replace("&",'&amp;',$xmlStr);
	return $xmlStr;
}

function getDeviceLocationXML(){

	header("Content-type: text/xml");
	echo '<markers>';
	include('user.php');
	$obj=new user();
	$row=$obj->getDeviceLocation();
	if($row==true){
		$row=$obj->fetch();
			
			while($row){
				
				echo '<marker ';
				  echo 'name="' . parseToXML($row['name']) . '" ';
				  echo 'address="' . parseToXML($row['placename']) . '" ';
				  echo 'lat="' . $row['latitude'] . '" ';
				  echo 'lng="' . $row['longitude'] . '" ';
				  echo 'type="' . $row['type'] . '" ';
				  echo '/>';
				  $row=$obj->fetch();
				}
				echo '</markers>';
			
		

	}

	else{
		echo '{"result":0,"message":"Could not fetch devices"}';
	}

}

function getDeviceLocation(){
	include('user.php');
	$obj=new user();
	$row=$obj->getDeviceLocation();
	if($row==true){
		$row=$obj->fetch();
		echo '{"result":1,"devicelocation":[';
			while($row){
				echo json_encode($row);

				$row=$obj->fetch();
				if($row!=false){
					echo ",";
				}
			}
		echo "]}";
	}

	else{
		echo '{"result":0,"message":"Could not fetch devices"}';
	}

}
function getSingleDeviceLocation(){
	 if(!isset($_REQUEST['device'])){
	 	echo '{"result":0,"message":"Place has not been selected"}';
		return;
	 }
	 if($_REQUEST['device']==""){
		echo '{"result":0,"message":"Place has not been selected"}';
		return;
	}
	
	$device=$_REQUEST['device'];
	include('user.php');
	$obj=new user();
	$row=$obj->getDeviceLocation($device);
	if($row==true){
		$row=$obj->fetch();
		echo '{"result":1,"devicelocation":[';
			while($row){
				echo json_encode($row);

				$row=$obj->fetch();
				if($row!=false){
					echo ",";
				}
			}
		echo "]}";
	}

	else{
		echo '{"result":0,"message":"Could not fetch devices"}';
	}

}

function findLocation(){
	 if(!isset($_REQUEST['locationid'])){
	 	echo '{"result":0,"message":"Location has not been selected"}';
		return;
	 }
	 if($_REQUEST['locationid']==""){
		echo '{"result":0,"message":"Location has not been selected"}';
		return;
	}
	
	$locationid=$_REQUEST['locationid'];
	include('user.php');
	$obj=new user();
	$row=$obj->getLocation($locationid);
	if($row==true){
		$row=$obj->fetch();
		echo '{"result":1,"location":[';
			while($row){
				echo json_encode($row);

				$row=$obj->fetch();
				if($row!=false){
					echo ",";
				}
			}
		echo "]}";
	}

	else{
		echo '{"result":0,"message":"Could not fetch location"}';
	}

}
function getSingleDeviceLocationXML(){
	 if(!isset($_REQUEST['place'])){
	 	echo '{"result":0,"message":"Place has not been selected"}';
		return;
	 }
	 if($_REQUEST['place']==""){
		echo '{"result":0,"message":"Place has not been selected"}';
		return;
	}
	
	 $place=$_REQUEST['place'];
	
		
	header("Content-type: text/xml");
	echo '<markers>';
	include('user.php');
	$obj=new user();
	$row=$obj->getDeviceLocation($place);
	if($row==true){
		$row=$obj->fetch();
			
			while($row){
				
				echo '<marker ';
				  echo 'name="' . parseToXML($row['name']) . '" ';
				  echo 'address="' . parseToXML($row['placename']) . '" ';
				  echo 'lat="' . $row['latitude'] . '" ';
				  echo 'lng="' . $row['longitude'] . '" ';
				  echo 'type="' . $row['type'] . '" ';
				  echo '/>';
				  $row=$obj->fetch();
				}
				echo '</markers>';
			
		

	}

	else{
		echo '{"result":0,"message":"Could not fetch devices"}';
	}

}



function sendNotification(){
	$to="APA91bFIj2WLkD3W4kbZcGO7dyI-TKKX0QpYCwtzqE2cNC0GbnUfQ7_gvQKOUloSb9T-6OZMxKdHXj8biiMYVgRJJP-C6b3PfpC7Kzu4G77PqMeGekHU9W6qTwnu0YTtWGNd6tGMBQka";
	$title="Push Notification Title";
	$message="Push Notification Message";
	sendPush($to,$title,$message);
}

function sendPush($to,$title,$message)
{
// API access key from Google API's Console
// replace API
	define( 'API_ACCESS_KEY', 'AIzaSyA5eScgNYWfnCjtmP7e22aYos4Zdn7h_kE');
	$registrationIds = array($to);
	$msg = array
	(
	'message' => $message,
	'title' => $title,
	'vibrate' => 1,
	'sound' => 1

	// you can also add images, additionalData
	);
	$fields = array
	(
	'registration_ids' => $registrationIds,
	'data' => $msg
	);
	$headers = array
	(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
	);
	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
	curl_setopt( $ch,CURLOPT_POST, true );
	curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch );
	curl_close( $ch );
	echo $result;
}

?>