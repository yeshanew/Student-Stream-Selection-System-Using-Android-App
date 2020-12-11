<?php
require_once __DIR__ . '/db_config.php';

        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) ;
         mysql_select_db(DB_DATABASE);
$response=array();
$user=$_POST['ID'];
$pass=$_POST['Password'];
$sql="INSERT INTO student_account(student_id,password,status)values('$user','$pass','deactivated')";
if(!mysql_query($sql))
{
die(mysql_error($con));
$response['value']=0;
}
else{
$response['value']=1;
}
        mysql_close($con);
echo json_encode($response);
?>