<?php
 include 'partials/header.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $query ="SELECT     * FROM users where id=$id";
    $result=mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
}else{
    header('location: ' . ROOT_URL .'admin/manage-users.php');
    die();
}

 ?>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Edit User</h2>
            <form action="<?php echo ROOT_URL ?>admin/edit-user-logic.php" enctype="multipart/form-data" method="post">
                <input type="hidden" value="<?php echo $user['id'] ?>" name="id">    
                <input type="text" value="<?php echo $user['firstname'] ?>" name="firstname" placeholder="First Name" id="">
                <input type="text" value="<?php echo $user['lastname'] ?>" name="lastname" placeholder="Last Name" id="">
                <select name="user-role" id="">
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select>
                <button type="submit" name="submit" class="btn">Update User</button>
            </form>
        </div>
    </section>

<?php
 include '../partials/footer.php';
 ?>