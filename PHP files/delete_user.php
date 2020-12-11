<?php

require_once __DIR__ . '/db_connect.php';
$response = array();

	$Username = $_POST['Username'];;
	$db = new DB_CONNECT();

	mysql_query("SET NAMES utf8");
	$result=mysql_query("DELETE FROM user WHERE Username='$Username'");
	if($result){
		$response['value']=1;

	}else{
		$response['value']=0;
	}
echo json_encode($response);

?>