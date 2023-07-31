<?php
include 'partials/header.php';

// fetch featured post from database
$featured_query = "SELECT * FROM posts WHERE is_featured = 1";
$featured_result = mysqli_query($conn, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

// fetch 9 post from posts table
$query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 9 ";
$post_result = mysqli_query($conn, $query);
?>


<!-- if there is featured post shown any -->
<?php if (mysqli_num_rows($featured_result) == 1) : ?>
    <section class="featured">
        <div class="container featured_container">
            <div class="post_thumbail">
                <img src="./post-images/<?= $featured['thumbnail'] ?>">
            </div>
            <div class="post_info">
                <?php
                //fetch category from categories table using category_id of post
                $category_id = $featured['category_id'];
                $category_query = "SELECT * FROM category WHERE cat_id = $category_id";
                $category_result = mysqli_query($conn, $category_query);
                $category = mysqli_fetch_assoc($category_result);
              
                ?>
                <a href="<?= ROOT_URL ?>catergory-posts.php?id=<?= $category['cat_id']?>" class="category_button"><?= $category['title'] ?></a>
                <h2 class="post_title">
                    <a href="<?= ROOT_URL ?>posts.php?id=<?= $featured['po_id']?>"><?= $featured['title'] ?></a>
                 
                </h2>
                <p class="post_body"><?= substr($featured['body'], 0, 300)?>...</p>
                <div class="post_author">

                <?php 
                //fetch author from users table using author_id
           $author_id = $featured['author_id'];
           $author_query = "SELECT * FROM users WHERE id=$author_id";
           $author_result = mysqli_query($conn, $author_query);
           $author = mysqli_fetch_assoc($author_result);

                ?>
                    <div class="post_author-avatar">
                        <img src="./Images/<?= $author['avatar']?>">
                    </div>
                    <div class="post_author-info">
                        <h5>By: <?= "{$author['firstname']} {$author['lastname']} "?></h5>
                        <small><?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?></small>
                    </div>
                    
                </div>
                
<button id="commentButton" class="btn" >Comment</button>

<div id="commentBox" class="comment-box">
  <form id="commentForm" action="process-comment.php" method="POST">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your email" required>
    <textarea name="comment_text" placeholder="Your Comment" required></textarea>
    
    <button type="submit" name="submit" class="btn">Submit</button>
  </form>
</div>



            </div>

        </div>  
     </section>
        <?php endif ?>
         <!--===========END OF Featured================-->


    


         <section class="posts <?= $featured ? '' : 'section_extra-margin' ?> ">
            <div class="container posts_container"> 
                <?php while ($posts = mysqli_fetch_assoc($post_result)) : ?>
                <article class="post">
                    <div class="post_thumbail">
                        <img src="./post-images/<?= $posts['thumbnail'] ?>" >
                    </div>    
                    <div class="post_info">
                    <?php
                //fetch category from categories table using category_id of post
                $category_id = $posts['category_id'];
                $category_query = "SELECT * FROM category WHERE cat_id = $category_id";
                $category_result = mysqli_query($conn, $category_query);
                $category = mysqli_fetch_assoc($category_result);
              
                ?>
                        <a href="<?= ROOT_URL?>catergory-posts.php?id=<?= $posts['category_id']?>" class="category_button"> <?= $category['title']?></a>
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
        <?php endwhile?>
        
       


    </div>
         </section>
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
 include 'partials/footer.php';

?>

  