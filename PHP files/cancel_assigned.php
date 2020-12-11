<?php
require_once __DIR__ . '/db_config.php';

        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) ;
         mysql_select_db(DB_DATABASE);
$response=array();
$cancel_flag="1";
mysql_query("SET NAMES utf8");
if($cancel_flag=="1")
{
			$sql="UPDATE student_info SET final_gpa=0.0,rank='0',assigned_stream='not assigned'";
            $result1=mysql_query($sql);
if(!$result1)
{
die(mysql_error($con));
$response['value']=0;
}
else{
$response['value']=1;
}
        mysql_close($con);
echo json_encode($response);
}
else{
	die(mysql_error($con));
$response['value']=0;
}
?>



