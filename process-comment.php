<?php
require 'config/database.php';



// Assuming you have established a database connection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
  $name = $_POST['name'];
  $email = $_POST['email'];
  $commentText = $_POST['comment_text'];

  $query = "INSERT INTO comments ( name, email, comment_text) VALUES ( ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $commentText);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}
 header('location:' . ROOT_URL . 'blog.php');
 die();

?>
