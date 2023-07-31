 <?php 
 require 'config/database.php';

 if (isset($_GET['id'])) {
   //fetch user from databse

   $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);


    //make sure we got back only one user
    if (mysqli_num_rows($result) == 1) {
        $avatar_name = $user['avatar'];
        $avatar_path = '../Images/' . $avatar_name;

        //delete image if available
        if ($avatar_path) {
           unlink($avatar_path);
    }
   
 }
 // for later
 //fetch all thumbnails of users posts and delete them
$thumbnail_query = "SELECT thumbnail FROM posts WHERE author_id=$id";
$thumbnail_result = mysqli_query($conn, $thumbnail_query);
if (mysqli_num_rows($thumbnail_result) > 0) {
   while ($thumbnail = mysqli_fetch_assoc($thumbnail_result)) {
     $thumnail_path = '../post-images/' . $thumbnail['$thumbnail'];
     // delete thumbnail from images forlder
     if ($thumbnail_path) {
      unlink($thumbnail_path);
     }
   }
}





 //delete user from databse
 $delete_user_query = "DELETE FROM users WHERE id= $id";
 $delete_user_result = mysqli_query($conn, $delete_user_query);
 if (mysqli_errno($conn)) {
    $_SESSION['delete-user'] = "Couldn't delete '{$user['firstname']} '{$user['lastname']}'";
 } else {
    $_SESSION['delete-user-success'] = "Successfully deleted'{$user['firstname']} '{$user['lastname']}'";
 }
}
header('location:' . ROOT_URL . 'Admin/manage-users.php');
die();