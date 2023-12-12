<?php
require '../partials/header.php';

//login status
if(!isset($_SESSION['user-id'])){
    header('location: ' . ROOT_URL .'login.php');
    die();
}




