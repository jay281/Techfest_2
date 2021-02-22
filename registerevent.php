<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location:login.php");
    }
    $r = array();
    $count = 0;
    $dept = null;
    try{
	$dbhandler = new PDO('mysql:host=127.0.0.1;dbname=hammer','root','');
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        if(isset($_POST['event'])){
            if(strcmp($_POST['event'], 'all') === 0 ){
                $query = $dbhandler->query("select * from dbapp_participant ");
                $r = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = $query->rowcount();
            }
            else{
                $query = $dbhandler->query("select event_id from dbapp_event where event_name='".$_POST['event']."'");
                $r = $query->fetchAll(PDO::FETCH_ASSOC);
                $r = $r[0];
                $query = $dbhandler->query("select * from dbapp_participant where event_id_id='".$r['event_id']."'");
                $r = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = $query->rowcount();
            }
        }
        else if(isset ($_POST['delete'])){
            if(strcmp($_POST['event'], 'all') === 0 ){
                $_SESSION['msgdelete'] = "You cannot delete multiple event";
                header("Location:intermediate.php");
            } 
            else{
                $r = array();
                $count = 0;
                $dept = null;
                try{
                    $query = $dbhandler->query("select event_id from dbapp_event where event_name='".$_POST['event']."'");
                    $r = $query->fetchAll(PDO::FETCH_ASSOC);
                    $r = $r[0];
                    $count = $query->rowcount();
                    $query = $dbhandler->query("delete from dbapp_participant where event_id_id='".$r['event_id']."'");
                    $query = $dbhandler->query("delete from dbapp_event where event_id='".$r['event_id']."'");
                }catch(PDOException $e){
                        echo $e->getMessage();
                        die();
                }
            }
        }
    }
    catch(PDOException $e){
            echo $e->getMessage();
            die();
    }
?>
<html>
<head>
	<script src="https://kit.fontawesome.com/35cf7a4781.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' type="text/css" href="css/index.css">
	<meta charset="utf-8">
	<title>Register a Event</title>
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
    <?php if (isset($_POST['show'])){?>
        <?php if($count === 0){?>
        <div class="container">
            <div class="title">No Registrations Done for this event</div>
        </div>
        <?php }else{?>  
        <div class="container">
            <div class="heading">
                Registrations for selected Event/s
            </div>
            <table>
                <tr>
                    <td>Participant id</td>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Birth Date</td>
                    <td>Gender</td>
                    <td>Department</td>
                    <td>College Name</td>
                    <td>Mobile Number</td>
                    <td>Email ID</td>
                </tr>
                <?php for($i = 0; $i < $count; $i++){ $temp = $r[$i];?>
                    <tr>
                        <td><?php echo $temp['participant_id'];?></td>
                        <td><?php echo $temp['firstname'];?></td>
                        <td><?php echo $temp['lastname'];?></td>
                        <td><?php echo $temp['birthdate'];?></td>
                        <td><?php echo $temp['gender'];?></td>
                        <td><?php echo $temp['department_id'];?></td>
                        <td><?php echo $temp['college_name'];?></td>
                        <td><?php echo $temp['mobile'];?></td>
                        <td><?php echo $temp['email'];?></td>
                    </tr>
                <?php }?>
            </table>
        </div>
        <?php }?>
    <?php }elseif (isset($_POST['registered'])){?>
        <form action="store.php" method="POST">
            <div class="container">
                <div class="heading">Enter Email subject and body</div>
                <textarea name="subject" placeholder="Enter Subject"></textarea>
                <textarea name="body" placeholder="Enter Email body"></textarea>
                <input type="hidden" name="event" value="<?php echo $_POST['event'];?>">
                <input type="submit" name="registered" value="Send">
            </div>
        </form>
    <?php }elseif (isset($_POST['newsletter'])){?>
        <form action="store.php" method="POST">
            <div class="container">
                <div class="heading">Enter Email subject and body</div>
                <textarea name="subject" placeholder="Enter Subject"></textarea>
                <textarea name="body" placeholder="Enter Email body"></textarea>
                <input type="submit" name="Newsletter" value="Send">
            </div>
        </form>
    <?php }elseif (isset($_POST['register'])){?>
        <form action="store.php" method="POST" enctype="multipart/form-data">
		<div class="container">
			<div class="title">
				<br><br>Register a New Event<br><br>
			</div>
			<div>
                <select name="dept" aria-placeholder="Select Department" required>
					<option name="" disabled selected>Select Department</option>
					<option name="CE and IT Department" value="CE and IT Department">CE and IT Department</option>
					<option name="Chemical Department" value="Chemical Department">Chemical Department</option>
					<option name="Civil and Mechanical Department" value="Civil and Mechanical Department">Civil and Mechanical Department</option>
					<option name="EC and IC Department" value="EC and IC Department">EC and IC Department</option>
				</select>
			</div>
			<div>
				<input type="text" placeholder="Enter event name" name="event-name"required>
			</div>
			<div> 
				<textarea placeholder="Enter problem statement for your event" name="statement" required></textarea>
			</div>
			<div>
                <input type="text" name="eventdate" placeholder="Enter event date and time"
                       onfocus="(this.type='datetime-local')" onblur="(this.type='text')" required>
			</div>
			<div>
				<input type="text" placeholder="Enter number of people required for this event" name="requiredppl" required>
			</div>
			<div>
                <input type="text" placeholder="Enter amount of fees" name="fees" required>
			</div>
            <div>
                <!--input type="text" placeholder="Enter suitable image for event" name="image" value="Enter suitable image for event" onfocus="(this.type='file')" onblur="(this.type='text')"-->
                <input type="file" name="image" required>
            </div>
			<div>
				<textarea placeholder="Enter rules with bullentin for event (e.g. 1. some rule 2.some rule)" name="rules" required></textarea>
			</div>
			<div>
                            <input type="submit" name="registerevent" value="ADD"><br><br><br>
			</div>
		</div>
	</form>
    <?php }
        else{
            header("Location:intermediate.php");
        }
    ?>
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
