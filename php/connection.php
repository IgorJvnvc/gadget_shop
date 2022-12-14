<?php
$host = "sql210.epizy.com";
$database = "epiz_31662114_gadget";
$user = "epiz_31662114";
$pass = "MZzjuGeYrjMZ";

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