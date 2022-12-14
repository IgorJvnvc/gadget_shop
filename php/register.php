<?php
if(isset($_POST["posalji"]))
{

	 include "connection.php";

	$username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
	$Cpassword = $_POST["Cpassword"];
	
	
	// $upit = "SELECT * FROM users WHERE username = '$username'";
	// $prepare = $conn->prepare($upit);

	// $rezultat = $conn->query($upit);
	// $pronadjen = $rezultat->fetch();
	
    $regUser = "/^([A-z]\s*){2,15}/";
	$regEmail = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";
    $regPass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/";

	$greske = [];
	
    if(!preg_match($regUser,$username))
        $greske[] = "Username must beggin with a letter,MIN 2,MAX 15 characters";
    if(!preg_match($regEmail,$email))
        $greske[] = "Email is not in good format";
    if(!preg_match($regPass,$password))
        $greske[] = "Password must have at least 1 uppercase, 1 lovercase letter,1 number and 1 special character,MIN length 8,MAX 15";
    if($password != $Cpassword)
		$greske[] = "password does not match";
		if(count($greske) == 0){
			$password = md5($password);
			$upitInsert = "INSERT INTO users(username,email,password,Role_ID)
			VALUES(:username,:email,:pass,2)";
			$priprema = $conn->prepare($upitInsert);
			$priprema->bindParam(':username',$username);
			$priprema->bindParam(':email',$email);
			$priprema->bindParam(':pass',$password);
			$rezultat = $priprema->execute();

			$conn = null;
			header("location:index.php");
		}
		else header("location:register.php");
}
?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Gadget Shop</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <script type ="text/javascript" src = "../js/jq.js"></script>
</head>
<body>
	<div id="header">
		<div>
			<div id="logo">
				<a href="index.php"><img src="../images/logo.png" alt="Logo"></a>
			</div>
			<ul>
				<li class="home ">
					<a href="index.php"><span>Home</span></a>
				</li>
				<li class="products">
					<a href="products.php"><span>Products</span></a>
				</li>
				<li class="about">
					<a href="about.php"><span>About</span></a>
				</li>
				<li class="blog">
					<a href="user.php"><span>User Account</span></a>
				</li>
			</ul>
		</div>
		<div>
			<div id="figure">
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
                        <form id = "forma" action = "<?= $_SERVER["PHP_SELF"]?>" method = "post" class = "register" onsubmit = "return provera()" > 
                            <input type = "text" id = "username" name = "username" placeholder = "Username"/> </br>
                            <input type = "text" id = "email" name = "email" placeholder = "Email"/></br>
                            <input type = "text" id = "password" name = "password" placeholder = "Password"/></br>
                            <input type = "text" id = "Cpassword" name = "Cpassword" placeholder = "Confirm Password"/></br>
							<input type = "submit" id = "posalji" name = "posalji" value = "Register"/>
                        </form>
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
    <script type = "text/javascript">

    var postoji = false;
    function provera()
    {
        var username = document.getElementById("username").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var Cpassword = document.getElementById("Cpassword").value;
        
        var regUser = /^([A-z]\s*){2,15}/;
        var regEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
        var regPass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/;

        var greske = [];
        
        var forma = document.getElementById("forma")

        if(!regUser.test(username))
				greske.push("Username must beggin with a letter,MIN 2,MAX 15 characters")
		if(!regPass.test(password))
				greske.push("Password must have at least 1 uppercase, 1 lovercase letter,1 number and 1 special character,MIN length 8,MAX 15")
		if(password != Cpassword)
				greske.push("password does not match")
		if(!regEmail.test(email))
				greske.push("Email is not in good format")
        if(greske.length){        
		    if(!postoji){
				$('<span id ="zagreske"></span>').appendTo(forma);
				var spanZaGreske = document.getElementById("zagreske")
				postoji = true;
				for(i in greske){
					
						spanZaGreske.innerHTML += greske[i] + "</br>";
				}
			}
			else{
				var spanZaGreske = document.getElementById("zagreske")
				spanZaGreske.innerHTML = "";
				for(i in greske){
						
						spanZaGreske.innerHTML += greske[i] + "</br>";
				}
            }
            return false;
		}
		else
		{
			$('#zagreske').remove();
            alert("Successfully registered!")
            return true;
		}
        
    }
    </script>
</body>
</html>