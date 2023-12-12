<?php
require 'config/constants.php';
//get back form data if there was a registration error
$firstname= $_SESSION['signup-data']['firstname'] ?? null;
$lastname= $_SESSION['signup-data']['lastname'] ?? null;
$username= $_SESSION['signup-data']['username'] ?? null;
$email= $_SESSION['signup-data']['email'] ?? null; 
$createpassword= $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword= $_SESSION['signup-data']['confirmpassword'] ?? null;

//delete signup data session
unset($_SESSION['signup-data']);

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Responsive Multipage Blog</title>
        <!---CUSTOM  STYLESHEET---->
        <link rel="stylesheet" href="<?php echo ROOT_URL ?>css/style.css">
        <!---Font family----Monserrat-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,600;1,100;1,800&display=swap" rel="stylesheet">
        <!---Iconscout cdn-->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        </head>
<body>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Sign Up</h2>
            <?php if (isset($_SESSION['signup'])): ?>
                <div class="alert__message error">
                    <p>
                    <?= $_SESSION['signup'];
                    unset($_SESSION['signup']);
                    ?>
                    </p>

                </div>
            <?php endif ?>
            <form action="<?php echo ROOT_URL?>signup-logic.php" enctype="multipart/form-data" method="post">
                <input type="text" name="firstname" value="<?php echo $firstname ?>" placeholder="First Name" id="">
                <input type="text" name="lastname" value="<?php echo $lastname ?>" placeholder="Last Name" id="">
                <input type="text" name="username" value="<?php echo $username ?>" placeholder="Username" id="">
                <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email" id="">
                <input type="password" value="<?php echo $createpassword ?>" name="createpassword" placeholder="Create Password" id="">
                <input type="password" value="<?php echo $confirmpassword ?>" name="confirmpassword" placeholder="Confirm Password" id="">
                <div class="form__control">
                    <label for="avatar">User Avatar</label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button type="submit" name="submit" class="btn">Sign Up</button>
                <small>Already have an account ? <a href="login.php">Sign In</a></small>
            </form>
        </div>
    </section>
</body>
</html>