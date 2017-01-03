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
			$strQuery="select * from client where password like '$password' and email like '$email'";
			
			return $this->query($strQuery);
		}


		
		function addUser($fullname,$email,$tel,$org,$password){
			/**
			*@var string $strQuery should contain insert query
			*/
			$strQuery="insert into client set
			fullname ='$fullname',
							email='$email',
							tel='$tel',
							org='$org',
							password='$password'";
				
			return $this->query($strQuery);
		}

		function updatePool($boolean,$id,$mode,$numpeople){
			/**
			*@var string $strQuery should contain insert query
			*/
			$strQuery="update carpool set isJoined=$boolean, paymentMode='$mode', numpeoplejoined=$numpeople where cid=$id";
			return $this->query($strQuery);
		}

		function addPool($email,$source,$destination,$date, $starttime,$endtime,$numpeople, $carregistration,$cartype,$broadcast){
			/**
			*@var string $strQuery should contain insert query
			*/
			$strQuery="insert into carpool set
			email='$email',
			startplace ='$source',
							destination='$destination',
							dateoftravel='$date',
							starttime='$starttime',
							endtime='$endtime',
							numpeople=$numpeople,
							carregistration='$carregistration',
							cartype='$cartype',
							broadcast='$broadcast'";
							
			return $this->query($strQuery);

		}
		function getPool(){
			/**
			*@var string $strQuery should contain insert query
			*/
			$strQuery="select * from carpool";
							
			return $this->query($strQuery);

		}
		function getNews(){
			/**
			*@var string $strQuery should contain insert query
			*/
			$strQuery="select * from news";
							
			return $this->query($strQuery);

		}
		function getUser($email){
			$strQuery="select phone from user where email='$email'";
			
			return $this->query($strQuery);
		}

		function addimage($location,$description){
			$strQuery="insert into news set location='$location',description='$description'";
			return $this->query($strQuery);
		}
	}

?>

