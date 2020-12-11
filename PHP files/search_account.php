<?php

require_once __DIR__ . '/db_connect.php';
$id=$_POST['ID'];
$response = array();
$db = new DB_CONNECT();

	mysql_query("SET NAMES utf8");
	$result=mysql_query("SELECT * FROM student_account WHERE student_id='$id'");
	if(mysql_num_rows($result)>0){

		$response["account"]=array();
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$account = array();
			$account["ID"]=$row["student_id"];
			$account["Status"]=$row["status"];
			array_push($response["account"], $account);
		}
		
		$response['value']=1;

	}else{
		$response['value']=0;
	}
echo json_encode($response);

?>