<?php
//first_choice ranking
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();
		 $sql="UPDATE student_info SET assigned_stream='not assigned'";
           $result1=mysql_query($sql);  
?>



