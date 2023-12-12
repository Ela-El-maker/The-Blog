<?php
include 'partials/header.php';

//get back form data if there was an error
$firstname= $_SESSION['add-user-data']['firstname'] ?? null;
$lastname= $_SESSION['add-user-data']['lastname'] ?? null;
$username= $_SESSION['add-user-data']['username'] ?? null;
$email= $_SESSION['add-user-data']['email'] ?? null; 
$createpassword= $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword= $_SESSION['add-user-data']['confirmpassword'] ?? null;

//delete session data
unset($_SESSION['add-user-data']);

?>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Add User</h2>
            <?php if(isset($_SESSION['add-user'])) : ?>
                <div class="alert__message error">
                <p>
                    <?php echo $_SESSION['add-user'];
                    unset($_SESSION['add-user']);
                    ?>
                </p>
            </div>
            <?php endif ?>
            <form action="<?php echo ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="firstname" value="<?php echo $firstname ?>" placeholder="First Name" id="">
                <input type="text" name="lastname" value="<?php echo $lastname ?>" placeholder="Last Name" id="">
                <input type="text" name="username" value="<?php echo $username ?>" placeholder="Username" id="">
                <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email" id="">
                <input type="password" name="createpassword" value="<?php echo $createpassword ?>" placeholder="Create Password" id="">
                <input type="password" name="confirmpassword" value="<?php echo $confirmpassword ?>" placeholder="Confirm Password" id="">
                <select name="user-role" id="">
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select>
                <div class="form__control">
                    <label for="avatar">User Avatar</label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button type="submit" name="submit" class="btn">Add User</button>
            </form>
        </div>
    </section>
 <?php
 include '../partials/footer.php';
 ?>