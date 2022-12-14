<?php
include "connection.php";

$upit = "SELECT * FROM menu";
$rezultat = $conn->query($upit);
$meni = $rezultat->fetchAll();


    echo json_encode($meni);

?>