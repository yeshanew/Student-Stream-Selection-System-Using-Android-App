<?php
require_once __DIR__ . '/db_config.php';

        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) ;
         mysql_select_db(DB_DATABASE);
$response=array();
$first_choice=$_POST['Fchoice'];
$second_choice=$_POST['Schoice'];
$third_choice=$_POST['Tchoice'];
$sql="INSERT INTO student_info(first_choice,second_choice,third_choice)values('$first_choice','$second_choice','$third_choice')";
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