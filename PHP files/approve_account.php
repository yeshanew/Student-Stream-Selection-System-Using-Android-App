<?php
require_once __DIR__ . '/db_config.php';

        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) ;
         mysql_select_db(DB_DATABASE);
$response = array();
	$id = $_POST['ID'];
	$result="UPDATE student_account SET status='Active' WHERE student_id='$id'";
	if(mysql_query($result)){
$response['value']=1;
}
else{
$response['value']=0;
}
        mysql_close($con);
echo json_encode($response);
?>
