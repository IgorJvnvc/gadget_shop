<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Gadget Shop</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
	<script type = "text/javascript" src = "../js/jq.js"></script>
</head>
<body>
	<div id="header">
		<div>
			<div id="logo">
				<a href="index.php"><img src="../images/logo.png" alt="Logo"></a>
			</div>
			<ul id = "meni">

				<li class="blog">
				<?php
					
					if(isset($_SESSION["admin"])):
					?>
					<a href="admin.php"><span>Admin Account</span></a>
					<?php else:?>
					<a href="user.php"><span>User Account</span></a>
					<?php endif;?>
				</li>
				<?php
				if(isset($_SESSION["admin"])||isset($_SESSION["user"])):
				?>
				<li class = "logoutli" >
					<a class ="logout" href = "logout.php">LOGOUT</a>
				</li>
				<?php endif;?>
			</ul>
		</div>
		<div>
		<?php
		if(!isset($_SESSION["admin"]) && !isset($_SESSION["user"])):
		?>
		<div id = "login">
			<form action = "obrada.php" method = "post" name = "forma" class = "login">
				<input type = "text" id = "password" name = "username" placeholder = "username"/></br>
				<input type ="password" id = "password" name = "password" placeholder = "password"></br>
				<input type = "submit" id = "posalji" name = "posalji" value = "LOG IN"/>
			</form>
			<a class ="signUp" href = "register.php">Dont Have an Account? Sign up!</a>
		</div>
		<?php endif;?>
		<div id="figure">
					<div>
						<span id="background"><h1>Live Music</h1></span>
					</div>	
				</div>
	</div>
	</div>
	<div id="body">
		<div>
			<div>
				<div>
					<div>
							<div id = "omeni"><h3>About the author</h3>
							</div>
								<div id="tekst"> <b>Full Name:Igor Jovanovic</b></br>
								<b>Index Number:289/18</b>
								<p>I was born in Belgrade on the 29th of October 1998. I graduated electro-technical high school "Nikola Tesla" profile: "Electro-Technician of Telecommunications".
								I'm currently studding on the ICT College of applied studies, profile: "Web Programming",index number:127/18.
								My goal for this website is to show the functions of PHP</p>
								<img id = "ja" src = "../images/ja.jpg"/>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<div>
			<div>
				<h3>INFO</h3>
				<p class= "info">Address: 8644 Beechwood St. Southfield, MI 48076</p>
				<p class="info">Contact: Phone +3913259483 Email gadgetshop@gmail.com</p>
				<a class="a-info" href = "sitemap.xml">SITE MAP</a></br>
				<a class="a-info" href = "documentation.pdf">DOCUMENTATION</a>
			</div>
			<div>
				<h3>Get Social</h3>
				<ul>
					<li>
						<a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" id="googleplus">Google&#43;</a>
					</li>
					<li>
						<a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" id="twitter">Twitter</a>
					</li>
					<li>
						<a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" id="facebook">Facebook</a>
					</li>
				</ul>
			</div>
		</div>
		<p class="footnote">
			&copy; Igor Jovanovic 127/18
		</p>
	</div>
<script type ="text/javascript" src = "../js/about1.js"></script>
</body>
</html>