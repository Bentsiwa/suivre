<?php
/**
*@author Efua Bainson
*@method void testAddMedicalComplaint()
*/
include_once("../user.php");
/**
*AddMedicalComplaintTest  class
*/
class AddDeviceTest extends PHPUnit_Framework_TestCase
{
    public function testAddDevice()

    {
           
    /**
    *@var integer $testStudentID Contains studentID
    *@var object $obj Contains an instance of medicalComplaint
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

		$this->assertEquals(true,$obj->query("select * from device where tagidentification=$testStudentID"));
		//counts the number of fields
		$this->assertCount(9,$obj->fetch());
    }
   ($device,$description, $tag,$id, $image)


}
