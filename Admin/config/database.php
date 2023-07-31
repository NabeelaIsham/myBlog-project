<?php
 require 'config/constants.php';

 //conect to the database


 $servername = "localhost";
 $username = "nabeela";
 $password = "nabeela0218";
 $database = "blog"; 
 
 // Create a connection
 $conn = new mysqli($servername, $username, $password, $database);
 
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 
 //echo "Connected successfully";