<?php 
    // include Constants.php For SITEURL 
    include('../config/constants.php');

    //1. Destroy The Session 
    session_destroy(); // Unsets $_SESSION['user];

    //2. Redirect To Login Page 
    header('Location:'.SITEURL.'admin/login.php');
?>