<?php
require_once __DIR__ . '/db_config.php';

        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) ;
         mysql_select_db(DB_DATABASE);
$response=array();
$u=$_POST['User'];
$p=$_POST['Pass'];
$sql="select * from user where password='$u' && username='$p'";
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