    <?php include('partials-front/menu.php') ; ?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>/food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->

    <?php 
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 

                // Create SQL Query To Display Categories From Database 
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

                // Execute Query 
                $res = mysqli_query($conn , $sql);

                // Count Rows Th Check Whether The Category is available or not  
                $count = mysqli_num_rows($res); 

                if($count > 0){ 

                    // Categories Available 
                    while($row = mysqli_fetch_assoc($res)){

                        // Get The Values Like id ,  Title , Image_name
                        $id = $row['id']; 
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        
                        ?>
                            <a href="<?php  echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                                <div class="box-3 float-container">
                                    <?php 
                                        // Check Whether Image Is Avilable Or Not 
                                        if(empty($image_name)){

                                            //Display Message 
                                            echo "<div class='error'>Image not Available</div>";
                                        }else { 

                                            // Image Available 
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                            <?php 
                                        }
                                    ?>
                
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    
                    }

                }else{ 
                    // Categories Not Availabe 
                    echo "<div class='error'>Category not Added.</div>";

                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
                // Geting Food From Database When Is Featured And Active 

                // SQL Query 
                $sql2 = "SELECT * FROM tbl_food WHERE featured='Yes' AND active='Yes' LIMIT 6";

                // Execute The Query 
                $res2 = mysqli_query($conn , $sql2);

                // Count The Rows
                $count2 = mysqli_num_rows($res2);

                // Check Whether Food Available OR NOt 
                if($count2 > 0 ){

                    // Food Available 

                    while($row = mysqli_fetch_assoc($res2)){

                        // Get All The Values 
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                
                                <?php 

                                if(empty($image_name)){

                                    // No Image 
                                    echo "<div class='error'>No Image.</div>";
                                }else { 
                                    // Display The Image 
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php 
                                }

                                ?>

                            
                            
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
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

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->


<?php include('partials-front/footer.php') ; ?>