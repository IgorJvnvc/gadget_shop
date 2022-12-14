<?php 
session_start();
if(isset($_SESSION["user"])):
	
include "connection.php";
	if(isset($_POST["posaljiEditName"])):
		$greskaUser = "";
		$id = $_SESSION["user"]->id;
		$noviUsername = $_POST["editUsername"];
		$regUser = "/^([A-z]\s*){2,15}/";

		if(!preg_match($regUser,$noviUsername))
			$greskaUser = "Username must beggin with a letter,MIN 2,MAX 15 characters";
		
		if($greskaUser == ""):
		$priprema = $conn->prepare("UPDATE users SET username = :username
		WHERE id = :id");
		$priprema->bindParam(':username',$noviUsername);
		$priprema->bindParam(':id',$id);
		$rezultat1 = $priprema->execute();
	
	endif;



	endif;
	if(isset($_POST["posaljiEditEmail"])):
		$noviEmail = $_POST["editEmail"];
		$id = $_SESSION["user"]->id;
		$greskaEmail = "";
		$regEmail = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";
		if(!preg_match($regEmail,$noviEmail))
			$greskaEmail = "Email is not in good format";

			if($greskaEmail == ""):
				$priprema = $conn->prepare("UPDATE users SET email = :email
				WHERE id = :id");
				$priprema->bindParam(':email',$noviEmail);
				$priprema->bindParam(':id',$id);
				$rezultat2 = $priprema->execute();
				endif;
	endif;

	if(isset($_POST["posaljiEditPass"])):
		$noviPass = ($_POST["editPass"]);
		$noviPass2 = ($_POST["editPass2"]);
		$id = $_SESSION["user"]->id;
		$greskaPass = "";
		$regPass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/";

		if(!preg_match($regPass,$noviPass))
			$greskaPass = "Password must have at least 1 uppercase, 1 lovercase letter,1 number and 1 special character,MIN length 8,MAX 15";
		else if($noviPass != $noviPass2)
				$greskaPass = "Passwords do not match";
			if($greskaPass == ""):
				$noviPass = md5($noviPass);
				$priprema = $conn->prepare("UPDATE users SET password = :pass
				WHERE id = :id");
				$priprema->bindParam(':pass',$noviPass);
				$priprema->bindParam(':id',$id);
				$rezultat3 = $priprema->execute();
				endif;
	endif;

?>
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
				
				<li class="blog ">
					<a href="user.php"><span>User Account</span></a>
				</li>
				<li class = "logoutli" >
					<a class ="logout" href = "logout.php">LOGOUT</a>
				</li>
			</ul>
		</div>
		<div>
			<div id ="figure">
				<div>
					<span id="background">
						<h1>Live Music</h1>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div id="body">
		<div>
			<div>
				<div>
					<div>
						<div>
							<div id="article">
								<div class ="userInfo">Account Information<hr>
									<p>Username:<b><?= $_SESSION["user"]->username?></b><a class= "editLink" id = "editUsername" href = "#">Edit</a></p>
									<p>Email:<b><?= $_SESSION["user"]->email?></b><a class ="editLink" id = "editEmail" href = "#">Edit</a></p>
									<a id = "editPass" href = "#">Change Password</a>
									<form class = "editForme" id = "formPass" action = "<?= $_SERVER["PHP_SELF"]?>" method = "post">
									<p class = "notice">NOTICE! password will be changed when you logout</p>
									<input type = "text" name = "editPass" placeholder = "New Password"/>
									<input type = "text" name = "editPass2" placeholder = "Repeat new Password"/>
									<input type = "submit" name ="posaljiEditPass"/>
								</form>
								<?php if(isset($greskaPass)): if($greskaPass != ""):?><p><?= $greskaPass?></p><?php endif; endif;?>
									<?php if(isset($rezultat3)): if($rezultat3):?><p>Password successfully changed</p><?php endif; endif;?>
								</div>
							</div>
							<div id="sidebar2">
								<form class = "editForme" id = "formUsername" action = "<?= $_SERVER["PHP_SELF"]?>" method = "post">
									<p class = "notice" >NOTICE! username will be changed when you logout</p>
									<input type = "text" name = "editUsername" placeholder = "New Username"/>
									<input type = "submit" name ="posaljiEditName"/>
								</form></br>
								<?php if(isset($greskaUser)): if($greskaUser != ""):?><p><?= $greskaUser?></p><?php endif; endif;?>
								<?php if(isset($rezultat1)): if($rezultat1):?><p>Username successfully changed</p><?php endif; endif;?>

								<form class = "editForme" id = "formEmail" action = "<?= $_SERVER["PHP_SELF"]?>" method = "post">
								<p class = "notice">NOTICE! email will be changed when you logout</p>
									<input type = "text" name = "editEmail" placeholder = "New Email"/>
									<input type = "submit" name ="posaljiEditEmail"/>
								</form>
								<?php if(isset($greskaEmail)): if($greskaEmail != ""):?><p><?= $greskaEmail?></p><?php endif; endif;?>
								<?php if(isset($rezultat2)): if($rezultat2):?><p>Email successfully changed</p><?php endif; endif;?>

								
							</div>
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
	<script type ="text/javascript">
	$("#editUsername").click(function(){
		$("#formUsername").toggle();

	})
	$("#editEmail").click(function(){
		
		$("#formEmail").toggle();
	})
	$("#editPass").click(function(){
		$("#formPass").toggle();
	})
	</script>
	<script type = "text/javascript" src ="../js/user.js"></script>
</body>
</html>
<?php else:
	$message = "Please login to access user account page";
	header("location:index.php?errorUser=".$message); 	
endif; 
?>