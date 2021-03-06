<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Order</h1>

            <br><br>

            <?php 

                // Check Whether ID Is isset OR Not 
                if(isset($_GET['id'])){

                    // Get The Order Details 
                    $id = $_GET['id'];

                    // Get All Other Details based on this id 
                    // SQL QUERY to Get the order details
                    $sql = "SELECT * FROM tbl_order WHERE id='$id'";

                    // Execute query 
                    $res = mysqli_query($conn , $sql);

                    //Count Rows
                    $count = mysqli_num_rows($res);
                    
                    // Check COunt 
                    if($count == 1){

                        // Details Available 
                        $row = mysqli_fetch_assoc($res);

                        // 
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];


                    }else { 

                        // Details Not Available 
                        // Redirect to manage order page 
                        header('Location:'.SITEURL.'admin/manage-order.php');
                    }
                    

                }else { 

                    // Redirect To  Manage Order Page 
                    header('Location:'.SITEURL.'admin/manage-order.php');
                }
                

            ?>


            <form action="" method="POST">
            
                <table class="tbl-30">
                
                    <tr>
                        <td>Food Name:</td>
                        <td><b><?php echo $food; ?></b></td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td><b>$<?php echo $price; ?></b></td>
                    </tr>

                    <tr>
                        <td>Qty:</td>
                        <td>
                            <input type="number" name="qty" value="<?php echo $qty; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Status:</td>
                        <td>
                            <select name="status">
                                <option <?php if($status == "Ordered") { echo "selected" ;} ?>  value="Orderd">Ordered</option>
                                <option <?php if($status == "On Dilevelry") { echo "selected" ;} ?> value="On Dilevelry">On Dilevelry</option>
                                <option <?php if($status == "Delivered") { echo "selected" ;} ?> value="Delivered">Delivered</option>
                                <option <?php if($status == "Cancelled") { echo "selected" ;} ?> value="Cancelled">Cancelled</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name:</td>
                        <td>
                            <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Contact:</td>
                        <td>
                            <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Email:</td>
                        <td>
                            <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Address:</td>
                        <td>
                            <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                            <input type="hidden" name="price" value="<?php echo $price; ?>">

                            <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>

            <?php 
            
                // Check Whether Update Button is clicked OR Not 
                if(isset($_POST['submit'])){
                    
                    // echo "Clicked";
                    //1. Get All The Values From Form 
                    $id = $_POST['id'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty;

                    $status = $_POST['status'];

                    $customer_name = $_POST['customer_name'];
                    $customer_contact = $_POST['customer_contact'];
                    $customer_email = $_POST['customer_email'];
                    $customer_address = $_POST['customer_address'];
                    

                    //2. Update The Values 
                    $sql2 = "UPDATE 
                                tbl_order
                            SET 
                                price = '$price',
                                qty = '$qty',
                                total = '$total',
                                status = '$status',
                                customer_name = '$customer_name',
                                customer_contact = '$customer_contact',
                                customer_email = '$customer_email',
                                customer_address = '$customer_address'
                            WHERE 
                                id='$id'
                    ";

                    $res2 = mysqli_query($conn , $sql2);

                    //3. Redirect To Manage Order With MEssage 

                    //Check Whether Update Or not 
                    if($res2 == TRUE){
                        
                        // Updated  
                        $_SESSION['update'] = "<div class='success'> Order Updated Successfuly.</div>";
                        header('Location:'.SITEURL.'admin/manage-order.php');
    
                    }else { 

                        // Failed To Update 
                        $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                        header('Location:'.SITEURL.'admin/manage-order.php');
    
                    }

                }
            ?>


        </div>
    </div>


<?php include('partials/footer.php'); ?>