<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) {  // Check Whether The Session Is Isset Or Not 
                echo $_SESSION['add']; // Desplay Session Messege is set 
                unset($_SESSION['add']); // Removing Session Message  
            }
        ?>



        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name : </td>
                    <td>
                        <input type="text" name="fullname" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>



<?php  include('partials/footer.php'); ?> 


<?php
    // Process The Value From Form And Save it in Database 
    
    // Check Whether the submit button is clicked or not 

    if(isset($_POST['submit'])) {

        // Button Clicked 
        // echo 'Button Clicked' ;

        //1. Get The Data From Form  
        
        $full_name = $_POST['fullname']; 
        $username = $_POST['username']; 
        $password = md5($_POST['password']); // Passwrod Encryprtion with md5
        
        //2. SQL Query To save the data into Database
        
        $sql = "INSERT INTO 
                    tbl_admin 
                SET 
                    full_name='$full_name' ,
                    username='$username' ,
                    password='$password'
                ";

        //3. Execute Query And saving into database 
        $res = mysqli_query($conn , $sql) or die(mysqli_error());
        
        //4. Check wether the(Query is Executed) data is iserted or not and display appropriate  message 
        if($res == TRUE) { 
            // Data Inserted 
            // echo 'Data Inserted';
            // Create A Session Variable To Display Message 
            $_SESSION['add'] = "<div class='success'>Admin Added Successfuly. </div>";
            // Redirect Page To Manage Admin
            header('Location:'.SITEURL.'admin/manage-admin.php');
        }else { 
            // Faild To Inser Data 
            // echo 'Faild To Insert Data ' ; 
            // Create A Session Variable To Display Message 
            $_SESSION['add'] = "<div class='danger'> Faild To Add Admin. </div>";
            // Redirect Page To Add Admin
            header('Location:'.SITEURL.'admin/add-admin.php');

        }

        
    }else {

        // Button Not Clicked
        // echo 'Button Not Clicked' ;
    }

?>

