<?php
require_once __DIR__ . '/db_config.php';

        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) ;
         mysql_select_db(DB_DATABASE);
$response=array();;
$engineering_assigned_counter=0;
$pharmacy_assigned_counter=0;
$health_assigned_counter=0;
$female_value=$_POST['Female_value'];
$disablity_value=$_POST['Disablity_value'];
$female_perecent=(4*$female_value)/100;
$disablity_perecent=(4*$disablity_value )/100;
$sql=mysql_query("UPDATE affirmative SET female_percent='$female_value',disablity_percent='$disablity_value'");
if($sql){
$result=mysql_query("SELECT * FROM student_info");
		while($row = mysql_fetch_array($result)){
			$gpa=$row['gpa'];
			$sex=$row['sex'];
			$health=$row['health_status'];
		    $x=$row['student_id'];
			if($sex=="Female"){
			$gpa=$gpa+$female_perecent;
			}
			if($health=="Disable"){
			$gpa=$gpa+$disablity_perecent;
			}
			else 
			$gpa=$gpa;
			$sql="UPDATE student_info SET final_gpa='$gpa' Where student_id=$x";
            $result1=mysql_query($sql);
	}
mysql_query("SET NAMES utf8");
//first_choice ranking
	$result=mysql_query("SELECT * FROM student_info where first_choice='Engineering' ORDER BY final_gpa DESC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$counter=$counter+1;
			$x=$row['student_id'];
			$sql="UPDATE student_info SET rank='$counter' Where student_id=$x";
            $result1=mysql_query($sql);
	}}

$result=mysql_query("SELECT * FROM student_info where first_choice='Pharmacy' ORDER BY final_gpa DESC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$counter=$counter+1;
			$x=$row['student_id'];
			$sql="UPDATE student_info SET rank='$counter' Where student_id=$x";
            $result1=mysql_query($sql);
	}}
	
	$result=mysql_query("SELECT * FROM student_info where first_choice='Health' ORDER BY final_gpa DESC ");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$counter=$counter+1;
			$x=$row['student_id'];
			$sql="UPDATE student_info SET rank='$counter' Where student_id=$x";
            $result1=mysql_query($sql);
	}}

// first choice selection

	$result=mysql_query("SELECT * FROM student_info where first_choice='Engineering' ORDER BY rank ASC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
		   $x=$row['student_id'];
           $rank=$row["rank"];
		   $final_gpa=$row["final_gpa"];
		   $fchoice=$row["first_choice"];
		   $result1=mysql_query("SELECT * FROM stream where name='$fchoice'");
		   if(mysql_num_rows($result1)>0){
	$row1 = mysql_fetch_array($result1);
	       $min_final_gpa=$row1["min_final_gpa"];
	       $required=$row1["required"];
	       $Engineering_remain=$required-$engineering_assigned_counter;
		   if($Engineering_remain>0){
	       //$selection_result=($rank/($Engineering_remain));
		   if($final_gpa>=$min_final_gpa)
		   {
		 $sql="UPDATE student_info SET assigned_stream='$fchoice' Where student_id=$x";
           $result1=mysql_query($sql); 
$engineering_assigned_counter=$engineering_assigned_counter+1;			   
		   
		   }}}}
	}

$result=mysql_query("SELECT * FROM student_info where first_choice='Health' ORDER BY rank ASC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$x=$row['student_id'];
           $rank=$row["rank"];
		   $final_gpa=$row["final_gpa"];
		   $fchoice=$row["first_choice"];
		   $result1=mysql_query("SELECT * FROM stream where name='$fchoice'");
		   if(mysql_num_rows($result1)>0){
	$row1 = mysql_fetch_array($result1);
	       $min_final_gpa=$row1["min_final_gpa"];
	       $required=$row1["required"];
		   $health_remain=$required-$health_assigned_counter;
		   if($health_remain>0){
	      // $selection_result=($rank/($health_remain));
		   if($final_gpa>=$min_final_gpa)
		   {
		 $sql="UPDATE student_info SET assigned_stream='$fchoice' Where student_id=$x";
           $result1=mysql_query($sql);  
		  $health_assigned_counter=$health_assigned_counter+1;
		   
		}}}}
	}

$result=mysql_query("SELECT * FROM student_info where first_choice='Pharmacy' ORDER BY rank ASC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$x=$row['student_id'];
           $rank=$row["rank"];
		   $final_gpa=$row["final_gpa"];
		   $fchoice=$row["first_choice"];
		   $result1=mysql_query("SELECT * FROM stream where name='$fchoice'");
		   if(mysql_num_rows($result1)>0){
	$row1 = mysql_fetch_array($result1);
	       $min_final_gpa=$row1["min_final_gpa"];
	       $required=$row1["required"];
		  $pharmacy_remain=$required-$pharmacy_assigned_counter;
		  if($pharmacy_remain>0){
	       //$selection_result=($rank/($pharmacy_remain));
		   if($final_gpa>=$min_final_gpa)
		   {
		 $sql="UPDATE student_info SET assigned_stream='$fchoice' Where student_id=$x";
           $result1=mysql_query($sql);  
		 $pharmacy_assigned_counter=$pharmacy_assigned_counter+1;
		   
		}}}}
	}
//second_choice ranking
	$result=mysql_query("SELECT * FROM student_info where second_choice='Engineering' and assigned_stream ='not assigned' ORDER BY final_gpa DESC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$counter=$counter+1;
			$x=$row['student_id'];
			$sql="UPDATE student_info SET rank='$counter' Where student_id=$x";
            $result1=mysql_query($sql);
	}}

$result=mysql_query("SELECT * FROM student_info where second_choice='Pharmacy' and assigned_stream ='not assigned' ORDER BY final_gpa DESC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$counter=$counter+1;
			$x=$row['student_id'];
			$sql="UPDATE student_info SET rank='$counter' Where student_id=$x";
            $result1=mysql_query($sql);
	}}
	
	$result=mysql_query("SELECT * FROM student_info where second_choice='Health' and assigned_stream ='not assigned' ORDER BY final_gpa DESC ");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$counter=$counter+1;
			$x=$row['student_id'];
			$sql="UPDATE student_info SET rank='$counter' Where student_id=$x";
            $result1=mysql_query($sql);
	}}

// second choice selection
	$result=mysql_query("SELECT * FROM student_info where second_choice='Engineering' and assigned_stream ='not assigned' ORDER BY rank ASC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$x=$row['student_id'];
           $rank=$row["rank"];
		   $final_gpa=$row["final_gpa"];
		   $schoice=$row["second_choice"];
		   $result1=mysql_query("SELECT * FROM stream where name='$schoice'");
		   if(mysql_num_rows($result1)>0){
	$row1 = mysql_fetch_array($result1);
	       $min_final_gpa=$row1["min_final_gpa"];
	       $required=$row1["required"];
		   $Engineering_remain=$required-$engineering_assigned_counter;
		   if($Engineering_remain>0){
	       //$selection_result=($rank/($Engineering_remain));
		   if($final_gpa>=$min_final_gpa)
		   {
		 $sql="UPDATE student_info SET assigned_stream='$schoice' Where student_id=$x";
           $result1=mysql_query($sql); 
$engineering_assigned_counter=$engineering_assigned_counter+1;			   
		   
		   }}}}
	}

$result=mysql_query("SELECT * FROM student_info where second_choice='Health' and  assigned_stream ='not assigned' ORDER BY rank ASC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$x=$row['student_id'];
           $rank=$row["rank"];
		   $final_gpa=$row["final_gpa"];
		   $schoice=$row["second_choice"];
		   $result1=mysql_query("SELECT * FROM stream where name='$schoice'");
		   if(mysql_num_rows($result1)>0){
	$row1 = mysql_fetch_array($result1);
	       $min_final_gpa=$row1["min_final_gpa"];
	       $required=$row1["required"];
		   $health_remain=$required-$health_assigned_counter;
		   if($health_remain>0){
	      // $selection_result=($rank/($health_remain));
		   if($final_gpa>=$min_final_gpa)
		   {
		 $sql="UPDATE student_info SET assigned_stream='$schoice' Where student_id=$x";
           $result1=mysql_query($sql); 
$health_assigned_counter=$health_assigned_counter+1;		   
		   
		   }}}}
	}


$result=mysql_query("SELECT * FROM student_info where second_choice='Pharmacy' and assigned_stream ='not assigned' ORDER BY rank ASC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$x=$row['student_id'];
           $rank=$row["rank"];
		   $final_gpa=$row["final_gpa"];
		   $schoice=$row["second_choice"];
		   $result1=mysql_query("SELECT * FROM stream where name='$schoice'");
		   if(mysql_num_rows($result1)>0){
	$row1 = mysql_fetch_array($result1);
		  echo $row1["min_final_gpa"];
	       $min_final_gpa=$row1["min_final_gpa"];
	       $required=$row1["required"];
		   $pharmacy_remain=$required-$pharmacy_assigned_counter;
		   if($pharmacy_remain>0){
	       //$selection_result=($rank/($pharmacy_remain));
		   if($final_gpa>=$min_final_gpa)
		   {
		 $sql="UPDATE student_info SET assigned_stream='$schoice' Where student_id=$x";
           $result1=mysql_query($sql);  
		   $pharmacy_assigned_counter=$pharmacy_assigned_counter+1;
		}}}}
	}
//third_choice ranking
	$result=mysql_query("SELECT * FROM student_info where third_choice='Engineering' and assigned_stream ='not assigned' ORDER BY final_gpa DESC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$counter=$counter+1;
			$x=$row['student_id'];
			$sql="UPDATE student_info SET rank='$counter' Where student_id=$x";
            $result1=mysql_query($sql);
	}}

$result=mysql_query("SELECT * FROM student_info where third_choice='Pharmacy' and assigned_stream ='not assigned' ORDER BY final_gpa DESC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$counter=$counter+1;
			$x=$row['student_id'];
			$sql="UPDATE student_info SET rank='$counter' Where student_id=$x";
            $result1=mysql_query($sql);
	}}
	
	$result=mysql_query("SELECT * FROM student_info where third_choice='Health' and assigned_stream ='not assigned' ORDER BY final_gpa DESC ");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$counter=$counter+1;
			$x=$row['student_id'];
			$sql="UPDATE student_info SET rank='$counter' Where student_id=$x";
            $result1=mysql_query($sql);
	}}

// third choice selection
	$result=mysql_query("SELECT * FROM student_info where third_choice='Engineering' and assigned_stream ='not assigned' ORDER BY rank ASC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$x=$row['student_id'];
           $rank=$row["rank"];
		   $final_gpa=$row["final_gpa"];
		   $tchoice=$row["second_choice"];
		   $result1=mysql_query("SELECT * FROM stream where name='$tchoice'");
		   if(mysql_num_rows($result1)>0){
	$row1 = mysql_fetch_array($result1);
	       $min_final_gpa=$row1["min_final_gpa"];
	       $required=$row1["required"];
	       $remain_engineering=$required-$engineering_assigned_counter;
		   if($remain_engineering>0){
	       //$selection_result=($rank/($remain_engineering));
		   if($final_gpa>=$min_final_gpa)
		   {
		 $sql="UPDATE student_info SET assigned_stream='$schoice' Where student_id=$x";
           $result1=mysql_query($sql); 
$engineering_assigned_counter=$engineering_assigned_counter+1;			   
		   
		   }}}}
	}

$result=mysql_query("SELECT * FROM student_info where third_choice='Health' and assigned_stream ='not assigned' ORDER BY rank ASC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$x=$row['student_id'];
           $rank=$row["rank"];
		   $final_gpa=$row["final_gpa"];
		   $tchoice=$row["second_choice"];
		   $result1=mysql_query("SELECT * FROM stream where name='$tchoice'");
		   if(mysql_num_rows($result1)>0){
	$row1 = mysql_fetch_array($result1);
	       $min_final_gpa=$row1["min_final_gpa"];
	       $required=$row1["required"];
		   $remain_health=$required-$health_assigned_counter;
	       //$selection_result=($rank/($remain_health));
		   if($final_gpa>=$min_final_gpa)
		   {
		 $sql="UPDATE student_info SET assigned_stream='$tchoice' Where student_id=$x";
           $result1=mysql_query($sql);  
		   $health_assigned_counter=$health_assigned_counter+1;
		}
		}}
	}
$result=mysql_query("SELECT * FROM student_info where third_choice='Pharmacy' and assigned_stream ='not assigned' ORDER BY rank ASC");
	if(mysql_num_rows($result)>0){
    $counter=0;
		while($row = mysql_fetch_array($result)){
			$x=$row['student_id'];
           $rank=$row["rank"];
		   $final_gpa=$row["final_gpa"];
		   $tchoice=$row["second_choice"];
		   $result1=mysql_query("SELECT * FROM stream where name='$tchoice'");
		   if(mysql_num_rows($result1)>0){
	$row1 = mysql_fetch_array($result1);
	       $min_final_gpa=$row1["min_final_gpa"];
	       $required=$row1["required"];
		   $remain_pharmacy=$required-$pharmacy_assigned_counter;
		   if($remain_pharmacy>0){
	       //$selection_result=($rank/($remain_pharmacy));
		   if($final_gpa>=$min_final_gpa)
		   {
		 $sql="UPDATE student_info SET assigned_stream='$tchoice' Where student_id=$x";
           $result1=mysql_query($sql);  
		  $pharmacy_assigned_counter=$pharmacy_assigned_counter+1;
		   
		   }}
		}}
	}
$assigned="UPDATE stream SET assigned='$engineering_assigned_counter' Where name='Engineering'";
$result1=mysql_query($assigned);
$assigned="UPDATE stream SET assigned='$pharmacy_assigned_counter' Where name='Pharmacy'";
$result2=mysql_query($assigned);
$assigned="UPDATE stream SET assigned='$health_assigned_counter' Where name='health'";
$result3=mysql_query($assigned);
if(!$result1 or !$result2 or!$result3)
{
die(mysql_error($con));
$response['value']=0;
}
else{
$response['value']=1;
}
        mysql_close($con);
echo json_encode($response);
}
?>



