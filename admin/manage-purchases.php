<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h2>Manage Purchases</h2>

                <br>

                <?php
                    if(isset($_SESSION['update'])) {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['add'])) {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                ?>

                <br><br>

                <!-- Button to add purchases -->
                <a href="<?php echo SITEURL; ?>admin/add-purchases.php" class="btn-primary">Add Purchases</a>

                <br /><br /><br />

                <table class="tbl-full font">
                    <tr>
                        <th>ID</th>
                        <th>Pharmacy Branch</th>
                        <th>Company Name</th>
                        <th>Medicine Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Ordered Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        // Get all orders from database
                        $sql = "SELECT * FROM tbl_purchases ORDER BY id DESC"; // Display the latest purchases at 1st
                        // Execute the query
                        $res = mysqli_query($conn, $sql);
                        // Count rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; // Create a variable and assign the value

                        if($count>0) {
                            // Order available
                            while($row = mysqli_fetch_assoc($res)) {
                                // Get all the purchases details
                                $id = $row['id'];
                                $pharmacy_id=$row['pharmacy_id'];
                                $company_id = $row['company_id'];
                                $medicine_id = $row['medicine_id'];
                                $price = $row['price'];
                                $quantity = $row['quantity'];
                                $total = $row['total'];
                                $ordered_date = $row['ordered_date'];
                                $status = $row['status'];

                                ?> 

                                <tr>
                                    <td><?php echo $sn++; ?></td>
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
                                        <?php
                                        // Create PHP code to display companies from the database
                                        // 1. Create SQL to get all companies from database
                                        $sql2 = "SELECT * FROM tbl_company";

                                        // Execute the query
                                        $res2 = mysqli_query($conn, $sql2);

                                        // Count rows to check whether we have companies or not
                                        $count2 = mysqli_num_rows($res2);

                                        if($count2>0) {
                                            // We have companies
                                            while($row2=mysqli_fetch_assoc($res2)) {
                                                // Get details of companies
                                                $current_company_id = $row2['id'];
                                                $company_name = $row2['company_name']; 

                                                if ($current_company_id==$company_id) {
                                                     echo $company_name;
                                                }
                                                ?>

                                                <?php
                                            }
                                        } else {
                                            // We don't have companies
                                                ?>

                                                <option value="0">No companies found!</option>

                                                <?php
                                            }

                                        ?>

                                    </td>

                                    <td>
                                        <?php
                                        // Create PHP code to display medicines from the database
                                        // 1. Create SQL to get all medicines from database
                                        $sql3 = "SELECT * FROM tbl_medicine";

                                        // Execute the query
                                        $res3 = mysqli_query($conn, $sql3);

                                        // Count rows to check whether we have medicines or not
                                        $count3 = mysqli_num_rows($res3);

                                        if($count3>0) {
                                            // We have medicine
                                            while($row3=mysqli_fetch_assoc($res3)) {
                                                // Get details of medicine
                                                $medicine_i = $row3['id'];
                                                $medicine_name = $row3['title']; 

                                                if ($medicine_i==$medicine_id) {
                                                     echo $medicine_name;
                                                }
                                                ?>

                                                <?php
                                            }
                                        } else {
                                            // We don't have medicines
                                                ?>

                                                <option value="0">No medicine found!</option>

                                                <?php
                                            }

                                        ?>

                                    </td>

                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $ordered_date; ?></td>
                                    <td>
                                        <?php
                                            if($status=="Ordered") {
                                                echo "<label>$status</label>";
                                            } elseif($status=="Purchased") {
                                                echo "<label style='color: #44bd32'>$status</label>";
                                            } elseif($status=="Cancelled") {
                                                echo "<label style='color: red'>$status</label>";
                                            }
                                        ?>
                                    </td>
                                    
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-purchases.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                    </td>
                                </tr>                                

                                <?php
                            }
                        } else {
                            // Order not available
                            echo "<tr><td colspam='12' class='error'>Purchases not available</td></tr>";
                        }
                    ?>

                </table>

        </div>
    </div>

<?php include('partials/footer.php'); ?>
