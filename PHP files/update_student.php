<?php
require_once __DIR__ . '/db_config.php';

        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) ;
         mysql_select_db(DB_DATABASE);
$response=array();
$fname=$_POST['Fname'];
$mname=$_POST['Mname'];
$lname=$_POST['Lname'];
$gpa=$_POST['GPA'];
$id=$_POST['ID'];
$sex=$_POST['Gender'];
$mobile=$_POST['Mobile'];
$health=$_POST['Spinner_health'];
$result="UPDATE student_info SET fname='$fname',mname='$mname',lname='$lname',gpa='$gpa',sex='$sex',phone_number='$mobile',health_status='$health' WHERE Username='$id'";
	if(mysql_query($result)){
$response['value']=1;
}
else{
$response['value']=0;
}
        mysql_close($con);
echo json_encode($response);
?>