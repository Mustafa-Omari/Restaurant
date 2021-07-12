<?php include('partials/menu.php'); ?>
    
    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password</h1>
            
            <br><br>

            <?php 
                if(isset($_GET['id'])){

                    $id = $_GET['id'];
                }
            ?>


            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Old Password: </td>
                        <td>
                            <input type="password" name="old_password" placeholder="Old Password">
                        </td>
                    </tr>

                    <tr>
                        <td>New Password: </td>
                        <td>
                            <input type="password" name="new_password" placeholder="New Password">
                        </td>
                    </tr>

                    <tr>
                        <td>Confirm Password </td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="Confirm Password" >
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id ; ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary"> 
                        </td>    
                    </tr>
                
                </table>

            </form>

        </div>
    </div>

<?php 
    // Check Whether The Submit Button Is Clicked Or Not 
    if(isset($_POST['submit'])) {
        //echo 'Clicked';
        
        //1. Get The Data From The Form 

        $id = $_POST['id'];
        $old_password = md5($_POST['old_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //2. Check Whether The User With Current ID And Current Password Exist Or Not 
        $sql = "SELECT * FROM tbl_admin WHERE id='$id' AND password='$old_password'";

        // Execute The Query 
        $res = mysqli_query($conn , $sql ) ;

        if($res == TRUE ){  

            // Check Whether Data Is Availabe Or Not 
            $count = mysqli_num_rows($res) ; 

            if($count == 1 ) { 

                // User Exists And Password Cant Be Changed
                // echo "User FOund. "; 

                // Check Whether The New PAssword And Confirm Password Match Or Not 
                if($new_password == $confirm_password) { 
                    // Update Password 
                    //echo 'Password Is Match ';

                    $sql2="UPDATE tbl_admin
                            Set password='$new_password'
                            WHERE id=$id;
                    ";

                    // Execute Query 
                    $res2 = mysqli_query($conn , $sql2);

                    // Check Whether The Query Executed Or Not 
                    if($res2 == TRUE) { 
                        // Display Success Message 
                        // Redirect To Manage ADmin PAge  With Success Message 
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfuly. </div>" ;
                        header('Location:'.SITEURL.'admin/manage-admin.php');

                    }else { 
                        // Display Error Message 
                        // Redirect To Manage ADmin PAge  With Error Message 
                        $_SESSION['change-pwd'] = "<div class='error'>Faild To Change Password. </div>" ;
                        header('Location:'.SITEURL.'admin/manage-admin.php');

                    }

                }else { 
                    // Redirect To Manage ADmin PAge  With Error Message 
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password Update Not Match. </div>" ;
                    header('Location:'.SITEURL.'admin/manage-admin.php');
    
                }



            }else { 
                // User DOes not Exist Set Message And Redirect 
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>" ;
                header('Location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        

        //3. Check Whether The New Password And Confirm Password  Match Or Not 

        //4. Change Password If All Above Is True 


    }


?>



<?php include('partials/footer.php');   ?> 
