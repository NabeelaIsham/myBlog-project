<?php

include 'partials/header.php';

// fetch user from databse but not currrent user
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM users WHERE NOT id = $current_admin_id";
$user = mysqli_query($conn, $query);
?>

<section class="dashboard">
<?php
 if (isset($_SESSION['add-user-success']))  ://shows if add user was successfull  ?>
             <div class="alert_message success container">
            <p>
                <?= $_SESSION['add-user-success'];
                unset($_SESSION['add-user-success']) ?>
            </p>
        </div>

        <?php elseif (isset($_SESSION['edit-user-success']))  ://shows if edit user was successfull  ?>
             <div class="alert_message success container">
            <p>
                <?= $_SESSION['edit-user-success'];
                unset($_SESSION['edit-user-success']) ?>
            </p>
        </div>


        <?php elseif (isset($_SESSION['edit-user']))  ://shows if edit user was not successful  ?>
             <div class="alert_message error container">
            <p>
                <?= $_SESSION['edit-user'];
                unset($_SESSION['edit-user']) ?>
            </p>
        </div>
      

        <?php elseif (isset($_SESSION['delete-user-success']))  ://shows if delete user was  successful  ?>
             <div class="alert_message success container">
            <p>
                <?= $_SESSION['delete-user-success'];
                unset($_SESSION['delete-user-success']) ?>
            </p>
        </div>
        
        <?php elseif (isset($_SESSION['delete-user']))  ://shows if delete user was not successful  ?>
             <div class="alert_message error container">
            <p>
                <?= $_SESSION['delete-user'];
                unset($_SESSION['delete-user']) ?>
            </p>
        </div>
        <?php endif ?>

    <div class="container dashboard_container">
        <button id="show_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
      

        <aside>
            <ul>
                <li><a href="add-posts.php"><i class="uil uil-pen"></i>
                    <h5>Add Post</h5>
                </a></li>
                <li><a href="index.php"><i class="uil uil-postcard"></i>
                    <h5>Manage Post</h5>
                </a></li>
                <?php 
                if (isset($_SESSION['user_is_admin'])): {
                    # code...
                }
                 ?>
                <li><a href="add-user.php"><i class="uil uil-user-plus"></i>
                    <h5>Add User</h5>
                </a></li>
                <li><a href="manage-users.php" class="active"><i class="uil uil-users-alt"></i>
                    <h5>Manage user</h5>
                </a></li>
                <li><a href="add-catergory.php"><i class="uil uil-edit"></i>
                    <h5>Add Category</h5>
                </a></li>

                <li><a href="manage-catergories.php" ><i class="uil uil-list-ul"></i>
                    <h5>Manage Category</h5>
                </a></li>
                <?php endif ?>
            </ul>

        </aside>
        <main>
             <h2>Manage Users</h2>
             <?php if (mysqli_num_rows($user) > 0) : ?>

             <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($users = mysqli_fetch_assoc($user)) : ?>
                    <tr>
                        <td><?= "{$users['firstname']} {$users['lastname']}" ?></td>
                        <td><?= $users['username'] ?></td>
                        <td><a href="<?= ROOT_URL ?>Admin/edit-user.php?id=<?= $users['id']?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>Admin/delete-user.php?id=<?= $users['id']?>" class="btn sm danger">Delete</a></td>
                        <td><?= $users['is_admin']? 'Yes' : 'No' ?></td>
                    </tr>
                    <?php endwhile ?>
                  <!--   <tr>
                        <td>Salena Druw</td>
                        <td>Salena</td>
                        <td><a href="edit-user.php" class="btn sm">Edit</a></td>
                        <td><a href="delete-catergory.php" class="btn sm danger">Delete</a></td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Eren Machel</td>
                        <td>Eren</td>
                        <td><a href="edit-user.php" class="btn sm">Edit</a></td>
                        <td><a href="delete-catergory.php" class="btn sm danger">Delete</a></td>
                        <td>No</td>
                    </tr> -->
                   
                </tbody>
             </table>
             <?php else : ?>
                <div class = "alert_message error"><?= "No users found" ?></div>
                <?php endif ?>
        </main>
    </div>
</section>

<?php

include '../partials/footer.php';
?>