<?php 
    // Include Constants Page 
    include('../config/constants.php');

    // echo "Delete Food Page";

    if(isset($_GET['id']) && isset($_GET['image_name'])){

        // Process To Delete 
        // echo "Process To Delete";

        //1. Get ID And Image Name 
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];


        //2. Remove The Image If Available  
        // Check Whether The Image Is Available OR not And Dleet Only If Available 
        if(!empty($image_name) ){

            //It Has Image And need To Remove From Folder
            // Get The The Image Path 
            $path = "../images/food/".$image_name;

            // Remove Image File From Folder 
            $remove = unlink($path);
            
            // Check Whether The Image Is Removed Or Not 
            if($remove == FALSE ){ 
                // Failed To Remove Image 
                $_SESSION['remove-image'] = "<div class='error'>Failed To Remove Image File.</div>";
                
                // Redirect To MAnage Food 
                header('Location:'.SITEURL.'admin/manage-food.php');
                
                // Stop The Process Of Deleting Food 
                die();

            }
        }

        //3. Delete Food From Database 
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        // Execute Query 
        $res = mysqli_query($conn , $sql);

        // Check Whether The Query Executed Or Not And Set Session Message Respectively
        //4. Redirect To MAange Food With Success Message 

        if($res == TRUE ){ 
            // Food Deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfuly. </div>";
            header('Location:'.SITEURL.'admin/manage-food.php');
    
        }else { 
            // Failed To Delete
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food. </div>";
            header('Location:'.SITEURL.'admin/manage-food.php');

        }




    } else { 

        // Redirect to Manage Food Page 
        // echo "REdirect"; 
        $_SESSION['unauthorize'] = "<div class='error'>Unauthrized Access. </div>";
        header('Location:'.SITEURL.'admin/manage-food.php');
    }


?>