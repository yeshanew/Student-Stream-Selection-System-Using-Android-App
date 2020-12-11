<?php
require_once __DIR__ . '/db_config.php';

        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) ;
         mysql_select_db(DB_DATABASE);
$response=array();
$user=$_POST['User'];
$pass=$_POST['Pass'];
$sql="select * from admin_account where password='$pass' && username='$user' and status='active'";
$result=mysql_query($sql);
$row=mysql_num_rows($result);
if($row==1)
{
$response['value']=1;
}
else
{
$response['value']=0;
}
        mysql_close($con);
echo json_encode($response);
?>