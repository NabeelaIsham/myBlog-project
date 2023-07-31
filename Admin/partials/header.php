<?php
require '../partials/header.php';

//check login status
if (!isset($_SESSION['user-id'])) {

   header('location:' . ROOT_URL . 'signin.php');
   die();
}
//fetch current user from datbase
/* if (isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id=$id";
    $result = mysqli_query($conn, $query);
    $avatar = mysqli_fetch_assoc($result);

} */

/* ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multipage Blog Website</title>
    <!--CUSTOM STYLESHEET-->
    <link rel="stylesheet" href="<?= ROOT_URL?>css/style.css">
     <!--ICONSCOUT CDN-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/solid.css">
    <!--Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Open+Sans:wght@300&display=swap" rel="stylesheet">


    

</head>
<body>

    
    <nav>
        <div class="container nav_container">
               <a href="<?= ROOT_URL?>" class="nav_logo">NR </a>
                          <ul class="nav_items">
                            <li><a href="<?= ROOT_URL?>blog.php"> Blogs</a></li>
                            <li><a href="<?= ROOT_URL?>about.php">About</a></li>
                            <li><a href="<?= ROOT_URL?>services.php">Services</a></li>
                            <li><a href="<?= ROOT_URL?>contact.php">Contacts</a></li>

                            <?php 
                             if (isset($_SESSION['user-id'])): ?>              
                             <li class="nav_profile">
                                <div class="avatar">
                                     <img src="<?= ROOT_URL . 'Images/' .$avatar['avatar'] ?>" >
                                   
                                </div>
                                <ul>
                                    <li><a href="<?= ROOT_URL?>Admin/index.php">DashBoard</a></li>
                                    <li><a href="<?= ROOT_URL?>logout.php">Logout</a></li>
                                </ul>
                            </li>
                            <?php else : ?>
                          <li><a href="<?= ROOT_URL?>signin.php">Signin</a></li>
                           <?php endif ?>

                          </ul>
<button id="open_nav-btn"><i class="uil uil-bars"></i></button>
<button id="close_nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
    <!--===========END OF NAV================-->
 */