<?php
include 'partials/header.php';

//fetch posts if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE category_id=$id ORDER BY date_time DESC ";
    $post_result = mysqli_query($conn, $query);
} else {
    header('location:' .ROOT_URL . 'blog.php');
}
?>


<header class="category_title">

    <h2><?php
                //fetch category from categories table using category_id of post
                $category_id = $id ;
                $category_query = "SELECT * FROM category WHERE cat_id = $category_id";
                $category_result = mysqli_query($conn, $category_query);
                $category = mysqli_fetch_assoc($category_result);
                echo $category['title'];
              
                ?></h2>
</header>

 <!--===========END OF Category title================-->

 <?php  if (mysqli_num_rows($post_result) > 0) : ?>
 <section class="posts">
            <div class="container posts_container"> 
                <?php while ($posts = mysqli_fetch_assoc($post_result)) : ?>
                <article class="post">
                    <div class="post_thumbail">
                        <img src="./post-images/<?= $posts['thumbnail'] ?>" >
                    </div>    
                    <div class="post_info">
               
                       
                        <h3 class="post_title">
                        <a href="<?= ROOT_URL ?>posts.php?id=<?= $posts['po_id']?>"><?= $posts['title'] ?></a>
                            </h3>
        
                        <p class="post_body"><?= substr($posts['body'], 0, 150)?>...
                            </p>
        
                             <div class="post_author">
                             <?php 
                //fetch author from users table using author_id
           $author_id = $posts['author_id'];
           $author_query = "SELECT * FROM users WHERE id=$author_id";
           $author_result = mysqli_query($conn, $author_query);
           $author = mysqli_fetch_assoc($author_result);

                ?>
                                <div class="post_author-avatar"> 
                                    <img src="./Images/<?= $author['avatar']?>">
        
                                </div>
                                <div class="post_author-info">
                                    <h5>By:<?= "{$author['firstname']} {$author['lastname']} "?></h5>
                                    <small><?= date("M d, Y - H:i", strtotime($posts['date_time'])) ?></small>
                                </div>
                             </div>
                    </div>
        </article> 
        <?php endwhile ?>
        
       


    </div>
         </section>
         <?php else : ?>
               <div class = "alert_message error lg">
                <p>No posts found for this category</p>
               </div>


            <?php endif ?>
          <!--===========END OF Posts================-->

          <section class="category_buttons">
            <div class="container category_buttons-container">
                <?php 
                $all_categories_query = "SELECT * FROM category";
                $all_categories_result = mysqli_query($conn, $all_categories_query);

                 ?>
                 <?php while ($category = mysqli_fetch_assoc($all_categories_result)) : ?>
                <a href="<?= ROOT_URL ?>catergory-posts.php?id=<?= $category['cat_id']?>" class="category_button"><?= $category['title'] ?></a>
                <?php endwhile ?>
                
            </div>
          </section>

<!--===========END OF category================-->


<?php
include 'partials/footer.php'
?>
