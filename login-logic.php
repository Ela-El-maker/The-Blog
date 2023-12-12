<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($username_email)) {
        $_SESSION['signin'] = 'Username or Email is required';
    } elseif (empty($password)) {
        $_SESSION['signin'] = 'Password is required';
    } else {
        // Prepared statement to fetch user from the database
        $fetch_user_query = "SELECT * FROM users WHERE username=? OR email=?";
        $stmt = mysqli_prepare($connection, $fetch_user_query);
        mysqli_stmt_bind_param($stmt, "ss", $username_email, $username_email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && $row = mysqli_fetch_assoc($result)) {
            $db_password = $row['password'];

            if (password_verify($password, $db_password)) {
                //set session for access control
                $_SESSION['user-id'] = $row['id'];
                
                //set session if user is an admin
                if ($row['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }

                header('location: ' . ROOT_URL . 'admin/'); // Redirect to dashboard or user home
                exit();
            } else {
                $_SESSION['signin'] = 'Please check your credentials';
            }
        } else {
            $_SESSION['signin'] = 'User not found';
        }
    }

    // Redirect back to login page with login data if there was any problem
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'login.php');
        exit();
    }
} else {
    header('location: ' . ROOT_URL . 'login.php');
    exit();
}
