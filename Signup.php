<?php
  $host="localhost";	 $user = "root";  $pass = "1234";  $db = "DutyFree";
  $con = mysqli_connect($host,$user,$pass,$db);

  $FirstName = $_REQUEST['fname'] ;
  $LastName = $_REQUEST['lname'] ;
  $username = $_REQUEST['Username'] ;
  $email = $_REQUEST['Email'] ;
  $password = $_REQUEST['Password'] ;
  $gender = $_REQUEST['Gender'];

  $query = "SELECT * FROM Client_info where Username= '$username'"; 
  $result = mysqli_query($con, $query) or die ("Error in query: $query. ".mysqli_error($con));
  $records = mysqli_num_rows($result);  //count number of records
  if($records>0) $result="fail, change Username"; 
  else{ 
   	    $query = "insert into Client_info values('$username' , '$password', '$Firstname', '$LastName', '$email', '$gender')"; 
        $result = mysqli_query($con, $query) or die ("Error in query: $query. ".mysqli_error($con));
        $result="success" ;    
	  };
  
  $A["result"]= $result;
  echo json_encode($A);
?>
