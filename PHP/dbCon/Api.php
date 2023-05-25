<?php
    $host = "127.0.0.1"; //Host name 
    $user = "root"; // User 
    $password = ""; // Password 
    $dbname = "roadmap"; // Database name

    $conn = new mysqli("127.0.0.1","root","","roadmap");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $action="show";
    
    if(isset($_GET['action'])){
        $action=$_GET['action'];
    }
    
    // CRUD ********************************
    if($action=='tasks'){
    $sql = "SELECT * FROM tasks";
    $query = $conn->query($sql);
    $tasks = array();
 
    while($row = $query->fetch_array()){
        array_push($tasks, $row);
    }
 
    $out['tasks'] = $tasks;

    echo json_encode($out);
    }
    
    if($action=='addtasks'){
       /*  $navn = $_POST["navn"];
        $taskStatus = $_POST["taskStatus"]; */
       /*  $bedømmelse = $_POST['bedømmelse'] ?? null;
        $kommentar = $_POST['kommentar'] ?? null; */
     
        $sql="INSERT INTO tasks (navn, taskStatus) VALUES (?, ?)";
       
        $stmt = mysqli_stmt_init($conn);

        if( ! mysqli_stmt_prepare($stmt, $sql)) {
            die(mysqli_error($conn));

        }

        mysqli_stmt_bind_param($stmt, "si", $navn, $taskStatus);
        mysqli_stmt_execute($stmt);
        
        echo "task uploaded";

       /*  $query=$conn->query($sql); */
    }
    
    if($action=='updatetasks'){
        $navn = $_PUT['navn'];
        $bedømmelse = $_PUT['bedømmelse'];
        $status = $_PUT['status'];
        $kommentar = $_PUT['kommentar'];
     
        $sql="UPDATE tasks SET navn='$navn', bedømmelse='$bedømmelse', status='$status', kommentar='$kommentar'";
        $query=$conn->query($sql);
        
        if($query){
            $out['message']='Task Successfully Updatet';
        }
        else{
            $out['error']=true;
            $out['message']='Error in Updating Occured';
        }
    }
    
    if($action=='deletetasks'){
     
        $sql="DELETE FROM tasks WHERE navn=$navn";
        $query=$conn->query($sql);

    }
    

    //Close connection
    $conn->close();
     
    header("Content-type: application/json");
    die();
  
?>