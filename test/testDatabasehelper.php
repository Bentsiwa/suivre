<?php
include_once("../databasehelper.php");
/**
*@author Efua Bentsiwa Bainson
*testDatabasehelper class
*@method testConnect() should test connect function from databasehelper class
*@method testQuery()  should test query function from databasehelper class
*@method testFetch() should test fetch function from databasehelper class
*/

class testDatabasehelper extends PHPUnit_Framework_TestCase
{
  /**
  *Test connect function
  *@return boolean returns true or false after test
  */
    public function testConnect()
    {
      /**
      *@var DatabaseHelperObject $databasehelper should create an instance of databasehelper class and returns boolean
      */
        $databasehelper=new databasehelper();
        $this->assertEquals(true, $databasehelper->connect());
		return $databasehelper;
    }

    /**
    *test Query function
    *@param  $databasehelper test sql string to execute and return result after test
    *@return boolean returns true or false after test
    */
	public function testQuery($databasehelper)
	{
		$this->assertEquals(true,$databasehelper->query("select * from user"));
		return $databasehelper;
	}

	/**
	*test Fetch Function
  *@param  $databasehelper should test fetch function and return result after test
  *@return boolean returns true or false after test
	*/
	public function testFetch($databasehelper)
	{
		$row=$databasehelper->fetch();
		$this->assertGreaterThan(0,count($row));

	}
}
