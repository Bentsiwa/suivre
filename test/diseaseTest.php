<?php
/**
*@author Efua Bainson
*@method void testGetAllDiseases()
*@method void testAddDisease()
*@method void testEditDiseases()
*@method void testSearchDiseases()
*/
include_once("../diseases.php");
/**
*diseaseTest  class
*/
class diseaseTest extends PHPUnit_Framework_TestCase
{
    public function testGetAllDiseases()
    {
      $obj=new diseases();
      $this->assertEquals(true,$obj->getAllDiseases());
      $this->assertEquals(true,$obj->query("select * from diseases"));

    }

  public function testAddDisease()
  {
    $testName='Malaria';
    $obj=new diseases();
    $this->assertEquals(true,
		$obj->addDisease(
    $testName //name of disease
    ));

		$this->assertEquals(true,$obj->query("select * from diseases where NAME='$testName'"));

  	}

	public function testEditDiseases()
	{
    $testName='Malaria';
    $obj=new diseases();
    $this->assertEquals(true,
		$obj->editDisease(
    $testName,//name of disease
    5 //id of disease
    ));

  $this->assertEquals(true,$obj->query("select * from diseases where NAME='$testName'"));


	}


  public function testSearchDiseases()
	{
    $testName='Malaria';
    $obj=new diseases();
    $this->assertEquals(true,
		$obj->searchDisease(
    $testName//name of disease
    ));

    $this->assertEquals(true,$obj->query("select * from diseases where NAME='$testName'"));


	}
}
