<?php

require_once __DIR__ . '/db_connect.php';
$response = array();
$id=$_POST['ID'];
$db = new DB_CONNECT();

	mysql_query("SET NAMES utf8");
	$result=mysql_query("SELECT * FROM student_account WHERE student_id='$id'");
	if(mysql_num_rows($result)==1){
		
		$response['value']=1;
	}
	else{
		$response['value']=0;
	}
echo json_encode($response);

?>