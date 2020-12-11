<?php

require_once __DIR__ . '/db_connect.php';
$response = array();
$db = new DB_CONNECT();

	mysql_query("SET NAMES utf8");
	$result=mysql_query("SELECT * FROM stream");
	if(mysql_num_rows($result)>0){

		$response["stream"]=array();
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$stream = array();
			$stream["Name"]=$row["name"];
			$stream["Stream_id"]=$row["stream_id"];
			$stream["Required"]=$row["required"];
			array_push($response["stream"], $stream);
		}
		
		$response['value']=1;

	}else{
		$response['value']=0;
	}
echo json_encode($response);

?>