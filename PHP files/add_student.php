<?php
require_once __DIR__ . '/db_config.php';

        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) ;
         mysql_select_db(DB_DATABASE);
$response=array();
$fname=$_POST['Fname'];
$mname=$_POST['Mname'];
$lname=$_POST['Lname'];
$gpa=$_POST['Gpa'];
$id=$_POST['Student_id'];
$sex=$_POST['Sex'];
$mobile=$_POST['Phone_no'];
$health=$_POST['Health'];
$sql="INSERT INTO student_info(fname,mname,lname,gpa,student_id,sex,phone_number,health_status)values('$fname','$mname','$lname','$gpa','$id','$sex','$mobile','$health')";
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