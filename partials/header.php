<?php
require 'config/database.php';

//fetch current user from database
if (isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $avatar = mysqli_fetch_assoc($result)) {
        $avatarPath = $avatar['avatar'];
    } else {
        // Set a default image if no avatar is found
        $avatarPath = ''; // Replace with your default image path
    }



}

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
    <nav>
        <div class="container nav__container">
            <a href="<?php echo ROOT_URL ?>" class="nav__logo">ELA</a>
            <ul class="nav__items">
                <li><a href="<?php echo ROOT_URL ?>blog.php">Blog</a></li>
                <li><a href="<?php echo ROOT_URL ?>about.php">About</a></li>
                <li><a href="<?php echo ROOT_URL ?>services.php">Services</a></li>
                <li><a href="<?php echo ROOT_URL ?>contact.php">Contact</a></li>
                <?php if( isset($_SESSION['user-id'])): ?>
                    <li class="nav__profile">
                        <!-- Inside the avatar div -->
                        <div class="avatar">
                            <img src="<?php echo ROOT_URL . 'images/' . $avatarPath ?>">
                        </div>
  
                    <ul>
                        <li><a href="<?php echo ROOT_URL ?>admin/index.php">Dashboard</a></li>
                        <li><a href="<?php echo ROOT_URL ?>logout.php">Logout</a></li>
                    </ul>
                </li>

                <?php else : ?>
                <li><a href="<?php echo ROOT_URL ?>login.php">Sign In</a></li>
                <?php endif ?>
            </ul>
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
    <!----------End of nav-------->
