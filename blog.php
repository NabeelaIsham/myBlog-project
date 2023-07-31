<?php
include 'partials/header.php';

// fetch all post from posts table
$query = "SELECT * FROM posts ORDER BY date_time DESC  ";
$post_result = mysqli_query($conn, $query);
?>

    <section class="search_bar">
        <form class="container search_bar-container" action="<?= ROOT_URL ?>search.php " method="GET">
            <div>
                <i class="uil uil-search"></i>
                <input type="search" name="search" placeholder="Search">
            </div>
            <button type="submit" name="submit" class="btn">Go</button>
        </form>
    </section>
    
 <!--===========END OF Search================-->

       
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
include 'partials/footer.php'
?>
