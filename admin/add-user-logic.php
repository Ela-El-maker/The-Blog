<?php

require 'config/database.php';

//get add-user form data if add-user button was clicked
if (isset($_POST['submit'])) {
    $firstname=filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname=filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $username=filter_var($_POST['username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $email=filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword=filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
    $confirmpassword=filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin  = filter_var($_POST['user-role'], FILTER_SANITIZE_NUMBER_INT);

    $avatar=$_FILES['avatar'];

    //validate input values
    if(!$firstname){
        $_SESSION['add-user']='Please enter your First Name';
    }elseif(!$lastname){
        $_SESSION['add-user']= 'Please enter your Last Name';
    }elseif(!$username){
        $_SESSION['add-user']= 'Please enter your Username';
    }elseif(!$email){
        $_SESSION['add-user']= 'Please enter a valid email address';
    }elseif(strlen($createpassword) < 6 || strlen($confirmpassword) < 6){
        $_SESSION['add-user']='Password should be 6+ characters';
    }elseif(!$avatar['name']){
        $_SESSION['add-user']= 'Please add avatar';
    }else{
        //check if passwords match
        if($createpassword !== $confirmpassword){
            $_SESSION['add-user']= 'Passwords do not match';
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
            $_SESSION['add-user']= "Username or email already exists";
        }

        else{
            //Working on avatar
            //rename avatar
            $time =time();//make each image unique using current timestamp
            $avatar_name= $time . $avatar["name"];
            $avatar_tmp_name   = $avatar['tmp_name'];
            $avatar_destination_path = '../images/' . $avatar_name;

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
                    $_SESSION['add-user']='File size is too big. Should be less than 1mb';
                }
            } else{
                $_SESSION['add-user']= 'File should be png, jpg,jpeg';
            }
        }
    }
}

    //redirect back to add-user page if tehre was any problem
    if(isset($_SESSION['add-user'])){
        //pass form data back to sigup page
        $_SESSION['add-user-data'] = $_POST;

        header('location: ' . ROOT_URL .'/admin/add-user.php');
        die();
    }else{
        //insert new user into users table
        $insert_user_query = "INSERT INTO users(firstname,lastname,username,email,password,avatar,is_admin) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($connection, $insert_user_query);
        $isAdmin = $is_admin; // getting the is admin variable

        mysqli_stmt_bind_param($stmt, "ssssssi", $firstname, $lastname, $username, $email, $hashed_password, $avatar_destination_path, $isAdmin);
        $executionResult=mysqli_stmt_execute($stmt);

        if ($executionResult) {
            $_SESSION['add-user-success'] = "New user $firstname $lastname added successfully";
            header('location: '. ROOT_URL . 'admin/manage-users.php');
            exit();
        } else {
            $_SESSION['add-user'] = "Error: " . mysqli_error($connection);
            header('location: ' . ROOT_URL .'add-user.php');
            exit();
        }
        
    } 
}    
else 
{
    //if button wasn't clicked bounce back to add-user page
    header('location: ' . ROOT_URL .'admin/add-user.php');
    die();
}

