<?php

require_once __DIR__ . '/db_connect.php';
$response = array();
$db = new DB_CONNECT();

	mysql_query("SET NAMES utf8");
	$result=mysql_query("SELECT * FROM stud");
	if(mysql_num_rows($result)>0){

		$response["students"]=array();

		while($row = mysql_fetch_array($result)){
			$student = array();
			$student["Name"]=$row["Name"];
			$student["Mobile"]=$row["Mobile"];
			$student["Email"]=$row["Email"];

			array_push($response["student"], $stud);
		}
		
		$response['value']=1;

	}else{
		$response['value']=0;
	}

echo json_encode($response);

?>