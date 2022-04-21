<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts-->
        <div class="main-content">
            <div class="wrapper">
                <h2>Manage Company</h2>

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

                <!-- Button to add company -->
                <a href="add-company.php" class="btn-primary">Add Company</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr class>
                        <th>ID</th>
                        <th>Company Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        // Query to get all companies
                        $sql = "SELECT * FROM tbl_company";
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
                                    $company_name=$rows['company_name'];
                                    $company_contact=$rows['company_contact'];
                                    $company_email=$rows['company_email'];
                                    $company_address=$rows['company_address'];

                                    // Display the values in the table
                                    ?>

                                        <tr>
                                            <td><?php echo $sn++; ?> </td>
                                            <td><?php echo $company_name; ?></td>
                                            <td><?php echo $company_contact; ?></td>
                                            <td><?php echo $company_email; ?></td>
                                            <td><?php echo $company_address; ?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-company.php?id=<?php echo $id; ?>" class="btn-secondary">Update Company</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-company.php?id=<?php echo $id; ?>" class="btn-danger">Delete Company</a>
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

