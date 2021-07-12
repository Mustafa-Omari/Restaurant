<?php  
    // Include Constants.php file here 
    include('../config/constants.php');

    // 1. Get The ID Of Admin To be Deleted 
    $id = $_GET['id'];

    //2. Create SQL Query To Delete Admin 
    $sql ="DELETE FROM tbl_admin WHERE id=$id";

    // Execute The Query  
    $res = mysqli_query($conn , $sql);

    // Check Whether The Query Executed Successfuly or not 
    if($res == TRUE) { 
        // Query Executed Successfuly And ADmin Deleted 
        //echo "Admin Deleted";
        
        //Created Session Variable To Display Message 
        $_SESSION['delete'] = "<div class='success'> Admin Deleted Successfuly. </div>";
        // Redirect To Manage ADmin Page 
        header('Location:'.SITEURL.'admin/manage-admin.php');
    } else { 
        // Failed To Delete Admin 
        // echo " Faild To Delete Admin";

        $_SESSION['delete'] = "<div class='danger'>Faild To Delete Admin. Try Again Leter. </div>";
        header('Location'.SITEURL.'admin/manage-admin.php');

    }

    //3. Redirect To MAnage Admin Page With Message (Success Or Error)




?> 