<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "salmanecmrs";

$link = mysqli_connect($host,$username,$password,$dbname);

$conn = mysqli_select_db($link,$dbname);

if($conn){
    echo("connection ok");
}
else{
    die("connection failed becaus".mysqli_connect_error());
}

?>