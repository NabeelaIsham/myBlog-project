<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    session_start();

    // Get form data
    $author_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $thumbnail = $_FILES['thumbnail'];

    // Validate form
    $errors = [];

    if (!$title) {
        $errors[] = "Enter post title";
    }

    if (!$category_id) {
        $errors[] = "Select post category";
    }

    if (!$body) {
        $errors[] = "Describe the post";
    }

    if (!$thumbnail['name']) {
        $errors[] = "Choose post thumbnail";
    }

    // Process thumbnail
    $allowed_extensions = ['png', 'jpg', 'jpeg'];
    $thumbnail_name = '';

    if ($thumbnail['name']) {
        $extension = strtolower(pathinfo($thumbnail['name'], PATHINFO_EXTENSION));

        if (!in_array($extension, $allowed_extensions)) {
            $errors[] = "File should be PNG, JPG, or JPEG";
        } elseif ($thumbnail['size'] > 2000000) {
            $errors[] = "File size too big. Should be less than 2MB";
        } else {
            $time = time();
            $thumbnail_name = $time . '_' . $thumbnail['name'];
            $thumbnail_destination_path = '../post-images/' . $thumbnail_name;

            if (!move_uploaded_file($thumbnail['tmp_name'], $thumbnail_destination_path)) {
                $errors[] = "Error uploading thumbnail";
            }
        }
    }

    // Insert post into database
    if (empty($errors)) {
        $query = "INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured)
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'sssiii', $title, $body, $thumbnail_name, $category_id, $author_id, $is_featured);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $_SESSION['add-post-success'] = "New post added successfully";
                header('location: ' . ROOT_URL . 'Admin/');
                exit();
            } else {
                $errors[] = "Failed to insert post into database";
            }
        } else {
            $errors[] = "Database query error";
        }
    }

    // Handle errors
    if (!empty($errors)) {
        $_SESSION['add-post'] = implode('<br>', $errors);
        $_SESSION['add-post-data'] = $_POST;
    }

    header('location: ' . ROOT_URL . 'Admin/add-posts.php');
    exit();
}

header('location: ' . ROOT_URL . 'Admin/add-posts.php');
exit();
?>
