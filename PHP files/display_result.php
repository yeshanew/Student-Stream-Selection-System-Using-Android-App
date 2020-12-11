<?php

require_once __DIR__ . '/db_connect.php';
$response = array();
$passed_id=$_POST['Passed_id'];
$db = new DB_CONNECT();

	mysql_query("SET NAMES utf8");
	$result=mysql_query("SELECT * FROM student_info WHERE student_id='$passed_id'");
	if(mysql_num_rows($result)==1){

		$response["student"]=array();
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$student = array();
			$student["Fname"]=$row["fname"];
		    $student["Mname"]=$row["mname"];
			$student["Lname"]=$row["lname"];
			$student["GPA"]=$row["gpa"];
		    $student["ID"]=$row["student_id"];
			$student["Assigned_stream"]=$row["assigned_stream"];
			array_push($response["student"], $student);
		}
		
		$response['value']=1;

	}else{
		$response['value']=0;
	}
echo json_encode($response);

?>