<?php
 header("Access-Control-Allow-Origin: *");
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
		case 12:
			addDeviceLocation();
		break;
		case 13:
			getLocations();
		break;
		case 14:
			alertSecurity();
		break;
		case 15:
			updateNotification();
		break;
		case 16:
			addStartDeviceLocation();
		break;
		case 17:
			addAdmin();
		break;
		case 18:
			loginAdmin();
		break;
		case 19:
			countLocationFrequency();
		break;
		case 20:
			addReader();
		break;
		case 21:
			getsAlerts();
		break;
		case 22:
			getAllUsers();
		break;
		case 23:
			getAdmins();
		break;


		default:
			echo '{"result":0,"message":"Wrong command"}';
		break;
	}
}

function addStartDeviceLocation(){
	if(!isset($_REQUEST['deviceid'])){
		echo '{"result":0,"message":"Device is not given"}';
		return;
	}
	if($_REQUEST['deviceid']==""){
		echo '{"result":0,"message":"Device is not given"}';
		return;
	}
	if(!isset($_REQUEST['locationid'])){
		echo '{"result":0,"message":"Location is not given"}';
		return;
	}
	if($_REQUEST['locationid']==""){
		echo '{"result":0,"message":"Location is not given"}';
		return;
	}

	
	$device=$_REQUEST['deviceid'];
	$location=$_REQUEST['locationid'];

	include('user.php');
	$obj=new user();

	$currentdatetime=date("Y-m-d h:i:s")." ";
				
			
	$row=$obj->addDeviceLocation($device,$currentdatetime, $location);
	if($row==true){
		echo '{"result":1,"message":"Device location successfully added"}';
	}

	else{
		echo '{"result":0,"message":"Device location was not added"}';
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
	if(!isset($_REQUEST['org'])){
		echo '{"result":0,"message":"Organization is not given"}';
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
	if($_REQUEST['org']==""){
		echo '{"result":0,"message":"Organization is not given"}';
		return;
	}

	$firstname=$_REQUEST['firstname'];
	$lastname=$_REQUEST['lastname'];
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];
	$phone=$_REQUEST['phone'];
	$notification=$_REQUEST['notification'];
	$admin=$_REQUEST['org'];


	include('user.php');
	$obj=new user();
	$row=$obj->addUser($firstname, $lastname, $email, $phone,$password,$notification,$admin);

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

	if(isset($_REQUEST['id'])){
		$id=$_REQUEST['id'];
		$row=$obj->getDevices($id);
	}else{
		$row=$obj->getDevices();
	}
	
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
		echo '{"result":0,"message":"Error fetching devices"}';
	}

}

function getAdmins(){

	include('user.php');
	$obj=new user();


	$row=$obj->getAdmins();

	if($row==true){
		$row=$obj->fetch();
			echo '{"result":1,"admin":[';
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
		echo '{"result":0,"message":"Error fetching admins"}';
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
	// if(!isset($_REQUEST['image'])){
	// 	echo '{"result":0,"message":"Image is not given"}';
	// 	return;
	
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
	// if($_REQUEST['image']==""){
	// 	echo '{"result":0,"message":"Image is not given"}';
	// 	return;
	// }
	
	
	$device=$_REQUEST['device'];
	$description=$_REQUEST['description'];
	
	$tag=$_REQUEST['tag'];
	$userid=$_REQUEST['userid'];
	

	if(is_array($_FILES)) {
		if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
			$sourcePath = $_FILES['userImage']['tmp_name'];
				$targetPath = "img/".$_FILES['userImage']['name'];
				if(move_uploaded_file($sourcePath,$targetPath)) {
				
					 $image= 'img/'.$_FILES['userImage']['name'];
				
			}
		}
		else{
				$image='img/device.jpg';
			}
	}


	
	include('user.php');
	$obj=new user();

	
		$row=$obj->addDevice($device,$description, $tag, $userid, $image);

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
	 if(!isset($_REQUEST['userid'])){
	 	echo '{"result":0,"message":"User ID cannot be found"}';
		return;
	 }
	  if($_REQUEST['userid']==""){
		echo '{"result":0,"message":"User ID is not given"}';
		return;
	}

	 $userid=$_REQUEST['userid'];

	include('user.php');
	$obj=new user();
	$row=$obj->getDeviceLocationWithID($userid);
	if($row==true){
		header("Content-type: text/xml");
		echo '<markers>';
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
	$row=$obj->getAllDeviceLocation();
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
	
		
	// header("Content-type: text/xml");
	// echo '<markers>';
	include('user.php');
	$obj=new user();
	$row=$obj->getDeviceLocation($place);
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

function addDeviceLocation(){
	if(!isset($_REQUEST['tagid'])){
		echo '{"result":0,"message":"Tag identification is not given"}';
		return;
	}
	if($_REQUEST['tagid']==""){
		echo '{"result":0,"message":"Tag identification is not given"}';
		return;
	}
	if(!isset($_REQUEST['locationid'])){
		echo '{"result":0,"message":"Location is not given"}';
		return;
	}
	if($_REQUEST['locationid']==""){
		echo '{"result":0,"message":"Location is not given"}';
		return;
	}

	
	$tag=$_REQUEST['tagid'];
	$location=$_REQUEST['locationid'];

	include('user.php');
	$obj=new user();

		$row=$obj->findDevice($tag);

		if($row==true){
			$deviceid=$obj->fetch();

			$row=$obj->getLocationWithID($location);
			if($row==true){
				$locationname=$obj->fetch();

				$currentdatetime=date("Y-m-d h:i:s")." ";
				$device=$deviceid['deviceid'];
				
			
				$row=$obj->addDeviceLocation($device,$currentdatetime,	$location);
				if($row==true){
					echo '{"result":1,"message":"Device added"}';
				}
				else{
					echo '{"result":0,"message":"Device not added"}';
				}

		}
		else{
			echo '{"result":0,"message":"Could not fetch location information"}';
			return;
		}

		if($deviceid['track']=='1'){
			$notiicationcode=$deviceid['notification'];
			
			$pushnotification=substr($notiicationcode, 0,1);
			$sms=substr($notiicationcode, 1,1);
			$email=substr($notiicationcode, 2,1);

			
			

			if($pushnotification=='1'){
				
			}
			if($sms=='1'){
				
					require './Smsgh/Api.php';

					$auth = new BasicAuth("znlltiuf", "qmidxlrw");
					// instance of ApiHost
					$apiHost = new ApiHost($auth);

					// instance of AccountApi
					$accountApi = new AccountApi($apiHost);
					// Get the account profile
					// Let us try to send some message
					$messagingApi = new MessagingApi($apiHost);
					 try {
				    // Send a quick message
					    //$messageResponse = $messagingApi->sendQuickMessage("Husby", "+2332432191768", "I love you dearly Honey. See you in the evening...");
					$currentdatetime=date("Y-m-d h:i:s")." ";
					
				

					$mesg = new Message();
					$mesg->setContent($deviceid['name']." moved to the ".$locationname['placename']." at ".$currentdatetime);
					$mesg->setTo($deviceid['phone']);
					$mesg->setFrom("Suivre App");
					$mesg->setRegisteredDelivery(false);

					   

					$messageResponse = $messagingApi->sendMessage($mesg);

					if ($messageResponse instanceof MessageResponse) {
					    echo '{"result":1,"message":"Message sent"}';
					      //   echo $messageResponse->getStatus();
					      //   echo'"';
					} elseif ($messageResponse instanceof HttpResponse) {
					    echo '{"result":0,"message":"Message not sent"}';
					}
				} catch (Exception $ex) {
					    echo $ex->getTraceAsString();
				}
			}
			if($email=='1'){
				

		    	$to = $deviceid['email']; // this is your Email address
			    $from = "efuabainson@gmail.com"; // this is the sender's Email address
			    $subject = "Suivre App Alert";
			    $subject2 = "Copy of Suivre App Alert";
			    $message = $deviceid['name']." moved to the ".$locationname['placename']." at ".$currentdatetime;
			    $message2 = $deviceid['name']." moved to the ".$locationname['placename']." at ".$currentdatetime;

			    $headers = "From:" . $from;
			    $headers2 = "From:" . $to;
			    mail($to,$subject,$message,$headers); 
			}

		}
						

	}

	else{
			echo '{"result":0,"message":"Could not fetch device information"}';
			return;
	}

	
	

}
function getLocations(){
	include('user.php');
	$obj=new user();

	if(isset($_REQUEST['admin'])){
		$id=$_REQUEST['admin'];
		$row=$obj->getLocations($id);
	}else{
		$row=$obj->getLocations();
	}

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

function alertSecurity(){
	if(!isset($_REQUEST['userid'])){
		echo '{"result":0,"message":"User id is not given"}';
		return;
	}
	if($_REQUEST['userid']==""){
		echo '{"result":0,"message":"User id is not given"}';
		return;
	}
	if(!isset($_REQUEST['deviceid'])){
		echo '{"result":0,"message":"Device id is not given"}';
		return;
	}
	if($_REQUEST['deviceid']==""){
		echo '{"result":0,"message":"Device id is not given"}';
		return;
	}
	if(!isset($_REQUEST['name'])){
		echo '{"result":0,"message":"The name of device is not given"}';
		return;
	}
	if($_REQUEST['name']==""){
		echo '{"result":0,"message":"The name of device is not given"}';
		return;
	}
	if(!isset($_REQUEST['description'])){
		echo '{"result":0,"message":"Description is not given"}';
		return;
	}
	if($_REQUEST['description']==""){
		echo '{"result":0,"message":"Description is not given"}';
		return;
	}
	if(!isset($_REQUEST['locationid'])){
		echo '{"result":0,"message":"Location is not given"}';
		return;
	}
	if($_REQUEST['locationid']==""){
		echo '{"result":0,"message":"Location is not given"}';
		return;
	}
	if(!isset($_REQUEST['image'])){
		echo '{"result":0,"message":"Image is not given"}';
		return;
	}
	if($_REQUEST['image']==""){
		echo '{"result":0,"message":"Image is not given"}';
		return;
	}
	if(!isset($_REQUEST['admin'])){
		echo '{"result":0,"message":"Admin details is not given"}';
		return;
	}
	if($_REQUEST['admin']==""){
		echo '{"result":0,"message":"Admin details is not given"}';
		return;
	}
	
	$name=$_REQUEST['name'];
	$location=$_REQUEST['locationid'];
	$description=$_REQUEST['description'];
	$image=$_REQUEST['image'];
	$deviceid=$_REQUEST['deviceid'];
	$user=$_REQUEST['userid'];
	$admin=$_REQUEST['admin'];

	$alertlocation=$location;
	$alertuser=$user;

	include('user.php');
	$obj=new user();

	$row=$obj->getDeviceLocation($deviceid);
	if($row==true){
		$location=$obj->fetch();

	}

	else{
		echo '{"result":0,"message":"Could not fetch location"}';
		return;
	}

	$row=$obj->getUser($user);
	if($row==true){
		$user=$obj->fetch();
	}

	else{
		echo '{"result":0,"message":"Could not fetch user"}';
		return;
	}

	$row=$obj->getAdmins($admin);
	if($row==true){
		$admindetails=$obj->fetch();
	}

	else{
		echo '{"result":0,"message":"Could not fetch admin details"}';
		return;
	}

	require './Smsgh/Api.php';

	$auth = new BasicAuth("znlltiuf", "qmidxlrw");
	// instance of ApiHost
	$apiHost = new ApiHost($auth);

	// instance of AccountApi
	$accountApi = new AccountApi($apiHost);
	// Get the account profile
	// Let us try to send some message
	$messagingApi = new MessagingApi($apiHost);
	try {
    // Send a quick message
	    //$messageResponse = $messagingApi->sendQuickMessage("Husby", "+2332432191768", "I love you dearly Honey. See you in the evening...");
		$currentdatetime=date("Y-m-d h:i:s")." ";
		//echo($location['placename']);

	    $mesg = new Message();
	    $mesg->setContent("Alert from ".$user['firstname']." ".$user['lastname'].". ".$name." (".$description.") moved to the ".$location['placename']." at ".$currentdatetime);
	    $mesg->setTo($admindetails['securityphoneum']);
	    $mesg->setFrom("Suivre App Security Alert!");
	    $mesg->setRegisteredDelivery(true);


	    $messageResponse = $messagingApi->sendMessage($mesg);

	    if ($messageResponse instanceof MessageResponse) {
	    	 echo '{"result":1,"message":"Message sent"}';
	      //   echo $messageResponse->getStatus();
	      //   echo'"';
	    } elseif ($messageResponse instanceof HttpResponse) {
	    	 echo '{"result":0,"message":"Message not sent"}';
	        // echo "\nServer Response Status : " . $messageResponse->getStatus();
	        // echo'"';
	    }
	} catch (Exception $ex) {
	    echo $ex->getTraceAsString();
	}
	    	$to = $admindetails['securityemail']; // this is your Email address
		    $from = $user['email']; // this is the sender's Email address
		    $subject = "Suivre App Security Alert!";
		    
		    $message = "Alert from ".$user['firstname']." ".$user['lastname'].". ".$name." (".$description.") moved to the ".$location['placename']." at ".$currentdatetime;
		    
		    $headers = "From:" . $from;
		   
		    mail($to,$subject,$message,$headers);

	
	$row=$obj->addAlert($alertuser, $deviceid, $location['locationid'], $currentdatetime, $user['admin']);
	if($row==true){
		echo '{"result":1,"message":"Alert added"}';
	}

	else{
		echo '{"result":0,"message":"Alert not added to database"}';
		return;
	}
}


function updateNotification(){
	include('user.php');
	$obj=new user();

	if(isset($_REQUEST['notification'])){
		if(!($_REQUEST['notification']=="")){
			$notification=$_REQUEST['notification'];
			$userid=$_REQUEST['userid'];
			$row=$obj->updateNotificationCode($notification, $userid);
			if($row==true){
				
			}

			else{
				echo '{"result":0,"message":"Could not update notification channel"}';
				return;
			}
		}
	}

	$track=$_REQUEST['track'];
	$device=$_REQUEST['devicename'];

	$currentdatetime=date("Y-m-d h:i:s")." ";

	$row=$obj->updateTrackingCode($track, $device, $currentdatetime);
	if($row==true){
		echo '{"result":1,"message":"Update successful"}';
	}

	else{
		echo '{"result":0,"message":"Update failed"}';
		return;
	}


}

function addReader(){
	if(!isset($_REQUEST['place'])){
		echo '{"result":0,"message":"Place is not given"}';
		return;
	}
	if(!isset($_REQUEST['lat'])){
		echo '{"result":0,"message":"Latitude is not given"}';
		return;
	}
	if(!isset($_REQUEST['lng'])){
		echo '{"result":0,"message":"Longitude is not given"}';
		return;
	}
	if(!isset($_REQUEST['type'])){
		echo '{"result":0,"message":"Type is not given"}';
		return;
	}
	if(!isset($_REQUEST['admin'])){
		echo '{"result":0,"message":"Admin ID is not given"}';
		return;
	}


	if($_REQUEST['place']==""){
		echo '{"result":0,"message":"Place is not given"}';
		return;
	}
	if($_REQUEST['lat']==""){
		echo '{"result":0,"message":"Latitude is not given"}';
		return;
	}
	if($_REQUEST['lng']==""){
		echo '{"result":0,"message":"Longitude is not given"}';
		return;
	}
	if($_REQUEST['type']==""){
		echo '{"result":0,"message":"Type is not given"}';
		return;
	}
	if($_REQUEST['admin']==""){
		echo '{"result":0,"message":"Admin ID is not given"}';
		return;
	}



	$place=$_REQUEST['place'];
	$lat=$_REQUEST['lat'];
	$lng=$_REQUEST['lng'];
	$type=$_REQUEST['type'];
	$adminid=$_REQUEST['admin'];
	

	include('user.php');
	$obj=new user();
	$row=$obj->addReader($place, $lat, $lng, $type,$adminid);

	if($row==true){
		echo '{"result":1,"message":"Reader added"}';
	}

	else{
		echo '{"result":0,"message":"Reader not added"}';
	}

}

function addAdmin(){
	if(!isset($_REQUEST['orgname'])){
		echo '{"result":0,"message":"Organization name is not given"}';
		return;
	}
	if(!isset($_REQUEST['orgemail'])){
		echo '{"result":0,"message":"Organization email is not given"}';
		return;
	}
	if(!isset($_REQUEST['semail'])){
		echo '{"result":0,"message":"Security email is not given"}';
		return;
	}
	if(!isset($_REQUEST['orgnum'])){
		echo '{"result":0,"message":"Organization phone number is not given"}';
		return;
	}
	if(!isset($_REQUEST['password'])){
		echo '{"result":0,"message":"Password is not given"}';
		return;
	}
	if(!isset($_REQUEST['snum'])){
		echo '{"result":0,"message":"Security phone number is not given"}';
		return;
	}


	if($_REQUEST['orgname']==""){
		echo '{"result":0,"message":"Organization nameis not given"}';
		return;
	}
	if($_REQUEST['orgemail']==""){
		echo '{"result":0,"message":"Organization email is not given"}';
		return;
	}
	if($_REQUEST['semail']==""){
		echo '{"result":0,"message":"Security email is not given"}';
		return;
	}
	if($_REQUEST['orgnum']==""){
		echo '{"result":0,"message":"Organization phone number is not given"}';
		return;
	}
	if($_REQUEST['password']==""){
		echo '{"result":0,"message":"Password is not given"}';
		return;
	}
	if($_REQUEST['snum']==""){
		echo '{"result":0,"message":"Security phone number is not given"}';
		return;
	}


	$orgname=$_REQUEST['orgname'];
	$orgemail=$_REQUEST['orgemail'];
	$semail=$_REQUEST['semail'];
	$orgnum=$_REQUEST['orgnum'];
	$password=$_REQUEST['password'];
	$snum=$_REQUEST['snum'];

	include('user.php');
	$obj=new user();
	$row=$obj->addAmin($orgname, $orgemail, $semail, $orgnum,$password,$snum);

	if($row==true){
		echo '{"result":1,"message":"Sign up successful"}';
	}

	else{
		echo '{"result":0,"message":"Sign up was not successful"}';
	}

}

function loginAdmin(){

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
	$row=$obj->adminlogin($email, $password);
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

function countLocationFrequency(){
	if(!isset($_REQUEST['admin'])){
		echo '{"result":0,"message":"ID is not given"}';
		return;
	}
	if($_REQUEST['admin']==""){
		echo '{"result":0,"message":"ID is not given"}';
		return;
	}

	$id=$_REQUEST['admin'];
	include('user.php');
	$obj=new user();
	$row=$obj->countLocationFrequency($id);
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
		echo '{"result":0,"message":"Could not fetch locations"}';
	}

}

function getsAlerts(){
	if(!isset($_REQUEST['admin'])){
		echo '{"result":0,"message":"ID is not given"}';
		return;
	}
	if($_REQUEST['admin']==""){
		echo '{"result":0,"message":"ID is not given"}';
		return;
	}

	$admin=$_REQUEST['admin'];
	include('user.php');
	$obj=new user();
	$row=$obj->getAlerts($admin);
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
		echo '{"result":0,"message":"Could not fetch alerts"}';
	}

}
function getAllUsers(){
	if(!isset($_REQUEST['admin'])){
		echo '{"result":0,"message":"ID is not given"}';
		return;
	}
	if($_REQUEST['admin']==""){
		echo '{"result":0,"message":"ID is not given"}';
		return;
	}

	$admin=$_REQUEST['admin'];

	include('user.php');
	$obj=new user();
	$row=$obj->getAllUsers($admin);
	if($row==true){
		$row=$obj->fetch();
		echo '{"result":1,"users":[';
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
		echo '{"result":0,"message":"Could not fetch users"}';
	}
}

?>