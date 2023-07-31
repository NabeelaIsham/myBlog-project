<?php
include 'partials/header.php'
?>

    <header class="title_nav">
        <h2>Contact Us</h2>
    </header>


<section class=" contact-form_section">
    <div class="container contact-form_section-container">
        <h2>Contact Form</h2>
        
        <form action="https://formsubmit.co/nabeelaisham28@gmail.com" method="POST">
            <input type="text" name="Name" placeholder="Full Name" required>
            <input type="email" name="Email" placeholder="Email" required>
            <textarea name="Message" rows="10" placeholder="Message" required></textarea>
            <button type="submit" class="btn">Send Message</button> 
          
         
        </form>

    </div>
</section>




    
<?php
include 'partials/footer.php'
?>
