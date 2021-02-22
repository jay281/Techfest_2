<?php
    if(!isset($_GET['event'])){
    header("Location:demo.php");
}
    session_start();
    $r = array();
    $dept = null;
    try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=hammer','root','');
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        if(isset($_GET['event'])){
            $query = $dbhandler->query("select * from dbapp_event where event_name='".$_GET['event']."'");
            $r = $query->fetchAll(PDO::FETCH_ASSOC);
            $r = $r[0];
            //print_r ($r);
            $_SESSION['event_id'] = $r['event_id'];
        }
        else{
            echo "nothing";
        }
    }
    catch(PDOException $e){
            echo $e->getMessage();
            die();
    }
?>
<html>
    <head>
		<title>TechFest 2020</title>
		<script src="https://kit.fontawesome.com/35cf7a4781.js" crossorigin="anonymous"></script>
        <link rel='stylesheet' type="text/css" href="css/index.css">
    </head>
    <body>
        <header>
			<div class="header">
				<a href="demo.html" class="logo">TechFest<font color="#ff0066">.</font></a>
				<div class="header-right">
					<a href="demo.html#Team" class="an">Team</a>
					<a href="demo.html#Sponser" class="an">Sponser</a>
					<a href="demo.html#Department" class="an">Department</a>
					<a href="demo.html#AboutUs" class="an">About Us</a>
					<a href="#ContactUs" class="an">Contact Us</a>
				</div>
			</div>
		</header>
		<hr>
		<section class="main">
			<span class="mainheading">
				<span class="title"><?php echo $r['department_id']; ?><br></span>TECHFEST 2020
			</span>
		</section>
		<hr>
		<section class="main">
			<span class="heading">
				<span class="title">Problem Statement<br></span>What you have to do!?
			</span>
			<span class="text">
                            <br><?php echo $r['problem_statement'];?>
			</span>
		</section>
		<hr>
		<section class="main">
			<span class="heading">
				<span class="title">Rules<br></span>Yeah! There are some bounds 
			</span>
			<span class="text">
				<br><?php echo $r['rules'];?>
				</span>
		</section>
		<hr>
                <section class="main">
            <span class="heading">
				<span class="title">Other Details<br></span>Things that must be noted<br>
			</span>
            <div class="grid1">
				<div class="items">
                    <span class="title">People Required</span><br><br>
                    <span class="text" style="font-size: 20px"><?php echo $r['people_required'];?></span>
				</div>
				<div class="items">
					<span class="title">Event Fees</span><br><br>
                    <span class="text" style="font-size: 20px"><?php echo $r['fees'];?></span>
				</div>
				<div class="items">
                    <span class="title">Date & Time</span><br><br>
                    <span class="text" style="font-size: 20px"><?php echo $r['event_date'];?></span>
				</div>
			</div>
            <div class="container">
                <button><a href="register.php?event_id=<?php echo $r['event_id'];?>" style="color: white"> Register</a></button>
            </div>
        </section>
        <hr>
		<footer>
			<div class="grid1">
				<div class="items">
					<a href="index.html" class="logo">TechFest<font color="#ff0066">.</font></a><br><br>
					<a href="http://twitter.com"><i class='fab fa-twitter-square fa-1.5x'></i></a>
					<a href="http://facebook.com"><i class='fab fa-facebook-square fa-1.5x'></i></a>
					<a href="http://youtube.com"><i class='fab fa-youtube fa-1.5x'></i></a>
					<a href="http://pinterest.com"><i class='fab fa-pinterest-square fa-1.5x'></i></a>
					<a href="http://linkedin.com"><i class='fab fa-linkedin fa-1.5x'></i></a>
					<a href="http://instagram.com"><i class='fab fa-instagram fa-1.5x'></i></a>
				</div>
				<div class="items">
					<span class="title" id="ContactUs">Contact Us<br><br></span>
					<span class="text"><i class='fas fa-map-marker-alt fa-2x'></i><br>Dharmsinh Desai University,<br>
						College Road,<br>
						Nadiad-387001.</span>
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