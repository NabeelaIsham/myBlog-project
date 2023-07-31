<?php
require 'config/database.php';
if (isset($_GET['id'])) {
   $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    
   //for later
   //update category _id of posts that belong to this category to id of uncategories category
  $update_query = "UPDATE posts SET category_id=9 WHERE category_id=$id ";
  $update_result = mysqli_query($conn, $update_query);


  if (!mysqli_errno($conn)) {
    //delete category
    $query = "DELETE FROM category WHERE cat_id = $id LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    $_SESSION['delete-category-success'] = "Category deleted successfully";
  }

  

}
header('location:' . ROOT_URL . 'Admin/manage-catergories.php');
die();