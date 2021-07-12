<?php include('partials-front/menu.php') ?>


<?php 

    // Check Whether Food Id is set or not 
    if(isset($_GET['food_id'])){

        // Get The Food ID And Details of the selected food 
        $food_id = $_GET['food_id'];
        
        // Get The Details Of THe Selected Food 
        $sql = "SELECT * FROM tbl_food WHERE id='$food_id'";

        // Execute The Query 
        $res = mysqli_query($conn , $sql);

        // Count The ROws 
        $count = mysqli_num_rows($res);

        // Check Whether 
        if($count == 1 ){ 

            // We Have Data 
            // Geth The Data From Database 
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];

 
        }else { 

            // Food Not Available 
            // Redirect To Home Page 
            header('Location:'.SITEURL);    
        
        }
    
        
    }else { 

        // Redirect To Home Page 
        header('Location:'.SITEURL);
    }

?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                            // Check Whether The Image Is Avilable Or NOt 
                            if(empty($image_name)){

                                // Image not Available
                                echo "<div class='error'>No Image.</div>"; 
                            }else { 
                                // Image Avilable
                                ?> 
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                <?php 
                            }

                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>


            <?php 

                // Check Whether The Button Is Clicked OR NOt 
                if(isset($_POST['submit'])){

                    // get ll the details from the form 
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    
                    $total = $price * $qty; // Total = price x Quantity

                    $order_date = date("Y-m-d h:i:sa"); // Order Date 

                    $status = "Orderd"; // Orderd , On Delivery , Delivered , Cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $custer_address = $_POST['address'];


                    // Save The Order In Database 
                    // Create SQL to sve the data 
                    $sql2 = "INSERT INTO 
                                tbl_order
                            SET 
                                food='$food',
                                price='$price',
                                qty = '$qty' , 
                                total = '$total' , 
                                order_date = '$order_date',
                                status = '$status',
                                customer_name = '$customer_name',
                                customer_contact = '$customer_contact',
                                customer_email = '$customer_email',
                                customer_address = '$custer_address'
                    ";


                    // Execute The Query 
                    $res2 = mysqli_query($conn , $sql2);

                    // Check Whether Query Executed Successfuly Or not 
                    if($res2 == TRUE){ 

                        // Query Executed nd Order Saved
                        $_SESSION['order'] = "<div class='success text-center'>Food Orderd Successfuly.</div>";
                        header('Location:'.SITEURL);
                    }else { 

                        // Failed TO Save ORder 
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                        header('Location:'.SITEURL);

                    }


                }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?> 