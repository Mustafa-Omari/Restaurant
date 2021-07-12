<?php include('partials/menu.php') ;?>


<div class="main-content">
    <div class="wrapper">
        <h1> Update Admin </h1>

        <br><br>

        <?php 
            //1. Get The ID Of Selected Admin 
            $id = $_GET['id'];

            //2. Create SQL Query To Get The Details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Execute The Query 
            $res=mysqli_query($conn , $sql);

            // Check Whether The Query is exeuted Or Not 
            if($res == TRUE ){ 
                // Check Whether the data is available or not 
                $count = mysqli_num_rows($res);
                //Check Whether We have admin data or not 
                if($count == 1) { 
                    // Get The Details 
                    // echo "Admin Available"; 
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username  = $row['username'];
                
                }else { 
                    // REdirect To Manage Admin Page 
                    header('Location:'.SITEURL.'admin/manage-admin.php');
                }
            }

        ?>




        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name ; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username ;  ?>">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;  ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>

</div>

<?php 
    // Check The Submit Button is clicked or not 
    if(isset($_POST['submit'])) {
        // Check If The Button is clicked 
        // echo "Button Clicked"; 
        
        // Get All The Values From Form To Update 
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
    
        // Create SQL QUery To Update Admin 
        $sql = "UPDATE tbl_admin 
        SET 
            full_name = '$full_name' , 
            username = '$username' 
        WHERE id='$id'
        ";

        // Execute The Query 
        $res = mysqli_query($conn , $sql) ; 

        // Check Whether The Query Executedd Successfuly  or not 
        if($res==TRUE ){ 
            // Query Executed And ADmin Updated 
            $_SESSION['update'] = '<div class="success"> Admin Updated Successfuly. </div>';
            // Redirect To Manage Admin PAge 
            header('Location:'.SITEURL.'admin/manage-admin.php');
        }else { 
            // Failed To Update ADmin
            $_SESSION['update'] = '<div class="error"> Faild To Update Admin. Try Again Later. </div>';
            // Redirect To Manage Admin PAge 
            header('Location:'.SITEURL.'admin/manage-admin.php');
        }
    
    }

?>


<?php include('partials/footer.php'); ?>
