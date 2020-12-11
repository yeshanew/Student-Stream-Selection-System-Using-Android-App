<?php
require_once __DIR__ . '/db_config.php';

        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) ;
		$query = 'CREATE DATABASE school';
        mysql_query($query, $con) or die(mysql_error($con));
         mysql_select_db(DB_DATABASE);
$query1 = 'CREATE TABLE user (      
Fname      VARCHAR(255)        NOT NULL,
Mname      VARCHAR(255)        NOT NULL,
Lname      VARCHAR(255)        NOT NULL,
Userfkey      VARCHAR(255)        NOT NULL,
Username     VARCHAR(255)        NOT NULL,
Email     VARCHAR(255)        NOT NULL,   
Mobile     VARCHAR(255)      NOT NULL,
PRIMARY KEY (username)  
       ) 
  ENGINE=MyISAM';
  mysql_query($query1, $con) or die (mysql_error($con));
$query2 = 'CREATE TABLE department (      
dpt_id      VARCHAR(255)        NOT NULL,
dpt_name      VARCHAR(255)        NOT NULL,
college_id      VARCHAR(255)        NOT NULL,
PRIMARY KEY (dpt_id)  
       ) 
  ENGINE=MyISAM';
  mysql_query($query2, $con) or die (mysql_error($con));
  $query3 = 'CREATE TABLE course (      
course_code      VARCHAR(255)        NOT NULL,
course_name      VARCHAR(255)        NOT NULL,
dpt_id      VARCHAR(255)        NOT NULL,
start_date      VARCHAR(255)        NOT NULL,
end_date     VARCHAR(255)        NOT NULL,
PRIMARY KEY (course_code)  
       ) 
  ENGINE=MyISAM';
  mysql_query($query3, $con) or die (mysql_error($con));
   $query4 = 'CREATE TABLE college (      
college_id     VARCHAR(255)        NOT NULL,
college_name      VARCHAR(255)        NOT NULL,
PRIMARY KEY (college_id)  
       ) 
  ENGINE=MyISAM';
mysql_query($query4, $con) or die (mysql_error($con));
   $query5 = 'CREATE TABLE assigned_course (      
username     VARCHAR(255)        NOT NULL,
course_id      VARCHAR(255)        NOT NULL, 
       ) 
  ENGINE=MyISAM';
mysql_query($query5, $con) or die (mysql_error($con));
echo"Table is successfully created"
?>