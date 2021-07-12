<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">

            <h1>Update Category</h1>

            <br><br>


            <?php
            
                // Check Whether ID Is Set Or NOt 
                if(isset($_GET['id'])){

                    // Get The ID And All Other Details
                    // echo "Getting The Data ";
                    $id = $_GET['id'];
                    
                    // Create SQL Query To Get All Other details 
                    $sql="SELECT * FROM tbl_category WHERE id='$id'";

                    // Execute The Query 
                    $res = mysqli_query($conn , $sql) ; 

                    // Count The Rows To Check Whether The ID is valid or not 
                    $count = mysqli_num_rows($res);

                    if($count == 1 ){ 

                        // Get All The Data     
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        

                    }else { 
                        //Redirect To Manage Category PAge With Session Message 
                        $_SESSION['no-category-found'] = "<div class='error'>Category Not Found. </div>";
                        header('Location:'.SITEURL.'admin/manage-category.php');
                    }



                }else { 
                    // Redirect To Manage Category With Error Message 
                    $_SESSION['access-without-id'] = "<div class='error'>Cant access Without ID. </div>";
                    header('Location:'.SITEURL.'admin/manage-category.php');
                    
                }

            ?>




            <form action="" method="POST" enctype="multipart/form-data">
                <table class='tbl-30'>

                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php 
                                if(!empty($current_image)){
                                    //Display The Image
                                    ?>
                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="150px">
                                    <?php 
                                }else { 
                                    //Display The Message 
                                    echo "<div class='error'>Image Not Added.</div>" ;
                                }
                            ?> 
                        </td>
                    </tr>

                    <tr>
                        <td>New Image:</td>
                        <td>
                            <input type="file" name="image" value="">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured == 'Yes') { echo 'checked'; } ?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if($featured == 'No') { echo 'checked'; }  ?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active == 'Yes'){ echo 'checked'; } ?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active == 'No'){ echo 'checked'; }  ?> type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Category" class='btn-secondary'>
                        </td>
                    </tr>

                </table>
            </form>

            <?php 

                if(isset($_POST['submit'])){
                    // echo 'clicked';
                    
                    //1. Get All The Values From Our Form 
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //2. Updation New Image if Selected 
                    // Check Whether The Image Is Selected Or Not 
                    if(isset($_FILES['image']['name'])){

                        //Get The Image Details 
                        $image_name = $_FILES['image']['name'] ;

                        // Check Whether The Image Is Available Or Not 
                        if(!empty($image_name)){

                            // Image Available 
                            //A. Upload The New Image 
                            
                            // Auto Rename Our Image 
                            // Get The Extension Of Our Image (jpg,png,etc,gif) e.g. "specialfood1.jpg"
                            $ext = end(explode('.', $image_name));

                            // Rename The Image 
                            $image_name = "Food_Category_".rand(000 , 999).'.'.$ext; // e.g. Food_Category_542.jpg
                        

                            $source_path = $_FILES['image']['tmp_name'];
                            
                            $destination_path = "../images/category/".$image_name;

                            // Finaly Upload The Image 
                            $upload = move_uploaded_file($source_path , $destination_path);

                            // Check Whether The Image Is Uploaded Or Not  
                            // And If The Image Is Not Uploaded Then We Will Stop The Process And Redirect With Error Message 
                            if($upload==FALSE){ 
                                
                                //Set Message 
                                $_SESSION['upload'] = "<div class='error'>Failed To Upload Image. </div>";
                                
                                // Redirect To Add Category Page 
                                header('Location:'.SITEURL.'admin/manage-category.php');
                                
                                // Stop The Process
                                die(); 
                                
                            }


                            //B. Remove The Current Image  if Available
                            if(!empty($current_image)){
                            
                                $remove_path = "../images/category/".$current_image; 
                                $remove = unlink($remove_path);

                                // Check Whether The Image Is Removed OR Not  
                                // If Failed To Remove Then Display Message And Stop The Process

                                if($remove == FALSE) { 
                                    // Failed To Remove The Image 
                                    $_SESSION['failed-remove'] = "<div class='error'>Failed To Remove Cureent Image </div>";
                                    header('Location:'.SITEURL.'admin/manage-category.php');
                                    die();// Stop The Process 
                                }
                                
                            }
                            
                        }else { 
                            $image_name = $current_image; 
                        }

                    }else { 
                        $image_name = $current_image;
                    }



                    //3. Update The Database 
                    $sql2 = "UPDATE 
                                tbl_category
                            SET
                                title = '$title' ,
                                image_name = '$image_name',  
                                featured = '$featured',
                                active = '$active' 
                            WHERE 
                                id='$id'
                                ";

                    // Execute The Query 
                    $res2 = mysqli_query($conn , $sql2);

                    //4. Redirect To Manage Category With Message 
                    //Check Whether executed Or Not 
                    if($res2 == TRUE){ 
                        //Category Updated 
                        $_SESSION['update'] = "<div class='success'>Category Updated Successfuly. </div>" ; 
                        header('Location:'.SITEURL.'admin/manage-category.php');
                    }else {
                        // Failed To Update Category 
                        $_SESSION['update'] = "<div class='error'>Failed To Updated Category. </div>" ; 
                        header('Location:'.SITEURL.'admin/manage-category.php');

                    }

                }
            ?>
        </div>
    </div>


<?php include('partials/footer.php') ;?>