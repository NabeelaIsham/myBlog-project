<?php 
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch post from database in order to delete thumbnail from images folder
    $query = "SELECT * FROM posts WHERE po_id= $id";
    $result = mysqli_query($conn, $query);

    // make sure only 1 record /post was fetched
    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        $thumbnail_name = $post['thumbnail'];
        $thumbnail_path = '../post-images/' . $thumbnail_name;


        if ($thumbnail_path) {
            unlink($thumbnail_path);

            // delete post from database
            $delete_post_query = "DELETE FROM posts WHERE po_id = $id LIMIT 1 ";
            $delete_post_result = mysqli_query($conn, $delete_post_query);

            if (!mysqli_errno($conn)) {
               $_SESSION['delete-post-success'] = "Post deleted successfully";
            }
        }

    }
}
header('location:' . ROOT_URL . 'Admin/');
die();