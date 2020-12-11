<?php

require_once __DIR__ . '/db_connect.php';
$response = array();
$db = new DB_CONNECT();

	mysql_query("SET NAMES utf8");
	$result=mysql_query("SELECT * FROM student_info where first_choice='Engineering' ORDER BY gpa DESC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$counter=$counter+1;
			$x=$row['student_id'];
			$sql="UPDATE student_info SET rank='$counter' Where student_id=$x";
            $result1=mysql_query($sql);
	}}

$result=mysql_query("SELECT * FROM student_info where first_choice='Pharmacy' ORDER BY gpa DESC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$counter=$counter+1;
			$x=$row['student_id'];
			$sql="UPDATE student_info SET rank='$counter' Where student_id=$x";
            $result1=mysql_query($sql);
	}}
	
	$result=mysql_query("SELECT * FROM student_info where first_choice='Health' ORDER BY gpa DESC ");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$counter=$counter+1;
			$x=$row['student_id'];
			$sql="UPDATE student_info SET rank='$counter' Where student_id=$x";
            $result1=mysql_query($sql);
	}}
?>