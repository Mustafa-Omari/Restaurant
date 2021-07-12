<?php 
    // Authurization  Are Access Control 
    //Check Whether The User Is Logged in  or not 
    if(!isset($_SESSION['user'])){ // If User Session Is Not Set 
        //User Is Not Logged In 
        // Redirect To Login Page With Message 

        $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login To Access Admin Pannel. </div>";

        // Redirect To Login Page  

        header('Location:'.SITEURL.'admin/login.php');

    }
?>