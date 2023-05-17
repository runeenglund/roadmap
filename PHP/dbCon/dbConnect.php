<?php
    $host = "127.0.0.1"; //Host name 
    $user = "root"; // User 
    $password = ""; // Password 
    $dbname = "test1"; // Database name

$conn = new mysqli("localhost","root","","test1");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$out = array('error' => false);
 
$action="show";
 
if(isset($_GET['action'])){
    $action=$_GET['action'];
}
 
if($action=='show'){
    $sql = "select * from registration";
    $query = $conn->query($sql);
    $registration = array();
 
    while($row = $query->fetch_array()){
        array_push($registration, $row);
    }
 
    $out['registration'] = $registration;
}


if($action=='add'){
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
 
    if($firstName==''){
        $out['error']=true;
        $out['message']='Add Member Failed. firstname Empty.';
    }
    elseif($lastName==''){
        $out['error']=true;
        $out['message']='Add Member Failed. lastName Empty.';
    }
    else{
        $sql="insert into registration ( firstName, lastName) values ('$firstName', '$lastName')";
        $query=$conn->query($sql);
 
        if($query){
            $out['message']='Member Successfully Added';
        }
        else{
            $out['error']=true;
            $out['message']='Error in Adding Occured';
        }
         
    }
}

$conn->close();
 
header("Content-type: application/json");
echo json_encode($out);
die();



?>