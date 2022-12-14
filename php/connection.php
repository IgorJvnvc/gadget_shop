<?php
$host = "localhost";
$database = "id13049469gadgets_shop";
$user = "Igor";
$pass = "igor1998";

try
{
    $conn = new PDO("mysql:host=$host;dbname=$database",$user,$pass);

    $conn ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $conn ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
}
catch(PDOExeption $e){
echo $e->getMesssage();
}
?>