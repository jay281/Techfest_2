<?php session_start();?>
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
        <form action="intermediate.php" method="POST">
            <section class="khokhu">
                <span class="heading">
                    <span class="title">Login Page<br></span>Modify TechFest Events
                </span>
                <div class="inputtext">
                    <i class='fas fa-user fa-2x'></i>
                    <input type="text" name="username" placeholder="Enter username or email id" required>
                </div>
                <div class="inputtext">
                    <i class='fas fa-key fa-2x'></i>
                    <input type="password" name="password" placeholder="Enter password" required>
                </div>
                <div><input type="submit" value="ENTER"></div><br><br>
            </section>
        </form>
        <hr>
        <footer>
			<div class="grid1">
				<div class="items">
					<a href="demo.html" class="logo">TechFest<font color="#ff0066">.</font></a><br><br>
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