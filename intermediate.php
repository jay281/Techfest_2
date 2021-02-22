<?php
session_start();
    $r = array();
    $count = 0;
    try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=hammer','root','');
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        if(isset($_POST['username']) && isset($_POST['password'])){
            $query = $dbhandler->prepare("select * from dbapp_login where username = ? and password = ?");
            $query->execute(array($_POST['username'],$_POST['password']));
            $count = $query->rowcount();
            if($count == 0){
                header("Location: login.php");
            }
            else{
                $_SESSION['login'] = true;
            }
        }
        else{
            //echo "nothing";
        }
    }
    catch(PDOException $e){
            echo $e->getMessage();
            die();
    }
    if(!isset($_SESSION['login'])){
    header("Location:login.php");
}
        $r = array();
    $count = 0;
    $dept = null;
    try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=hammer','root','');
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query = $dbhandler->query("select event_name from dbapp_event");
        $r = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = $query->rowcount();
    }
    catch(PDOException $e){
            echo $e->getMessage();
            die();
    }
    
?>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/35cf7a4781.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' type="text/css" href="css/index.css">
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <title>TechFest 2020</title>
</head>
<body>
<header>
    <div class="header">
        <a href="demo.php" class="logo">TechFest<font color="#ff0066">.</font></a>
        <div class="header-right">
            <a href="demo.php#Team" class="an">Team</a>
            <a href="demo.php#Sponser" class="an">Sponser</a>
            <a href="demo.php#Department" class="an">Department</a>
            <a href="demo.php#AboutUs" class="an">About Us</a>
            <a href="#ContactUs" class="an">Contact Us</a>
            <a href="logout.php" class="an">Log Out</a>
        </div>
    </div>
</header>
<hr>
<br>
<br>

<form action="registerevent.php" method="POST">
    <div class="container">
        <div>
            <select name="event" aria-placeholder="Select Event" required>
                <option name="" disabled selected>Select Event</option>
                <option name="all" value="all">All Event</option>
                <?php for($i = 0; $i < $count; $i++){ $temp = $r[$i];?>
                    <option name="<?php echo $temp['event_name'];?>" value="<?php echo $temp['event_name'];?>"><?php echo $temp['event_name'];?></option>
                <?php }?>
            </select>
        </div>
        <div class="title">
            <br><br>Show Registered User<br><br>
        </div>
        <div>
            <input type="submit" name="show" value="Show">
        </div>
        <div class="title">
            <br><br>Inform via Mail to Registered User<br><br>
        </div>
        <?php if(isset($_SESSION['msgmail'])) { ?>
            <div class="container">
                <div class="text"><?php echo $_SESSION['msgmail']; unset($_SESSION['msgmail']);?></div>
            </div>
        <?php }?>
        <div>
            <input type="submit" name="registered" value="Enter">
        </div>
    </div>
</form>
<br>
<br>
<hr>
<br>
<div class="container">
    <div class="heading">
        Or
    </div>
</div>
<hr>
<form action="registerevent.php" method="post">
    <div class="container">
        <div class="title">
            <br><br>Register a New Event<br><br>
        </div>
        <div>
            <input type="submit" name="register" value="Register">
        </div>
        <div class="title">
            <br><br>Inform via Mail to Newsletter User<br><br>
        </div>
        <?php if(isset($_SESSION['msgnews'])) { ?>
            <div class="container">
                <div class="text"><?php echo $_SESSION['msgnews'];unset($_SESSION['msgnews']);?></div>
            </div>
        <?php }?>
        <div>
            <input type="submit" name="newsletter" value="Enter">
        </div>
    </div>
</form>
<hr>
<footer>
    <div class="grid1">
        <div class="items">
            <a href="demo.php" class="logo">TechFest<font color="#ff0066">.</font></a><br><br>
            <a href="http://twitter.com"><i class='fab fa-twitter-square fa-1.5x'></i></a>
            <a href="http://facebook.com"><i class='fab fa-facebook-square fa-1.5x'></i></a>
            <a href="http://youtube.com"><i class='fab fa-youtube fa-1.5x'></i></a>
            <a href="http://pinterest.com"><i class='fab fa-pinterest-square fa-1.5x'></i></a>
            <a href="http://linkedin.com"><i class='fab fa-linkedin fa-1.5x'></i></a>
            <a href="http://instagram.com"><i class='fab fa-instagram fa-1.5x'></i></a>
        </div>
        <div class="items">
            <span class="title" id="ContactUs">Contact Us<br><br></span>
            <a href="https://www.google.com/maps/place/DHARMSINH+DESAI+UNIVERSITY/@22.6802426,72.87801,17z/data=!3m1!4b1!4m5!3m4!1s0x395e5adf2c171355:0xe1e974ce083657fb!8m2!3d22.6802377!4d72.8801987">
                    <span class="text"><i class='fas fa-map-marker-alt fa-2x'></i><br>Dharmsinh Desai University,<br>
                        College Road,<br>
                        Nadiad-387001.</span>
            </a>
            <span class="text"><br><br><i class='fas fa-phone-alt fa-2x'></i><br>+91 9876543210<br><br></span>
            <span class="text"><i class='fas fa-at fa-2x'></i><br>Someone@example.com<br><br><br><br><br></span>
        </div>
        <div class="items">
            <span class="title">Join the Newsletter <br><br></span>
            <form action="store.php" method="POST">
                        <input type="email" name="newsletter" placeholder="You will get update via this email"
                               required/><br>
                        <input type="submit" value="JOIN" name="join"><br>
                    </form>
        </div>
    </div>
</footer>
</body>
</html>

