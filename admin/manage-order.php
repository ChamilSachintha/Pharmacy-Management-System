<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h2>Manage Order</h2>

                <br>

                <?php
                    if(isset($_SESSION['update'])) {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>

                <br><br>

                <table class="tbl-full font">
                    <tr>
                        <th>ID</th>
                        <th>Medicine</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        // Get all orders from database
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // Display the latest order at 1st
                        // Execute the query
                        $res = mysqli_query($conn, $sql);
                        // Count rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; // Create a variable and assign the value

                        if($count>0) {
                            // Order available
                            while($row = mysqli_fetch_assoc($res)) {
                                // Get all the order details
                                $id = $row['id'];
                                $medicine_id = $row['medicine_id'];
                                $price = $row['price'];
                                $quantity = $row['quantity'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];

                                ?> 

                                <tr>
                                    <td><?php echo $sn++; ?></td>
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
                                    <td><?php echo $order_date; ?></td>
                                    <td>
                                        <?php
                                            if($status=="Ordered") {
                                                echo "<label>$status</label>";
                                            } elseif($status=="On Delivery") {
                                                echo "<label style='color: orange'>$status</label>";
                                            } elseif($status=="Delivered") {
                                                echo "<label style='color: #44bd32'>$status</label>";
                                            } elseif($status=="Cancelled") {
                                                echo "<label style='color: red'>$status</label>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $customer_address; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                    </td>
                                </tr>                                

                                <?php
                            }
                        } else {
                            // Order not available
                            echo "<tr><td colspam='12' class='error'>Orders not available</td></tr>";
                        }
                    ?>

                </table>

        </div>
    </div>

<?php include('partials/footer.php'); ?>
