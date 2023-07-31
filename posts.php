<?php
include 'partials/header.php';

//fetch the post from datatbase

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE po_id = $id";
    $result = mysqli_query($conn, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location:' . ROOT_URL . 'blog.php');
    die();
}
?>

    <section class="singlepost">
        <div class="container singlepost_container">
          <h2><?= $post['title'] ?></h2>
          <div class="post_author">
          <?php 
                //fetch author from users table using author_id
           $author_id = $post['author_id'];
           $author_query = "SELECT * FROM users WHERE id=$author_id";
           $author_result = mysqli_query($conn, $author_query);
           $author = mysqli_fetch_assoc($author_result);

                ?>
            <div class="post_author-avatar"> 
                <img src="./Images/<?= $author['avatar']?>">

            </div>
            <div class="post_author-info">
                <h5>By:<?= "{$author['firstname']} {$author['lastname']} "?></h5>
                <small><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></small>
            </div>
         </div>
         <div class="singlepost_thumbnail">
            
            <img src="./post-images/<?= $post['thumbnail']?>" >
         </div>
        <p><?= $post['body'] ?></p>
        </div>
    </section>


    <!--===========END OF Singlepost================-->

    <?php
include 'partials/footer.php'
?>
