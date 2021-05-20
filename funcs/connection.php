<?php

$host="localhost";
$dbname="moalemyar";
$user="root";
$pass="";

$db=new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
$sql="set names 'utf8'";
$sqlp= $db->prepare($sql);
$sqlp->execute();

if (!$db){
    echo "no it isnt";
}

?>

