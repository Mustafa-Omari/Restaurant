<?php include('partials-front/menu.php'); ?>

<?php 

    // Check Whether ID is passed or not 
    if(isset($_GET['category_id'])){

        // Category ID is set and get the id 
        $category_id = $_GET['category_id'];

        // Get The Category Title Based On category ID 
        $sql = "SELECT * FROM tbl_category WHERE id='$category_id'";

        //Execute The Query 
        $res = mysqli_query($conn ,$sql);

        // Get The Value FRom database 
        $row = mysqli_fetch_assoc($res);

        // Get the Title 
        $category_title = $row['title'];

    }else { 

        // Category Not passed 
        // Redirect To Home Page
        header('Location:'.SITEURL); 
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                // Create SQL Query To Get Foods Based On Selected Category 
                $sql2 = "SELECT * FROM tbl_food WHERE category_id='$category_id'";

                // Execute The Query 
                $res2 = mysqli_query($conn , $sql2);

                // Count The Rows
                $count2 = mysqli_num_rows($res2);

                // Check Whether Food Is Available Or NOt 
                if($count2 > 0){ 

                    // Food Is Available 
                    while($row2=mysqli_fetch_assoc($res2)){

                        // Get The Value 
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];

                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">

                                <?php 
                                    if(empty($image_name)){

                                        // Image not available
                                        echo "<div class='error'>Image not available.</div>"; 
                                    }else { 

                                        // Image Available 
                                        ?>

                                        <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">

                                        <?php
                                    }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>.
                                </p>
                                <br>

                                <a href="<?php echo SITEURL ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>


                        <?php 

                    }
                }else { 
                    // Food Not Available 
                    echo "<div class='error'>Food Not Available.</div>";

                }


            ?>

         

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->



<?php include('partials-front/footer.php'); ?>