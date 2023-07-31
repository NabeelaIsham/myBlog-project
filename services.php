<?php
include 'partials/header.php';

$query = "SELECT * FROM comments WHERE com_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $serviceId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


$query = "SELECT * FROM comments ORDER BY created_at DESC LIMIT 9 ";
$post_result = mysqli_query($conn, $query);
?>

    <header class="title_nav">
        <h2>Services</h2>
       
    </header>
    
    
    <section class="main">
    
        <div class="full-boxer">
        <?php while ($comment = mysqli_fetch_assoc($post_result)) : ?>
            <div class="comment-box">
                <div class="box-top">
                    <div class="Profile">
                        <!-- <div class="profile-image">
                            <img src="Images/Author1.jpg">
                        </div> -->
                        <div class="Name">
                            <strong><?= "{$comment['name']}" ?></strong>
                            <span><?= "{$comment['email']}" ?></span>
                            <span>  <?= "{$comment['created_at']}" ?></span>
                        </div>
                    </div>
                </div>
                <div class="comment">
                    <p>
                    <?= "{$comment['comment_text']}" ?>
                    </p>
                  
                </div>
            </div>

           

           

            <?php endwhile?>
        </div>
        
    </section>

   


    
    <?php
include 'partials/footer.php'
?>
