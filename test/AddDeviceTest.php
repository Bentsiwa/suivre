<?php
/**
*@author Efua Bainson
*@method void testAddDevice()
*/
include_once("../user.php");
/**
*AddDeviceTest  class
*/
class AddDeviceTest extends PHPUnit_Framework_TestCase
{
    public function testAddDevice()

    {
           
    /**
    *@var integer $tagID Contains the tagID
    *@var object $obj Contains an instance of user
    */
    
    $tagID=56;
    $obj=new user();
    $this->assertEquals(true,
		$obj->addDevice(
    	"Iphone 6",	//device name
			'A black phone with a blue-black case',		//description
			56,			//tagid
			3,		//userid
			'/Applications/XAMPP/xamppfiles/htdocs/suivre/img/phone.jpg'//image path
			));

		
		//counts the number of fields
		$this->assertCount(8,$obj->fetch());
    }



}
