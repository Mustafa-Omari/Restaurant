<?php include('partials/menu.php') ; ?>
    <!-- Main Content Section Start  -->
        <div class="main-content">
            <div class="wrapper">
                <h1>DASHBOARD</h1>
                <br><br>

                <?php 
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>
                <div class="col-4 text-center">

                <?php
                
                    $sql = "SELECT * FROM tbl_category";

                    $res = mysqli_query($conn , $sql);

                    $count = mysqli_num_rows($res);

                    $row = mysqli_fetch_assoc($res);
                    $id = $row['id'];
                ?>

                    <h1><?php echo $count; ?></h1>
                    <br>
                    Categories 
                </div>
                
                <div class="col-4 text-center">

                    <?php
                    
                    $sql2 = "SELECT * FROM tbl_food";

                    $res2 = mysqli_query($conn , $sql2);

                    $count2 = mysqli_num_rows($res2);

                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br>
                    Foods
                </div>
                
                <div class="col-4 text-center">

                    <?php 

                    $sql3 = "SELECT * FROM tbl_order";

                    $res3 = mysqli_query($conn , $sql3);

                    $count3 = mysqli_num_rows($res3);

                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br>
                    Orders
                </div>
                
                <div class="col-4 text-center">

                    <?php 

                    // Create SQL Query To Get Total Revenue Generated

                    //Aggregate Function in sql 
                    $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                    //Execute The Query 
                    $res4 = mysqli_query($conn , $sql4);

                    // Get The Value 
                    $row4 = mysqli_fetch_assoc($res4);
                    
                    // Get The Total Revenue 
                    $total_revenue = $row4['Total'];


                    ?>

                    <h1>$<?php echo $total_revenue; ?></h1>
                    <br>
                    Revenue Generated
                </div>
                
                <div class="clearfix"></div>
            </div>
        </div>
    <!-- Main Content Section End  -->        
    

<?php include('partials/footer.php') ;  ?>