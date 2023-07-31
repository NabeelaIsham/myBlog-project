<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
  //get form data
  $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
  $description = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);

   if (!$title) {
    $_SESSION['add-category'] = "Title is Required";
   } elseif (!$description) {
    $_SESSION['add-category'] = "Describe the post";
   }


   //redirect back to category page with form data if was invalid input
   if (isset($_SESSION['add-category'])) {
      $_SESSION['add-category-data'] = $_POST;
      header('location:' . ROOT_URL . 'Admin/add-catergory.php');
      die(); 
   } else {
     // insert data category into databse
     $query = "INSERT INTO category (title, description) VALUES ('$title', '$description')";
     $result = mysqli_query($conn, $query);
     if (mysqli_errno($conn)) {
       $_SESSION['add-category'] = "Couldn't add category";
       header('location:' . ROOT_URL . 'Admin/add-catergory.php');
       die();
     } else {
        $_SESSION['add-category-success'] = "successfully added $title";
        header('location:' . ROOT_URL . 'Admin/manage-catergories.php');
        die();

     }
   }
}