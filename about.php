<?php
include 'partials/header.php';

// fetch featured post from database
$featured_query = "SELECT * FROM posts WHERE is_featured = 1";
$featured_result = mysqli_query($conn, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);
?>

    <header class="title_nav">
        <h2>About us</h2>
    </header>
    
    <div class="heading">
      
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore doloribus
             voluptas iste dicta magni, consequatur numquam cumque tempore! Repellendus, quod? 
            Incidunt, hic modi. Rerum sint, iusto reprehenderit voluptatibus a dicta!
        </p>
    </div>
    <div class=" about-container">
        <section class="about">
            <div class="about-imge">
            <img src="./post-images/<?= $featured['thumbnail'] ?>">
            </div>
            <div class="about-content">
                <h2>lorem</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br> Possimus voluptates 
                    suscipit sed ducimus vitae. Nisi tempora repellendus, <br>iusto, eveniet quisquam suscipit 
                    nam, sed fugit nostrum labore <br>neque exercitationem inventore distinctio.</p>
                    <a href="<?= ROOT_URL ?>index.php" class="btn"> Explore</a>
            </div>
        </section>
    </div>

    
    <?php
include 'partials/footer.php';
?>