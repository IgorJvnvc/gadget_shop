<?php 
if(isset($_POST["posalji"])):
    include "connection.php";
    session_start();

    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $upit = "SELECT * FROM users 
    WHERE username = :username AND password = :pass";
    $priprema = $conn->prepare($upit);
    $priprema->bindParam(':username',$username);
    $priprema->bindParam(':pass',$password);
    $rezultat = $priprema->execute();
    $user = $priprema->fetch();
    
    if($user):
            
            if($user->Role_ID == 1):
                $_SESSION["admin"] = $user;
                $code = 200;
                
                header("location:admin.php");
            else: $_SESSION["user"] = $user;
            header("location:user.php");
            
            endif;
            else:
                $message = ["error" => "username or password did not match"];  
                
                header("location:index.php?error=".$message["error"]); 

        endif;
    endif;

?>