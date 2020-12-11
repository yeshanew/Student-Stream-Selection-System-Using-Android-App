<?php
$con = mysqli_connect('localhost','root','yeshi123','Remote') or die(mysqli_error());
$response = array();
	$name = $_POST['Name'];
	$pass = $_POST['Pass'];
	$ip = $_POST['Ip'];
	$result="UPDATE camera SET name='$name',password='$pass' WHERE ip='$ip'";
	if(!mysqli_query($con,$result))
{
die(mysqli_error($con));
$response['value']=0;
}
else{
$response['value']=1;
}
        mysqli_close($con);
echo json_encode($response);
?>