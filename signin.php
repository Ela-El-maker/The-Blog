<?php
require'config/constants.php';

$username_email =$_SESSION['signin-data']['username_email'] ?? null;
$password=$_SESSION ['signin-data']['password'] ?? null;
unset($_SESSION['signin-data']);
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
            <h2>Sign In</h2>
            <?php  if(isset($_SESSION['signup-success'])) : ?>
            <div class="alert__message success">
                <p>
                    <?php echo $_SESSION['signup-success'];
                    unset($_SESSION['signup-success']); ?>
                </p>
            </div>
            <?php endif ?>
            <form action="<?php echo ROOT_URL ?>signin-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="username_email" value="<?php echo $username_email ?>" placeholder="Username or Email" id="">
                <input type="password" name="password"  value="<?php echo $password ?> placeholder="Password" id="">
                <button type="submit" name="submit" class="btn">Sign In</button>
                <small>Don't have an account ? <a href="signup.php">Sign Up</a></small>
            </form>
        </div>
    </section>
</body>
</html>