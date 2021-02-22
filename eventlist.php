<?php
    if(!isset($_GET['dept'])){
    header("Location:demo.php");
}
    session_start();
    $r = array();
    $desc = array();
    $dept = null;
    $count = 0;
    try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=hammer','root','');
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        if(isset($_GET['dept'])){
            $query = $dbhandler->query("select event_name, img from dbapp_event where department_id='".$_GET['dept']."'");
            $r = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = $query->rowCount();
            $query = $dbhandler->query("select description from dbapp_department where department='".$_GET['dept']."'");
            $desc = $query->fetchAll(PDO::FETCH_ASSOC);
            //print_r($r);
            //echo $count;
            $desc = $desc[0];
            $dept = $_GET['dept'];
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
            <a href="demo.php" class="logo">TechFest<font color="#ff0066">.</font></a>
            <div class="header-right">
                <a href="demo.php#Team" class="an">Team</a>
                <a href="demo.php#Sponser" class="an">Sponser</a>
                <a href="demo.php#Department" class="an">Department</a>
                <a href="demo.php#AboutUs" class="an">About Us</a>
                <a href="#ContactUs" class="an">Contact Us</a>
            </div>
        </div>
    </header>
    <hr>
    <section class="main">
        <span class="mainheading">
            <span class="title"><?php echo $dept;?><br></span>TECHFEST 2020
            <span class="text"><br><?php echo $desc['description'];?>
            </span>
        </span>
    </section>
        <hr>
        <section class="main">
            <span class="heading">
                    <span class="title">Our Events<br></span>Find one in which you are master
            </span>
            <br>
            
            <div class="grid">
                    <?php for($i = 0; $i < $count; $i++){ $temp = $r[$i]; ?>
                <a href="event.php?event=<?php echo $temp['event_name']; ?>" class="an"><div class="box"><img src="images/<?php echo $temp['img'];?>" height="70%" width="100%">
                            <br><br><br><?php echo $temp['event_name']; ?></div></a>
                 
                    <?php }?>
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