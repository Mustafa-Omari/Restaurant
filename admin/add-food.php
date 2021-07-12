<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">

        <h1>Add Food </h1>

        <br><br>

        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><b></b>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class='tbl-30'>
                
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of The Food.">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description"  cols="30" rows="5" placeholder="Description of The Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" >
                            <?php 
                                // Create PHP Code To Display Categories From Database 
                                //1. Create SQL To Get All Active Categories From  Database 
                                    $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                                    // Execute Query 
                                    $res = mysqli_query($conn , $sql);
                                    
                                    // Count The Rows To Check whether we have Categories or not 
                                    $count = mysqli_num_rows($res);

                                    // If COunt Is Greater than zero , wh have categories else we dont have categories
                                    if($count > 0){ 

                                        // We Have Categories
                                        while($row = mysqli_fetch_assoc($res)){

                                            // Get The Details Of Categories
                                            $id = $row['id'];
                                            $title = $row['title'];

                                            ?> 

                                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                            <?php 
                                        }
                                    }else { 

                                        // We Dont Have Category
                                        ?>
                                            <option value="0">No Categroy Found</option>
                                        <?php
                                    }


                                //2. Display On Dropdown
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        

        <?php 
            // Check Whether The Button is clicked or not 
            if(isset($_POST['submit'])){
                // echo 'Clicked';
                // Add The Food In Database

                //1. GEt The Data From Form 
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];
                    
                    // check Whether Radion button for Featured and active are checked or not 
                    if(isset($_POST['featured'])){
                        $featured = $_POST['featured'];
                    }else { 
                        $featured = "No"; // Setting The default Value
                    }

                    if(isset($_POST['active'])){
                        $active = $_POST['active'];
                    }else { 
                        $active = "No";
                    }
                    

                //2. Upload The Image If Selected

                // Check Whether The Select Image Is Clicked Or Not And Upload The image only if the image is selected
                if(isset($_FILES['image']['name'])){

                    // Get The details Of the Selected Image
                    $image_name = $_FILES['image']['name'];
                    
                    // Check Whether The Iamge Is selected Or Not And Upload Image Only If Selected
                    if(!empty($image_name)){
                        
                        // Image Is Selected
                        //A. Rename The Image 
                        // Get The Extensin Of Selected Image (jpg, png, gif, etc.) "mustafa-omari.jpg" => mustafa-omari jpg
                        $ext = end(explode('.', $image_name ));

                        // Create New Name For Image 
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; // New Image Name May Be "Food-Name-3245.jpg"

                        //B. Upload The Image 
                        
                        // Get The Source Path And Sestination Path

                        // Source Path Is The Cureent Location Of The Image 
                        $src = $_FILES['image']['tmp_name'];

                        // Destination Path For The Image To Be Uploaded
                        $dst = "../images/food/".$image_name;

                        // Finaly Upload The Food Image 
                        $upload = move_uploaded_file($src , $dst);

                        // Check Whether Image Uploaded Of NOt 

                        if($upload == FALSE) { 

                            // Failed To Upload The Image 
                            // Redirect To Add Food Page WIth Error Moessage 
                            $_SESSION['upload'] = "<div class='error'>Failed To Upload Image. </div>";
                            
                            header('Location:'.SITEURL.'admin/add-food.php');

                            // Stop The Proccess
                            die();
                        }
                        

                    }    
                

                }else { 

                    $image_name = ""; // Setting Default Value as blank
                }

                //3. Insert Into Database
                
                // Create SQL Query To Save or Add Food 
                // For Numerical Wer Dont Need To Pass Value Inside quotes '' But For String Value It Is Compulsory To Add quotes ''
                $sql2 = "INSERT INTO 
                            tbl_food 
                        SET
                            title='$title',
                            description ='$description', 
                            price = $price,
                            image_name = '$image_name',
                            category_id = $category,
                            featured = '$featured',
                            active ='$active'
                        "; 
                
                // Execute The Query 
                $res2 = mysqli_query($conn , $sql2);

                // Cehck Whether Data Inserted Or Not 
                //4. Redirect With MEssage To Maanage Food Page 

                if($res2==TRUE){ 

                    // Data Inserted Successfuly
                    $_SESSION['add'] = "<div class='success'>Food Added Successfuly. </div>"; 
                    header('Location:'.SITEURL.'admin/manage-food.php');
                }else { 
                    // Failed To Inserted Data 
                    $_SESSION['add'] = "<div class='error'>Failed To Add Food. </div>"; 
                    header('Location:'.SITEURL.'admin/manage-food.php');

                }

            }

        ?>

    </div>
</div>


<?php include('partials/footer.php') ?>