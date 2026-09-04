<?php

$host="localhost";
$user="root";
$password="admin";
$db="csitecommerce";

$conn =mysqli_connect($host,$user,$password,$db);
if(!$conn){
    echo "Datbase connection failed";
}
