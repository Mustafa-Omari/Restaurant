<?php include('../config/constants.php') ?>

<html>
    <head>
        <title> Login - Restaurant System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- Login Form Starts Here  -->
            <form action="" method="POST" class="text-center">
                Username:  <br>
                <input type="text" name="username" placeholder="Enter Username"> <br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"> <br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!-- Login Form Ends Here  -->


            <p class="text-center">Created By - <a href="#">  Mustafa Omari</a></p>
        </div>
    </body>

</html>

<?php
    // Check Whether The Submit Button Is Clicked Or Not
    if(isset($_POST['submit'])){
        // echo 'Button Clicked';

        //Proccess For Login 

        //1. Get The Data From Login Form  
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL Th Check Whether The USer With Username And Password  Exists OR Not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute The Query 
        $res = mysqli_query($conn ,$sql);

        //4. COunt Rows To Check Whether The USer Exists Or Not 
        $count = mysqli_num_rows($res);

        if($count == 1) { 
            // USer Available And Login Success 
            $_SESSION['login'] = "<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username; // To Check Whether the user is logged in or not and logout will unset it  
            
            // Redirect To Home Page/Dashboard
            header('Location:'.SITEURL.'admin/index.php');
        }else { 
            // User Not Available And Login Fail
            $_SESSION['login'] = "<div class='error text-center'>Username. or Password. did not match</div>";
            // Redirect To Home Page/Dashboard
            header('Location:'.SITEURL.'admin/login.php');

        }


    }else {
        // echo 'Button Not Clicked';
    }

?>