<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
   $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
   $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
   $is_featured = isset($_POST['is_featured']) ? 1 : 0; // Set is_featured to 1 if it was checked, otherwise set it to 0
   $thumbnail = $_FILES['thumbnail'];

   // Check and validate input values
   if (!$title || !$category_id || !$body) {
       $_SESSION['edit-post'] = "Couldn't update post.";
   } else {
       // Delete existing thumbnail if a new thumbnail is available
       if ($thumbnail['name']) {
           $previous_thumbnail_path = '../post-images/' . $previous_thumbnail_name;
           if ($previous_thumbnail_name && file_exists($previous_thumbnail_path)) {
               unlink($previous_thumbnail_path);
           }
           // Rename image
           $time = time(); // Make each image name unique using the current timestamp
           $thumbnail_name = $time . $thumbnail['name'];
           $thumbnail_tmp_name = $thumbnail['tmp_name'];
           $thumbnail_destination_path = '../post-images/' . $thumbnail_name;

           // Make sure file is an image
           $allowed_files = ['png', 'jpg', 'jpeg'];
           $extension = explode('.', $thumbnail_name);
           $extension = strtolower(end($extension));
           if (in_array($extension, $allowed_files)) {
               // Make sure thumbnail is not too large (2MB)
               if ($thumbnail['size'] < 2000000) {
                   // Upload thumbnail
                   move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
               } else {
                   $_SESSION['edit-post'] = "Couldn't update post.";
               }
           } else {
               $_SESSION['edit-post'] = "File should be a PNG, JPG, or JPEG.";
           }
       }

       if ($_SESSION['edit-post']) {
           // Redirect to manage form page if the form was invalid
           header('location:' . ROOT_URL . 'Admin/');
           die();
       } else {
           // Set is_featured of all posts to 0 if the is_featured post is 1
           if ($is_featured == 1) {
               $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0";
               $zero_all_is_featured_result = mysqli_query($conn, $zero_all_is_featured_query);
               if (!$zero_all_is_featured_result) {
                   $_SESSION['edit-post'] = "Error updating is_featured status.";
                   header('location:' . ROOT_URL . 'Admin/');
                   die();
               }
           }
           // Set thumbnail name if a new one was uploaded, else keep the old thumbnail name
           $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;

           $query = "UPDATE posts SET title = ?, body = ?, thumbnail = ?, category_id = ?, is_featured = ? WHERE po_id = ?";
           $stmt = mysqli_prepare($conn, $query);
           mysqli_stmt_bind_param($stmt, "sssiii", $title, $body, $thumbnail_to_insert, $category_id, $is_featured, $id);
           $result = mysqli_stmt_execute($stmt);

           if ($result) {
               $_SESSION['edit-post-success'] = "Post updated successfully.";
           } else {
               $_SESSION['edit-post'] = "Error updating the post: " . mysqli_error($conn);
           }
           mysqli_stmt_close($stmt);
       }
   }

   header('location:' . ROOT_URL . 'Admin/');
   die();
}
