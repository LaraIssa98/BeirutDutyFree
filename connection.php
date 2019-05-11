<?php
    $FirstName = $_REQUEST['fname'] ;
    $LastName = $_REQUEST['lname'] ;
    $username = $_REQUEST['Username'] ;
    $email = $_REQUEST['Email'] ;
    $password = $_REQUEST['Password'] ;
    $gender = $_REQUEST['Gender'];

    if( (!empty($FirstName)) || (!empty($LastName)) ||(!empty($Username)) ||(!empty($email)) ||(!empty($password)) ||(!empty($gender)) ) 
    {
        $host ="localhost";
        $dbUsername = "root";
        $dbPassword = "1234";
        $dbName = "DutyFree";
    
        ##### Step 1 #####

        #create connection
        $conn = mysqli_connect('$host','$dbUsername','$dbPassword','$dbName')
        or die('Error connecting to MySQL server.');

        if (mysqli_connect_error()){
            die('connect error ('. mysqli_connect_errno().') '. mysqli_connect_error());
        }
        else{
            $SELECT = "SELECT email FROM Client_info WHERE email = ? LIMIT 1";
            $INSERT = "INSERT INTO Client_info ( Username, Password, fname, lname, Email, Gender) VALUES (?, ?, ?, ?, ?, ?)";
    }
    
    ##### Step 2 #####

    #Prepare statement
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if($rnum == 0 ){
         $stmt->close();

         $stmt = $conn->prepare($INSERT);
         $stmt->bind_param('sssi', $username, $password, $FirstName, $LastName, $email, $gender);
         $stmt->execute();
         echo "new record inserted succesfully";

    }
    else{
        echo "someone already use this email! "
    }
    $stmt->close();
    $conn->close();

}

else{
    echo "all field are required";
    die();
}
?>


