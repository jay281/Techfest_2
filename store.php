<?php
session_start();
//require_once('PHPMailer/PHPMailerAutoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
$mail = new PHPMailer();
$mail->isSMTP();
$mail->isHTML();
//$mail->SMTPDebug = 1;
$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->Username = 'h3ydrahammer@gmail.com';
$mail->Password = 'hammerhydra33';
$mail->SetFrom('h3ydrahammer@gmail.com');
/** @var type $_POST */
if(!isset($_SESSION['login'])){
    header("Location:login.php");
}
elseif(isset($_POST['join'])){
     try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=hammer','root','');
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query = $dbhandler->query("insert into dbapp_newsletter() values ('".$_POST['newsletter']."')");
        $mail->AddAddress($_POST['newsletter']);
        $subject = "TechFest 2020";
        $message = "<h1>Welcome to TechFest 2020. You will be notified with this email ID.</h1>";
        $mail->Subject = $subject;
        $mail->Body = $message;
        $q = $mail->Send();
        if($q) {
            $_SESSION['subscribe'] = "You are Subscribed successfully";
            //echo "lol";
            header("Location:demo.php");
         }else {
            $_SESSION['subscribe'] = "You are not Subscribed successfully";
            //echo "non lol";
            header("Location:demo.php");
         }
    }
    catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}
elseif(isset($_POST['registered'])){
    $r = array();
    $count = 0;
    $dept = null;
    try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=hammer','root','');
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        if(strcmp($_POST['event'], 'all') !== 0 ){
            $query = $dbhandler->query("select event_id from dbapp_event where event_name='".$_POST['event']."'");
            $r = $query->fetchAll(PDO::FETCH_ASSOC);
            $r = $r[0];
            $query = $dbhandler->query("select email from dbapp_participant where event_id_id='".$r['event_id']."'");
            $r = $query->fetchAll(PDO::FETCH_ASSOC);
            print_r ($r);
            $count = $query->rowcount();
        }
        else{
            $query = $dbhandler->query("select email from dbapp_participant ");
            $r = $query->fetchAll(PDO::FETCH_ASSOC);
            print_r($r);
            $count = $query->rowcount();
        }
    }
    catch(PDOException $e){
            echo $e->getMessage();
            die();
    }
    for($i = 0; $i < $count; $i++){
        $temp = $r[$i];
        $mail->AddAddress($temp['email']);
        $mail->Subject = $_POST['subject'];
        $mail->Body = $_POST['body'];
        $q = $mail->Send();
    }
    if($q){
            $_SESSION['msg'] = "Emails sent successfully!!!";
            header("Location:intermediate.php");
        }
        else{
            $_SESSION['msg'] = "Problem with sending emails!!!?";
            header("Location:intermediate.php");
        }
}
elseif(isset ($_POST['Newsletter'])){
    $r = array();
    $count = 0;
    try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=hammer','root','');
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query = $dbhandler->query("select email from dbapp_newsletter");
        $r = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = $query->rowCount();
        print_r($r);
    }
    catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
    for($i = 0; $i < $count; $i++){
        $temp = $r[$i];
        $mail->AddAddress($temp['email']);
        $mail->Subject = $_POST['subject'];
        $mail->Body = $_POST['body'];
        $q = $mail->Send();
    }
   header("Location:intermediate.php");
}
elseif(isset($_POST['register'])){
    $r = array();
    $count = 0;
    try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=hammer','root','');
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query = "insert into dbapp_participant(firstname, lastname, birthdate, gender, college_name, mobile, email, department_id, event_id_id) values (?,?,?,?,?,?,?,?,?)";
        $q=$dbhandler->prepare($query);
        $q->execute(array($_POST['fname'], $_POST['lname'], $_POST['dob'], $_POST['gender'], $_POST['college'], $_POST['mobile'], $_POST['eid'], $_POST['dept'], $_POST['eventid']));
        $_SESSION['success'] = "You Registered Successfully !";
        if(isset($_POST['check'])){
            $query = "insert into dbapp_newsletter(email) values(?)";
            $q = $dbhandler->prepare($query);
            $q->execute(array($_POST['eid']));
        }
        $mail->AddAddress($_POST['eid']);
        $subject = "Registration at TechFest 2020";
        $message = "<h1>Welcome to TechFest 2020. You are registered successfully and will be notified with this email ID.</h1>";
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->send();
        $_SESSION['participant_register'] = "true";
        header("Location:register.php?event_id=".$_POST['eid']);
    }
    catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}
elseif(isset ($_POST['registerevent'])){
    $r = array();
    $count = 0;
    echo "hello";
    try{
        $target_location="C:/xampp/htdocs/PhpProject7/images/".basename($_FILES["image"]["name"]);
        $img = "".basename($_FILES["image"]["name"]);
        echo$target_location;
        $ext = pathinfo($target_location, PATHINFO_EXTENSION);
        if(! (move_uploaded_file($_FILES['image']['tmp_name'], $target_location)))
            echo "Error: " . $_FILES['image']['error'] . "<br>";
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=hammer','root','');
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query = "insert into dbapp_event(event_name, problem_statement, event_date, people_required, fees, rules, department_id, img) values(?,?,?,?,?,?,?,?)";
        $q=$dbhandler->prepare($query);
        $q->execute(array($_POST['event-name'], $_POST['statement'], $_POST['eventdate'], $_POST['requiredppl'], $_POST['fees'], $_POST['rules'], $_POST['dept'], $img));
    }
    catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
        $r = array();
    $count = 0;
    try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=hammer','root','');
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query = $dbhandler->query("select email from dbapp_newsletter");
        $r = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = $query->rowCount();
        print_r($r);
    }
    catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
    for($i = 0; $i < $count; $i++){
        $temp = $r[$i];
        $mail->AddAddress($temp['email']);
        $mail->Subject = 'TechFest 2020';
        $mail->Body = "<h1>Welcome to TechFest 2020. New Event is added to our TechFest 2020 website. "
                . "If you are insterested in participating please checkout at TechFest 2020.</h1>";
        $q = $mail->Send();
    }
    $_SESSION['success'] = "Your Event Registered Successfully !";
    header("Location:eventlist.php?dept=" .$_POST['dept']);
    //echo"<script type='text/javascript'>windows.location.href='eventlist.php?dept=".$_POST['dept']."'</script>";
}
else{
    header("Location:intermediate.php");
}
?>