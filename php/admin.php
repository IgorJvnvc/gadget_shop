<?php
session_start();
if(isset($_SESSION["admin"])):

	include "connection.php";



if(isset($_GET["deleteP"])):
	$id = $_GET["deleteP"];
	$upit = "DELETE FROM products WHERE id = :id";
	$prepare = $conn->prepare($upit);
	$prepare->bindParam(':id',$id);
	$rezultat = $prepare->execute();
endif;
if(isset($_GET["deleteU"])):
	$id = $_GET["deleteU"];
	$upit = "DELETE FROM users WHERE id = :id";
	$prepare = $conn->prepare($upit);
	$prepare->bindParam(':id',$id);
	$rezultat = $prepare->execute();
endif;
if(isset($_POST["send"])):

	$prodName = $_POST["productName"];
	$prodDesc = $_POST["productDesc"];
	$prodPrice = $_POST["productPrice"];
	$categoryId = $_POST["productCat"];

	$prodPicture = ["fileName"=>$_FILES["productPicture"]["name"],
	"tmpName"=>$_FILES["productPicture"]["tmp_name"],
	"fileSize"=>$_FILES["productPicture"]["size"],
	"fileType"=>$_FILES["productPicture"]["type"],
	"error"=>$_FILES["productPicture"]["error"]];

	
	$novaLokacija = "D:/xampp/htdocs/PHP1/SAJT/Gadgets_Shop/images/";
	$noviFajl = $novaLokacija.$prodPicture["fileName"];
	$result = move_uploaded_file($prodPicture["tmpName"],$noviFajl);
	$novaLokacija = "images/".$prodPicture["fileName"];

	
	if(!empty($categoryId)):

	$upit = "INSERT INTO products (name,description,price,picture_path,Category_ID)
	 VALUES(:prodName,:prodDesc,:prodPrice,:prodPicture,:categoryId)";
	$priprema = $conn->prepare($upit);
	$priprema->bindParam(':prodName',$prodName);
	$priprema->bindParam(':prodDesc',$prodDesc);
	$priprema->bindParam(':prodPrice',$prodPrice);
	$priprema->bindParam(':prodPicture',$novaLokacija);
	$priprema->bindParam(':categoryId',$categoryId);
	$rezultat = $priprema->execute();
	
	endif;
 
endif;

if(isset($_POST["sendUser"])):

	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = md5($_POST["password"]);
	if(isset($_POST["role"])):
		$roleID = $_POST["role"];
	
	if($roleID != 0):
	$upit = "INSERT INTO users (username,email,password,Role_ID)
	 VALUES(:username,:email,:pass,:roleID)";
	$priprema = $conn->prepare($upit);
	$priprema->bindParam(':username',$username);
	$priprema->bindParam(':email',$email);
	$priprema->bindParam(':pass',$password);
	$priprema->bindParam(':roleID',$roleID);
	$rezultat = $priprema->execute();
	endif;
endif;

endif;


$upitProducts = "SELECT * FROM products";
$rez = $conn->query($upitProducts);
$products =$rez->fetchAll();

$upitUsers = "SELECT u.id,u.*,r.name FROM users u inner join roles r on u.Role_ID = r.id";
$rez2 = $conn->query($upitUsers);
$users = $rez2->fetchAll();


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
			<ul id ="meni" >
				<li class="blog">
					<a href="admin.php"><span>Admin Account</span></a>
				</li>
				<li class = "logoutli" >
					<a class ="logout" href = "logout.php">LOGOUT</a>
				</li>
			</ul>
		</div>
		<div>
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
						<div>
							<div id="article">
								
									<form action = "<?= $_SERVER["PHP_SELF"]?>" method = "post" class = "register" enctype="multipart/form-data">
									<p>ADD NEW PRODUCT</p> 
										<input type = "text" name = "productName" id = "productName" placeholder = "product name"/></br>
										<input type = "text" name = "productDesc" id = "productDesc" placeholder = "product description"/></br>
										<input type = "text" name = "productPrice" id = "productPrice" placeholder = "product price"/></br>
										<input type = "text" name = "productCat" id = "productCat" placeholder = "product category"/>
											<?php  if(isset($categoryId)):if(empty($categoryId)):?>
											<span class = "spanGreske">CATEGORY ID MUST BE FILLED</span> 
											<?php endif; endif;?>
										</br>
										IMPORT PICTURE<input type = "file" name = "productPicture"/>
										<input type = "submit" name = "send" id = "send" value ="Add" />
									</form><br>
								
								<form action = "<?= $_SERVER["PHP_SELF"]?>" method = "post" class = "register">
								<p>ADD NEW USER</p>  
									<input type = "text" name = "username" id = "userName" placeholder = "username"/></br>
									<input type = "text" name = "email" id = "email" placeholder = "email"/></br>
									<input type = "text" name = "password" id = "password" placeholder = "password"/></br>
									ADMIN:<input class ="ne" type = "radio" name = "role" value= "1"/>
									USER:<input class = "ne" type = "radio" name = "role" value= "2"/>
											<?php if(isset($_POST["sendUser"])):  if(!isset($roleID)):?>
											<span class = "spanGreske">YOU MUST CHOOSE A ROLE</span> 
											<?php endif; endif;?></br></br>
									<input type = "submit" name = "sendUser"  value ="Add" />
								</form>
								<div class = "updateForma">
									<p>UPDATE PRODUCT</p>
										<div class = "register "> 
											<input type = "text" name = "productNameU" id = "productNameU" placeholder = "product name"/></br>
											<input type = "text" name = "productDescU" id = "productDescU" placeholder = "product description"/></br>
											<input type = "text" name = "productPriceU" id = "productPriceU" placeholder = "product price"/></br>
											<input type = "text" name = "productCatU" id = "productCatU" placeholder = "product category"/></br>
											CHOOSE PICTURE<input type = "file" name = "productPictureU" id ="productPictureU"/>
											<input type = "button" name = "sendU" id = "sendU" value ="Update" />
										</div>
									</div>
									<div class = "updateFormaU">
										<p>UPDATE USER</p>
											<div class = "register ">
												<input type = "text" name = "usernameU" id = "usernameU" placeholder = "username"/></br>
												<input type = "text" name = "emailU" id = "emailU" placeholder = "email"/></br>
												<input type = "text" name = "passwordU" id = "passwordU" placeholder = "password"/></br>
												ADMIN:<input class ="ne" type = "radio" name = "roleU" value= "1"/></br>
												USER:<input class = "ne" type = "radio" name = "roleU" value= "2" /></br>
												<input type = "button" name = "sendUserUpdate" id = "sendUserUpdate" value ="Update" />
											</div>
										</div>
							<div id="sidebar">
							<table class = "tabela" border = "1px solid black" >
									<tr>
										<th>Product Name</th>
										<th>Product Description</th>
										<th>Product Price</th>
										<th>Picture</th>
										<th>Category ID</th>
									</tr>
									<?php foreach($products as $element):  ?>
									<tr>
									
										<td><?= $element->name?></td>
										<td><?= $element->description?></td>
										<td><?= $element->price?></td>
										<td><img src = "../<?= $element->picture_path?>"/></td>
										<td><?= $element->Category_ID?></td>
										<td>
											<a name = "deleteP" href = "<?= $_SERVER["PHP_SELF"]?>?deleteP=<?=$element->id?>" >DELETE PRODUCT</a>
											<a data-id = "<?=$element->id?>" class = "update" name = "update" href = "#" >UPDATE PRODUCT</a>	
										</td>
									</tr> <?php endforeach;?>
									</table>
									<hr>
									<table class = "tabela" border = "1px solid black" >
									<tr>
										<th>User ID</th>
										<th>Username</th>
										<th>Email</th>
										<th>Password</th>
										<th>Role</th>
									</tr>
									<?php foreach($users as $korisnik):  ?>
									<tr>
									
										<td><?= $korisnik->id?></td>
										<td><?= $korisnik->username?></td>
										<td><?= $korisnik->email?></td>
										<td><?= $korisnik->password?></td>
										<td><?= $korisnik->name?></td>
										<td>
											<a name = "deleteU" href = "<?= $_SERVER["PHP_SELF"]?>?deleteU=<?=$korisnik->id?>" >DELETE USER</a>
											<a data-id = "<?=$korisnik->id?>" class = "updateU" name = "update" href = "#" >UPDATE USER</a>	
										</td>
									</tr> <?php endforeach;?>
									</table>
								</div>
								
								</div>
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
	<script type = "text/javascript" src = "../js/admin.js"></script>	
</body>
</html>
<?php else:


	header("location:index.php"); 	
endif; 
?>