<?php
    $host = "127.0.0.1"; //Host name 
    $user = "root"; // User 
    $password = ""; // Password 
    $dbname = "hr_on_roadmap"; // Database name

$conn = new mysqli("localhost","root","","hr_on_roadmap");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$out = array('error' => false);
 
$action="show";
 
if(isset($_GET['action'])){
    $action=$_GET['action'];
}
 
if($action=='show'){
    $sql = "select * from tasks";
    $query = $conn->query($sql);
    $registration = array();
 
    while($row = $query->fetch_array()){
        array_push($registration, $row);
    }
 
    $out['registration'] = $registration;
}


if($action=='addtasks'){
    $navn = $_POST['navn'];
    $bedømmelse = $_POST['bedømmelse'];
    $status = $_POST['status'];
    $kommentar = $_POST['kommentar'];
    
    if($navn==''){
        $out['error']=true;
        $out['message']='Add task Failed. navn Empty.';
    }
    elseif($bedømmelse==''){
        $out['error']=true;
        $out['message']='Add task Failed. bedømmelse Empty.';
    }
    elseif($status==''){
        $out['error']=true;
        $out['message']='Add task Failed. status Empty.';
    }
    elseif($kommentar==''){
        $out['error']=true;
        $out['message']='Add bod Failed. kommentar Empty.';
    }
    else{
        $sql="INSERT INTO tasks ( navn, bedømmelse, status, kommentar) VALUES ('$navn', '$bedømmelse', '$estatus', '$kommentar')";
        $query=$conn->query($sql);
    
        if($query){
            $out['message']='Rask Successfully Added';
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