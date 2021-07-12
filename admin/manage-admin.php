
<?php  include('partials/menu.php') ;  ?>

    <!-- Main Content Section Start  -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br>

                <?php
                    if(isset($_SESSION['add'])){  
                        echo $_SESSION['add']; // Displaying Session Message 
                        unset($_SESSION['add']);  // Removing Session Message 
                    }
                    if(isset($_SESSION['delete'])) { 
                        echo $_SESSION['delete'] ; 
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update'])) { 
                        echo $_SESSION['update']; 
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                ?> 
                <?php
                    if(isset($_SESSION['add'])){  
                        echo $_SESSION['add']; // Displaying Session Message 
                        unset($_SESSION['add']);  // Removing Session Message 
                    }
                    if(isset($_SESSION['delete'])) { 
                        echo $_SESSION['delete'] ; 
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update'])) { 
                        echo $_SESSION['update']; 
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['pwd-not-match'])){
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }
                    if(isset($_SESSION['change-pwd'])){
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
                ?> 
                <br><br><br>

                <!--  Button to ADd ADmin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>

                <br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        // Query To Get All ADmin 
                        $sql= "SELECT * FROM tbl_admin";
                        // Execute The Querry 
                        $res = mysqli_query($conn , $sql);

                        //Check Whether the Query is Executed OR Not 
                        if($res == TRUE) { 

                            // Count Rows To check Whether We Have Data In Database Or Nott
                            $count = mysqli_num_rows($res); // Function To Get All the Rows in Databas
                            
                            // Check the num of Rows
                            if($count>0) { 

                                $sn = 1 ; // create the variable and assign the value 

                                //We Have Data in Database 
                                while($rows=mysqli_fetch_assoc($res)){

                                    // Using While Loop To Get All The Data From Database 
                                    // And While Loop Will run as long as whe have data in database

                                    // Get Individual Data 
                                    $id=$rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username']; 
                                    

                                    // Display The Values In Our Table  
                                    ?>


                                    <tr>
                                        <td><?php echo $sn++ ; ?>.</td>
                                        <td><?php echo $full_name;  ?></td>
                                        <td><?php echo $username ; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id ?>" class="btn-primary"> Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id ?>" class="btn-secondary">Update Admin</a> 
                                            <a href="<?php echo SITEURL ;?>admin/delete-admin.php?id=<?php echo $id ;?>" class="btn-danger">Delete Admin</a> 
                                        </td>
                                    </tr>

                                    <?php 
                                }
                            }else { 
                                // We Not Have Data in Datase
                            }
                        }
                    ?> 

                </table>
            </div>
        </div>
    <!-- Main Content Section End  -->        
    

<?php include('partials/footer.php') ; ?>