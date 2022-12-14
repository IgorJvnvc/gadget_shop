<?php

if(isset($_POST["id"])):
    
    include "connection.php";

    $data = array();

	$prodNameU = $_POST["name"];
	$prodDescU = $_POST["description"];
	$prodPriceU = $_POST["price"];
	$categoryIdU = $_POST["category"];
    $id = $_POST["id"];
    $prodPicture = "images/".$_POST["picture"];

	$upit = "UPDATE products SET
	name = :prodNameU, description = :prodDescU, price = :prodPriceU, picture_path = :prodPictureU, Category_ID = :categoryId
	WHERE id = :id";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(':prodNameU',$prodNameU);
    $prepare->bindParam(':prodDescU',$prodDescU);
    $prepare->bindParam(':prodPriceU',$prodPriceU);
    $prepare->bindParam(':prodPictureU',$prodPicture);
    $prepare->bindParam(':categoryId',$categoryIdU);
    $prepare->bindParam(':id',$id);
    
	$rezultat = $prepare->execute();
    if($rezultat):
        $data["statusCode"] = 204 ;
        $data["message"] = "successfully updated";
    else:
        $data["message"]= "error";
    endif;
    echo json_encode($data);

endif;

if(isset($_POST["idUser"])):
    
    include "connection.php";

    $data = array();

	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = md5($_POST["password"]);
	$roleId = $_POST["roleID"];
    $id = $_POST["idUser"];
    
    

	$upit = "UPDATE users SET
	username = :username, email = :email, password = :pass, Role_ID = :roleID
	WHERE id = :id";
    $prepare = $conn->prepare($upit);
    $prepare->bindParam(':username',$username);
    $prepare->bindParam(':email',$email);
    $prepare->bindParam(':pass',$password);
    $prepare->bindParam(':roleID',$roleId);
    $prepare->bindParam(':id',$id);
    
	$rezultat = $prepare->execute();
    if($rezultat):
        $data["statusCode"] = 204;
        $data["message"] = "successfully updated";
    else:
        $data["statusCode"] = 500;
        $data["message"]= "error";
    endif;
    echo json_encode($data);

endif;
?>