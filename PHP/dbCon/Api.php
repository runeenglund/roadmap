<?php
    $host = "127.0.0.1"; //Host name 
    $user = "root"; // User 
    $password = ""; // Password 
    $dbname = "storms1"; // Database name

    $conn = new mysqli("localhost","root","","storms1");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $out = array('error' => false);
    
    $action="show";
    
    if(isset($_GET['action'])){
        $action=$_GET['action'];
    }
    
    // CRUD ********************************
    if($action=='showboder'){
    $sql = "SELECT * FROM boder";
    $query = $conn->query($sql);
    $boder = array();
 
    while($row = $query->fetch_array()){
        array_push($boder, $row);
    }
 
    $out['boder'] = $boder;
    }
    
    if($action=='addboder'){
        $bodnr = $_POST['bod_nr'];
        $bodnavn = $_POST['bod_navn'];
        $email = $_POST['email'];
        $adgangskode = $_POST['adgangskode'];
     
        if($bodnr==''){
            $out['error']=true;
            $out['message']='Add bod Failed. bodnr Empty.';
        }
        elseif($bodnavn==''){
            $out['error']=true;
            $out['message']='Add bod Failed. bodnavn Empty.';
        }
        elseif($email==''){
            $out['error']=true;
            $out['message']='Add bod Failed. email Empty.';
        }
        elseif($adgangskode==''){
            $out['error']=true;
            $out['message']='Add bod Failed. adgangskode Empty.';
        }
        else{
            $sql="INSERT INTO boder ( bod_nr, bod_navn, email, adgangskode) VALUES ('$bodnr', '$bodnavn', '$email', '$adgangskode')";
            $query=$conn->query($sql);
     
            if($query){
                $out['message']='Bod Successfully Added';
            }
            else{
                $out['error']=true;
                $out['message']='Error in Adding Occured';
            }
    
        }
    }
    
    if($action=='updateboder'){
        $bodnr = $_PUT['bod_nr'];
        $bodnavn = $_PUT['bod_navn'];
        $email = $_PUT['email'];
        $adgangskode = $_PUT['adgangskode'];
     
        $sql="UPDATE boder SET bod_nr='$bodnr', bod_navn='$bodnavn', email='$email', adgangskode='$adgangskode'";
        $query=$conn->query($sql);
        
        if($query){
            $out['message']='Bod Successfully Updatet';
        }
        else{
            $out['error']=true;
            $out['message']='Error in Updating Occured';
        }
    }
    
    if($action=='deleteboder'){
     
        $sql="DELETE FROM boder WHERE bod_nr=$bodnr";
        $query=$conn->query($sql);

    }
    
    
    //Retter CRUD *************************
    
    if($action=='showretter'){
    $sql = "SELECT *, allergener.allergen_id, 
            CASE 
            WHEN vegetar = TRUE THEN 'Vegetar'
            WHEN vegansk = TRUE THEN 'Vegansk'
            WHEN glutenfri = TRUE THEN 'Glutenfri' 
            WHEN laktosefri = TRUE THEN 'Laktosefri'
            ELSE ''
            END mode
            FROM retter
            JOIN allergener
            ON retter.allergen_id = allergener.allergen_id
            ORDER BY bod_nr";
    $query = $conn->query($sql);
    $retter = array();
 
    while($row = $query->fetch_array()){
        array_push($retter, $row);
    }
 
    $out['retter'] = $retter;
    }
    
    if($action=='addretter'){
        $bodnr = $_POST['bod_nr'];
        $navn = $_POST['navn'];
        $billede = $_POST['billede'];
        $beskrivelse = $_POST['beskrivelse'];
        $pris = $_POST['pris'];
        $allergen_id = $_POST['allergen_id'];
        $kommentar = $_POST['kommentar'];
     
        if($bodnr==''){
            $out['error']=true;
            $out['message']='Add bod Failed. bodnr Empty.';
        }
        elseif($navn==''){
            $out['error']=true;
            $out['message']='Add bod Failed. navn Empty.';
        }
        elseif($billede==''){
            $out['error']=true;
            $out['message']='Add bod Failed. email Empty.';
        }
        elseif($beskrivelse==''){
            $out['error']=true;
            $out['message']='Add bod Failed. adgangskode Empty.';
        }
        elseif($pris==''){
            $out['error']=true;
            $out['message']='Add bod Failed. adgangskode Empty.';
        }
        elseif($allergen_id==''){
            $out['error']=true;
            $out['message']='Add bod Failed. adgangskode Empty.';
        }
        elseif($kommentar==''){
            $out['error']=true;
            $out['message']='Add bod Failed. adgangskode Empty.';
        }
        else{
            $sql="INSERT INTO retter ( bod_nr, navn, billede, beskrivelse, pris, allergen_id, kommentar) VALUES ('$bodnr', '$navn', '$billede', '$beskrivelse', '$pris', '$allergen_id', '$kommentar')";
            $query=$conn->query($sql);
     
            if($query){
                $out['message']='Ret Successfully Added';
            }
            else{
                $out['error']=true;
                $out['message']='Error in Adding Occured';
            }
    
        }
    }
    
    if($action=='updateretter'){
        $bodnr = $_PUT['bod_nr'];
        $bodnavn = $_PUT['bod_navn'];
        $email = $_PUT['email'];
        $adgangskode = $_PUT['adgangskode'];
     
        $sql="UPDATE retter SET bod_nr='$bodnr', navn='$navn', billede='$billede', beskrivelse='$beskrivelse', pris='$pris', allergen_id='$allergen_id', kommentar='$kommentar'";
        $query=$conn->query($sql);
        
        if($query){
            $out['message']='Ret Successfully Updatet';
        }
        else{
            $out['error']=true;
            $out['message']='Error in Updating Occured';
        }
    }
    
    if($action=='deleteretter'){
     
        $sql="DELETE FROM retter WHERE navn=$navn";
        $query=$conn->query($sql);

    }

    //Close connection
    $conn->close();
     
    header("Content-type: application/json");
    echo json_encode($out);
    die();
  
?>