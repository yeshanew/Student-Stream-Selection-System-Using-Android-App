<?php
require_once __DIR__ . '/db_config.php';

        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) ;
         mysql_select_db(DB_DATABASE);
$response=array();
$id=$_POST['Id'];
$pass=$_POST['Pass'];
$sql="select * from student_account where student_id='$id' && password='$pass' && status='Active'";
$result=mysql_query($sql);
$row=mysql_num_rows($result);
if($row==1)
{
$response["student"]=array();
		while($row = mysql_fetch_array($result)){
			$student = array();
		    $student["Student_id'"]=$row["student_id"];
			array_push($response["student"], $student);
		}
$response['value']=1;
}
else
{
$response['value']=0;
}
        mysql_close($con);
echo json_encode($response);
?>