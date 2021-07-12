<?php include('partials/menu.php') ?>

<?php 

    // Check Whether ID is set or not 
    if(isset($_GET['id'])){

        // Get All The Details 
        $id = $_GET['id'];
        
        // SQL Query To Get The Selected Food 
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        // Execute Query 
        $res2 = mysqli_query($conn , $sql2);

        // Get The Values Based On Query Executed 
        $row = mysqli_fetch_assoc($res2);

        // Get The Individual Values Of Selected Food 
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $current_image = $row['image_name'];
        $current_category = $row['category_id'];
        $featured = $row['featured'];
        $active = $row['active'];

    }else { 

        // Redirect To Manage Food 
        header('Location:'.SITEURL.'admin/manage-food.php');
    }

?>



<div class="main-content">
    <div class="wrapper">
        
        <h1>Update Food</h1>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class='tbl-30'>
            
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>
            
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" > <?php echo $description ; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 

                            if(empty($current_image)){

                                // Image Not Availabe
                                echo "<div class='error'>Image not Available. </div>" ;
                            }else { 

                                // Image Available 
                                ?>

                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">

                                <?php

                            }

                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" >

                            <?php 
                                // Query To Get Active Categories
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                
                                // Execute The Query 
                                $res = mysqli_query($conn , $sql) ;

                                // Count The Rows 
                                $count = mysqli_num_rows($res) ; 

                                // Check Whether Category Available Or Not 
                                if ($count > 0 ){ 
                                    // Category Available 

                                    while($row = mysqli_fetch_assoc($res)){
                                        $category_id = $row['id'];
                                        $category_title = $row ['title'];
                                        ?>

                                        <option <?php if($current_category == $category_id ){ echo 'selected'; } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        
                                        <?php 
                                    }

                                }else { 
                                    //Category Not Available 
                                    echo "<option value='0'>Category Not Available. </option>";
                                }
                            
                            ?>

                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured == "Yes"){ echo 'checked'; } ?>  type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured == "No"){ echo 'checked'; } ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active == "Yes") { echo 'checked';} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active == 'No'){ echo 'checked'; }  ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>

                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        
                        <input type="submit" name="submit" value="Update Food" class='btn-secondary'>
                    </td>
                </tr>

            </table>

        </form>

        <?php 
            if(isset($_POST['submit'])){
                
                // echo 'clicked';

                //1. Get All The Details From The Form 
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price']; 
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Upload The Image If Selected 

                // Check Whether Upload Button Is Clicked Or Noot 
                if(isset($_FILES['image']['name'])){

                    // Upload Button Clicked 
                    $image_name = $_FILES['image']['name'] ; // New Image Name 

                    // Check Whether The File Is Availabe Or Not 

                    if(!empty($image_name)){

                        // Image Is Available 
                        //A. Uploading New Image 

                        // Rename The Image
                        $ext = end(explode('.', $image_name));

                        
                        $image_name = "Food-Name-".rand(0000 , 9999) . '.' . $ext; // This Will Be Renamed Image 

                        // Get The Source Path And Destination Path 

                        $src_path = $_FILES['image']['tmp_name']; // Source Path 

                        $dest_path = "../images/food/".$image_name; // Destination Path 
                        
                        // Upload The Image 
                        $upload = move_uploaded_file($src_path , $dest_path);

                        // Check Whether The Image Is Uploaded Or Not
                        if($upload == FALSE){ 

                            // Failed To Upload 
                            $_SESSION['upload'] = "<div class='error'>Failed To Upload New Image. </div>";
                            header('Location:'.SITEURL.'admin/manage-food.php');

                            // Stop The Process 
                            die();
                        }

                        //3. Remove The Image If New Image Is Uploaded adn Current Image Exists
                        //B. Remove Current Image If Available 
                        if(!empty($current_image)){ 
                        
                            // Current Image Is Available
                            // Remove The Image 
                            $remove_path = "../images/food/".$current_image;
                        
                            $remove = unlink($remove_path);

                            // Check Whether The Image Is REmoved Or Not 
                            if($remove == FALSE){ 

                                // Faile To Remove Current Image 
                                $_SESSION['remove-image'] = "<div class='error'>Failed To Remove Current Image.</div>";
                                
                                // Redirect To MAnage Food
                                header('Location:'.SITEURL.'admin/manage-food.php');
                                
                                // Stop The Process
                                die(); 
                            }
                            
                        }

                    }else { 
                        $image_name = $current_image; 
                    }

                }else { 

                    $image_name = $current_image;
                }


                //4. Update The Food In Database 
                
                // Create SQL Query 





                
                $sql3 = "UPDATE 
                            tbl_food
                        SET 
                            title='$title',
                            description = '$description',
                            price=$price,
                            image_name='$image_name',
                            category_id='$category',
                            featured='$featured',
                            active='$active'
                        WHERE
                            id='$id'
                        ";
                
                // Execute The SQL Query 
                $res3 = mysqli_query($conn , $sql3);

                // check Whether The Query Is Executed Or NOt 
                if($res3 == TRUE){

                    // Query Executed And Food Updated
                    $_SESSION['update'] = "<div class='success'>Food Update Successfuly.</div>";
                    header('Location:'.SITEURL.'admin/manage-food.php');
                    
                    // $header = 'Location:'.SITEURL.'admin/manage-food.php';
                    // if (headers_sent()) {
                    //     die("Redirect failed. Please click on this link: <a href=...>");
                    // }
                    // else{
                    //     exit(header("Location: .SITEURL.'admin/manage-food.php"));
                    // }

                }else { 

                    // Failed To Update Food
                    $_SESSION['update'] = "<div class='error'>Failed To Update Food.</div>";
                    header('Location:'.SITEURL.'admin/manage-food.php');
                }

                // Redirect To MAnage Food With Session Message 
            }

        ?>



    </div>
</div>

<?php include('partials/footer.php') ?>