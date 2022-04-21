<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Order</h2>

        <br>
    
        <?php
            ob_start();

            // Check whether the id is set or not
            if(isset($_GET['id'])) {
                // Get the order details
                $id=$_GET['id'];

                // Get all other details based on this id
                // SQL query to get the order details
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                // Execute the query
                $res = mysqli_query($conn, $sql);
                // Count rows
                $count = mysqli_num_rows($res);

                if($count == 1) {
                    // Details available
                    $row = mysqli_fetch_assoc($res);

                    $medicine_id = $row['medicine_id'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $total = $row['total'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                } else {
                    // Details not available
                    // Redirect to Manage Admin page
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            } else {
                // Redirect to Manage Order page
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Medicine: </td>
                    <td>
                        <b>
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
                                    // We don't have companies
                                    ?>

                                    <option value="0">No medicine found!</option>

                                    <?php
                                }

                                ?>

                        </b>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><b>Rs. <?php echo $price; ?></b></td>
                </tr>

                <tr>
                    <td>Quantity: </td>
                    <td><b><?php echo $quantity; ?></b></td>
                </tr>

                <tr>
                    <td>Total: </td>
                    <td><b>Rs. <?php echo $total; ?></b></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "Selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "Selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "Selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "Selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td><b><?php echo $customer_name; ?></b></td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td><b><?php echo $customer_contact; ?></b></td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td><b><?php echo $customer_email; ?></b></td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td><b><?php echo $customer_address; ?></b></td>
                </tr>

                <tr>
                    <td colspam="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
            // Check whether the "Update Order" button is clicked or not
            if(isset($_POST['submit'])) {
            // echo "Button clicked";
            // Get all the values from form to update
            $id = $_POST['id'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];

            $total = $price * $quantity;

            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];

            // Creat sql query to update order
            $sql2 = "UPDATE tbl_order SET
                status = '$status'
                WHERE id='$id'
            ";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);

            // Check whether the query is executed successfully or not
            if($res2==TRUE) {
                // Query executed and order updated
                $_SESSION['update'] = "<div class='success'>Order updated successfully!</div>";
                // Redirect to Manage Order page
                header('location:'.SITEURL.'admin/manage-order.php');
            } else {
                // Failed to update order
                $_SESSION['update'] = "<div class='error'>Failed to update order!</div>";
                // Redirect to Manage Order page
                header('location:'.SITEURL.'admin/manage-order.php');
                }
            }

        ?>
    </div>
</div>



<?php include('partials/footer.php'); ?>
