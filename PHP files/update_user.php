<?php
require_once __DIR__ . '/db_config.php';

        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) ;
         mysql_select_db(DB_DATABASE);
$response = array();
	$fname = $_POST['F_name'];
	$mname = $_POST['M_name'];
	$email = $_POST['e_mail'];
	$uname = $_POST['U_name'];
	$phone = $_POST['Mobile'];
	$did = $_POST['Userfkey'];
	$result="UPDATE user SET Fname='$fname',Mname='$mname',Email='$email',Userfkey='$did',Mobile='$phone' WHERE Username='$uname'";
	if(mysql_query($result)){
$response['value']=1;
}
else{
$response['value']=0;
}
        mysql_close($con);
echo json_encode($response);
?>
