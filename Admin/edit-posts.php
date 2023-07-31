<?php
include 'partials/header.php';

// Fetch categories from database
$category_query = "SELECT * FROM category";
$categories = mysqli_query($conn, $category_query);

// Fetch post data from database
if (isset($_GET['id'])) {
   $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
   $query = "SELECT * FROM posts WHERE po_id = ?";
   $stmt = mysqli_prepare($conn, $query);

   if ($stmt) {
       mysqli_stmt_bind_param($stmt, 'i', $id);
       mysqli_stmt_execute($stmt);
       $result = mysqli_stmt_get_result($stmt);
       $post = mysqli_fetch_assoc($result);
       
       if (!$post) {
           header('location:' . ROOT_URL . 'Admin/');
           exit();
       }
   } else {
       header('location:' . ROOT_URL . 'Admin/');
       exit();
   }
} else {
    header('location:' . ROOT_URL . 'Admin/');
    exit();
}
?>


<section class="form_section">
    <div class="container form_section-container">
        <h2>Edit Posts</h2>
        <form action="<?= ROOT_URL ?>Admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?= $post['po_id'] ?>" >
            <input type="hidden" name="previous_thumbnail_name" value="<?= $post['thumbnail'] ?>" >
            <input type="text" name="title" value="<?= $post['title'] ?>" placeholder="Title" required>
            <select name="category" required>
                <?php while ($category = mysqli_fetch_assoc($categories)) :?>
                    <option value="<?= $category['cat_id'] ?>" <?= $category['cat_id'] == $post['category_id'] ? 'selected' : '' ?>>
                        <?= $category['title'] ?>
                    </option>
                <?php endwhile ?>
            </select>
            <textarea name="body" rows="10" placeholder="Body" required><?= $post['body'] ?></textarea>    
            <div class="form_control inline">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" <?= $post['is_featured'] == 1 ? 'checked' : '' ?>>
                <label for="is_featured">Featured</label>
            </div>
            <div class="form_control">
               <label for="thumbnail">Change Thumbnail</label>
               <input type="file" id="thumbnail" name="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Update post</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php';
?>
