<?php 
//Database conn
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recipemanagementdatabase";

//Creating database conn
$conn = new mysqli($servername, $username, $password, $dbname);

//Connection check
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>