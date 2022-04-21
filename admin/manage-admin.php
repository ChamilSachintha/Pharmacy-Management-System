<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts-->
        <div class="main-content">
            <div class="wrapper">
                <h2>Manage Admin</h2>

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

                <!-- Button to add admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Pharmacy Branch</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        // Query to get all admin
                        $sql = "SELECT * FROM tbl_admin";
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
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];
                                    $pharmacy_id=$rows['pharmacy_id'];

                                    // Display the values in the table
                                    ?>

                                        <tr>
                                            <td><?php echo $sn++; ?> </td>
                                            <td><?php echo $full_name; ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td>
                                                <?php
                                                // Create PHP code to display pharmacy branches from the database
                                                // 1. Create SQL to get all pharmacy branches from database
                                                $sql2 = "SELECT * FROM tbl_pharmacy";

                                                // Execute the query
                                                $res2 = mysqli_query($conn, $sql2);

                                                // Count rows to check whether we have companies or not
                                                $count2 = mysqli_num_rows($res2);

                                                if($count2>0) {
                                                    // We have branches
                                                    while($row2=mysqli_fetch_assoc($res2)) {
                                                        // Get details of branches
                                                        $pharmacy_id1 = $row2['id'];
                                                        $pharmacy_name = $row2['name']; 

                                                        if ($pharmacy_id1==$pharmacy_id) {
                                                            echo $pharmacy_name;
                                                        }
                                                        ?>

                                                        <?php
                                                    }
                                                } else {
                                                    // We don't have companies
                                                        ?>

                                                        <option value="0">No pharmacy branches found!</option>

                                                        <?php
                                                    }

                                                ?>

                                            </td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
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

