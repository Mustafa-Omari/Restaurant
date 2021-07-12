<?php 
    // Include COnstants File 
    include('../config/constants.php');

    // echo "Delete Page";

    // Check Whether the id and image_name Value is Set or not
    if(isset($_GET['id']) AND isset($_GET['image_name'])){

        // Get The Value And Delete
        // echo "Get Value And Delete ";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        
        // Remove The Phisical Image File If Available
        if(!empty($image_name)) { 
            // Image Is Available. So Remove It 
            $path = "../images/category/".$image_name;
            
            // Remove The Image 
            $remove = unlink($path);

            // If Faild To Remove Image Then Add And Error Message And Stop The Process
            if($remove == FALSE) { 

                // SetThe session Message 
                $_SESSION['remove'] = "<div class='error'>Failed To Remove Category Image. </div>" ;
                
                //Redirect To Manage Category Page 
                header('Location:'.SITEURL.'admin/manage-category.php');

                // Stop The Process
                die();
            }
        }

        // Delete Data From Database 
        // SQL QUERY DELETE Data FRom Data base 
        $sql = "DELETE FROM tbl_category WHERE id='$id'";

        // Execute Query 
        $res = mysqli_query($conn , $sql);

        // Check Whether The Data Is Deleted From Database Or Not 
        if($res==TRUE){ 

            // SEt Success MEssage And Redirect To Maanage Categeory Page  
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfuly.</div>";
            header('Location:'.SITEURL.'admin/manage-category.php');

        }else { 

            // Set Error Message And Redirect 
            $_SESSION['delete'] = "<div class='error'>Failed To Delete Category. </div>" ; 
            header('Location:'.SITEURL.'admin/manage-category.php');
        }
        

    } else { 
        // Redirect To Manage Category Page 
        header('Location:'.SITEURL.'admin/manage-category.php');

    }

?>