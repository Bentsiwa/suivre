<?php
/**
*@author Efua Bainson
*@method void testUpdateMedicalComplaint()
*/
include_once("../medicalComplaint.php");
include_once("../medicalComplaintAjax.php");
/**
*AddMedicalComplaintTest  class
*/
class updateMedicalComplaintAjaxTest extends PHPUnit_Framework_TestCase
{
    public function testUpdateMedicalComplaint()
    {
    /**
    *@var integer $url Contains url that links to the server page
    *@var object $obj Contains an instance of medicalComplaint
    */
    $obj=new medicalComplaint();
    $url="medicalComplaintAjax.php?&cmd=1&cid=1&sid=73812017&date='2016-03-27'&temp=38&sympt='Stomach ache'&diag='1'&cause='Playfullness'&presc='Paracetamol'&nid=234";

		$this->asserttrue(true,'{"result":1,"complaint":[{"COMPLAINTID":"1","STUDENTID":"73812017","DATE":"2016-03-27","TEMPERATURE":"38","SYMPTOMS":"Stomach ache","DISEASEID":"1","NAME":"Malaria","CAUSE":"Playfullness","PRESCRIPTION":"Paracetamol","NURSEID":234,"FIRSTNAME":null,"LASTNAME":null},{"COMPLAINTID":"2","STUDENTID":"20402017","DATE":"2016-03-09","TEMPERATURE":"39.50","SYMPTOMS":"Headache","DISEASEID":"3","NAME":"Migraine","CAUSE":"Dehydration","PRESCRIPTION":"Panadol","NURSEID":null,"FIRSTNAME":null,"LASTNAME":null},{"COMPLAINTID":"3","STUDENTID":"73812017","DATE":"2016-03-04","TEMPERATURE":"39.00","SYMPTOMS":"Headache,","DISEASEID":null,"NAME":null,"CAUSE":"Casual","PRESCRIPTION":"Amodiaquine","NURSEID":"1","FIRSTNAME":"Akua","LASTNAME":"Yeboah"},{"COMPLAINTID":"4","STUDENTID":"73812017","DATE":"2016-03-27","TEMPERATURE":"34.00","SYMPTOMS":"Headache","DISEASEID":null,"NAME":null,"CAUSE":"Mosquito","PRESCRIPTION":"Banku","NURSEID":null,"FIRSTNAME":null,"LASTNAME":null},{"COMPLAINTID":"5","STUDENTID":"73812017","DATE":"2016-03-27","TEMPERATURE":"37.00","SYMPTOMS":"dshfdsl","DISEASEID":"3","NAME":"Migraine","CAUSE":"sdljkdsjflksdf","PRESCRIPTION":"dfhladskfjds","NURSEID":null,"FIRSTNAME":null,"LASTNAME":null},{"COMPLAINTID":"6","STUDENTID":"73812017","DATE":"2016-03-08","TEMPERATURE":"28.00","SYMPTOMS":"Stomach","DISEASEID":null,"NAME":null,"CAUSE":"Nail","PRESCRIPTION":"Drink","NURSEID":"234","FIRSTNAME":"John","LASTNAME":"Don"},{"COMPLAINTID":"7","STUDENTID":"73812017","DATE":"2016-04-01","TEMPERATURE":"35.00","SYMPTOMS":"headache","DISEASEID":null,"NAME":null,"CAUSE":"Scorpion","PRESCRIPTION":"Amoxyicilin","NURSEID":null,"FIRSTNAME":null,"LASTNAME":null}],"disease":[{"DISEASEID":"1","NAME":"Malaria"},{"DISEASEID":"2","NAME":"Diarrhoea"},{"DISEASEID":"3","NAME":"Migraine"},{"DISEASEID":"4","NAME":"Syphillis"}]}',$url);

    }



}
