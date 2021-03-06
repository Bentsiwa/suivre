<?php
/**
*@author makafui fie
*testEditStudentRecord class
*/
include_once("..\medicalComplaint.php");
	class testEditComplaint extends PHPUnit_Framework_TestCase{
		public function testComplaint(){
			$complaint=new medicalComplaint();

			$this->assertEquals(true, $complaint->updateComplaint(2, 2343243, 37, 'headache, cold', 2, "stress", "Anti-depressants", 34573243));
			
			  $result=$complaint->getComplaintByID(2);
			  $row=$complaint->fetch();
			 $this->assertEquals("Anti-depressants",$row['PRESCRIPTION'] );

		} 

		public function testGetStudentByID(){
			$complaint=new medicalComplaint();
			$result=$complaint->getComplaintByID(3);
			$this->assertEquals(true, $result);
			$row=$complaint->fetch();
			$this->assertEquals(3, $row['COMPLAINTID']);
		}


	}
?>