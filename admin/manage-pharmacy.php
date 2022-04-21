<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts-->
        <div class="main-content">
            <div class="wrapper">
                <h2>Manage Pharmacy Branches</h2>

                <br />

                <?php 
                    if(isset($_SESSION['add'])) {
                        echo $_SESSION['add']; // Displaying session message
                        unset($_SESSION['add']); // Removing session message
                    }

                    if(isset($_SESSION['delete'])) {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update'])) {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    
                    if(isset($_SESSION['user-not-found'])) {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['password-not-match'])) {
                        echo $_SESSION['password-not-match'];
                        unset($_SESSION['password-not-match']);
                    }

                    if(isset($_SESSION['change-password'])) {
                        echo $_SESSION['change-password'];
                        unset($_SESSION['change-password']);
                    }

                ?>

                <br><br>

                <!-- Button to add pharmacy branches -->
                <a href="add-pharmacy.php" class="btn-primary">Add Branch</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>ID</th>
                        <th>Branch Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        // Query to get all pharmacy branches
                        $sql = "SELECT * FROM tbl_pharmacy";
                        // Execute the query
                        $res = mysqli_query($conn, $sql);

                        // Check whether the query is executed or not
                        if($res==TRUE) {
                            // Count rows to check whethere we have data in database or not
                            $count = mysqli_num_rows($res); // Function to get all the rows in database 

                            $sn=1; // Create a variable and assign the value

                            // Check the number of rows
                            if($count>0) {
                                // We have data in database
                                while($rows=mysqli_fetch_assoc($res)) {
                                    // Using while loop to get all the data from database 
                                    // While loop will run as long as we have data in database

                                    // Get individual data
                                    $id=$rows['id'];
                                    $name=$rows['name'];
                                    $contact=$rows['contact'];
                                    $email=$rows['email'];
                                    $address=$rows['address'];

                                    // Display the values in the table
                                    ?>

                                        <tr>
                                            <td><?php echo $sn++; ?> </td>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $contact; ?></td>
                                            <td><?php echo $email; ?></td>
                                            <td><?php echo $address; ?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-pharmacy.php?id=<?php echo $id; ?>" class="btn-secondary">Update Branch</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-pharmacy.php?id=<?php echo $id; ?>" class="btn-danger">Delete Branch</a>
                                            </td>
                                        </tr>

                                    <?php
                                }
                            } else {
                                // We don't have data in database
                            }
                        }
                    ?>

                </table>
                
            </div>
        </div>
        <!-- Main Content Section Ends-->

<?php include('partials/footer.php'); ?>

