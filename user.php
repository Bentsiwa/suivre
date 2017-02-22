<?php
	include_once("databasehelper.php");
	/**
	*User class
	*/

	class user extends databasehelper{

		function user(){

		}
		/**
		*log in a user
		*@param string password password of user
		*@param string email email of user
		*@return boolean returns true if successful or false
		*/
		function login($email,$password){
			/**
			*@var string $strQuery should contain insert query
			*/
			$strQuery="select * from user where password like '$password' and email like '$email'";
			
			return $this->query($strQuery);
		}


		
		function addUser($firstname,$lastname,$email,$tel, $password){
			/**
			*@var string $strQuery should contain insert query
			*/
			$strQuery="insert into user set
			firstname ='$firstname',
							email='$email',
							phone='$tel',
							lastname='$lastname',
							password='$password'";
						
				
			return $this->query($strQuery);
		}

		function editDevice($device,$description, $tag,$id,$deviceid){
			/**
			*@var string $strQuery should contain insert query
			*/
			
			$strQuery="update device set
			name='$device',
			description ='$description',
			tagidentification='$tag',
			userid='$id'
			where deviceid=$deviceid";
			return $this->query($strQuery);
		}

		function addDevice($device,$description, $tag,$id){
			/**
			*@var string $strQuery should contain insert query
			*/
			$strQuery="insert into device set
			name='$device',
			description ='$description',
			tagidentification='$tag',
			image='img/green.jpg',
			userid='$id'";
							
			return $this->query($strQuery);

		}

		function getLocation($location){
			/**
			*@var string $strQuery should contain insert query
			*/
			$strQuery="select * from location where placename='$location'";

							
			return $this->query($strQuery);

		}
		
		function getDevices($id=false){
			$strQuery="select * from device";

			if($id!=false){
                $strQuery=$strQuery . " where userid=$id";
            }
			
			return $this->query($strQuery);
		}

		function getDeviceLocation($filter=false){
			$strQuery="select device.deviceid, device.name, device.image, location.placename, location.type, location.latitude, location.longitude, devicelocation.time from location inner join devicelocation on location.locationid=devicelocation.locationid inner join device on devicelocation.deviceid=device.deviceid";

			if($filter!=false){
                $strQuery=$strQuery . " where device.deviceid='$filter'";
            }

            //$strQuery=$strQuery . "ORDER BY devicelocation.time DESC";

         
			return $this->query($strQuery);
		}

		function deleteDevice($deviceid){
			$strQuery="delete from device where deviceid='$deviceid'";
			return $this->query($strQuery);
		}

		function addDeviceLocation($device,$currentdatetime,$location){
			$strQuery="insert into devicelocation set
			deviceid='$device',
			locationid ='$location',
			time='$currentdatetime'";
							
			return $this->query($strQuery);
		}


		function findDevice($tag){
				$strQuery="select deviceid from device where tagidentification='$tag'";

							
			return $this->query($strQuery);
		}

		function getLocations(){
			$strQuery="select * from location";
			
			return $this->query($strQuery);
		}

		function updatingtest($image){
			$strQuery="update device set
			image='$image'
			where deviceid=21";
			return $this->query($strQuery);

		}
	}

?>