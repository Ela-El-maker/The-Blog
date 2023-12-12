<?php

require 'config/database.php';

//get signup form data if signup button was clicked
if (isset($_POST['submit'])) {
    $firstname=filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname=filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $username=filter_var($_POST['username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $email=filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword=filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
    $confirmpassword=filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar=$_FILES['avatar'];

    //validate input values
    if(!$firstname){
        $_SESSION['signup']='Please enter your First Name';
    }elseif(!$lastname){
        $_SESSION['signup']= 'Please enter your Last Name';
    }elseif(!$username){
        $_SESSION['signup']= 'Please enter your Username';
    }elseif(!$email){
        $_SESSION['signup']= 'Please enter a valid email address';
    }elseif(strlen($createpassword) < 6 || strlen($confirmpassword) < 6){
        $_SESSION['signup']='Password should be 6+ characters';
    }elseif(!$avatar['name']){
        $_SESSION['signup']= 'Please add avatar';
    }else{
        //check if passwords match
        if($createpassword !== $confirmpassword){
            $_SESSION['signup']= 'Passwords do not match';
    }else{
        //hash password
        $hashed_password=password_hash($createpassword, PASSWORD_DEFAULT); 
        //check if username or email already exists in the database
        $user_check_query= "SELECT * FROM users WHERE username=? OR email=?";
        $stmt = mysqli_prepare($connection, $user_check_query);
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0){
            $_SESSION['signup']= "Username or email already exists";
        }

        else{
            //Working on avatar
            //rename avatar
            $time =time();//make each image unique using current timestamp
            $avatar_name= $time . $avatar["name"];
            $avatar_tmp_name   = $avatar['tmp_name'];
            $avatar_destination_path = 'images/' .$avatar_name;

            //make sure the file is an image
            $allowed_files=['png','jpg','jpeg' ];
            $extention =explode('.',$avatar_name);
            $extention=end($extention);

            if(in_array($extention,$allowed_files)){
                //make sure the image is not too large (1mb+)

                if($avatar['size'] < 1000000){
                    //upload avatar
                    move_uploaded_file($avatar_tmp_name,$avatar_destination_path);
                }else{
                    $_SESSION['signup']='File size is too big. Should be less than 1mb';
                }
            } else{
                $_SESSION['signup']= 'File should be png, jpg,jpeg';
            }
        }
    }
}

    //redirect back to signup page if tehre was any problem
    if(isset($_SESSION['signup'])){
        //pass form data back to sigup page
        $_SESSION['signup-data'] = $_POST;

        header('location: ' . ROOT_URL .'signup.php');
        die();
    }else{
        //insert new user into users table
        $insert_user_query = "INSERT INTO users(firstname,lastname,username,email,password,avatar,is_admin) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($connection, $insert_user_query);
        $isAdmin = 0; // Assuming non-admin by default

        mysqli_stmt_bind_param($stmt, "ssssssi", $firstname, $lastname, $username, $email, $hashed_password, $avatar_destination_path, $isAdmin);
        $executionResult=mysqli_stmt_execute($stmt);

        if ($executionResult) {
            $_SESSION['signup-success'] = "Registration successful. Please log in!!!";
            header('location: '. ROOT_URL . 'signin.php');
            exit();
        } else {
            $_SESSION['signup'] = "Error: " . mysqli_error($connection);
            header('location: ' . ROOT_URL .'signup.php');
            exit();
        }
        
    } 
}    
else 
{
    //if button wasn't clicked bounce back to signup page
    header('location: ' . ROOT_URL .'signup.php');
    die();
}

