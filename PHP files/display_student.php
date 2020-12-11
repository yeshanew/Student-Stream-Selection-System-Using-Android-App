<?php

require_once __DIR__ . '/db_connect.php';
$response = array();
$db = new DB_CONNECT();

	mysql_query("SET NAMES utf8");
	$result=mysql_query("SELECT * FROM student_info ORDER BY gpa desc");
	if(mysql_num_rows($result)>0){

		$response["student"]=array();
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$student = array();
			$student["Fname"]=$row["fname"];
			$student["Mname"]=$row["mname"];
			$student["Lname"]=$row["lname"];
			$student["GPA"]=$row["gpa"];
		    $student["ID"]=$row["student_id"];
			$student["Gender"]=$row["sex"];
			$student["Mobile"]=$row["phone_number"];
			$student["Health"]=$row["health_status"];
			$student["Assigned_stream"]=$row["assigned_stream"];
			array_push($response["student"], $student);
		}
		
		$response['value']=1;

	}else{
		$response['value']=0;
	}
echo json_encode($response);

?>