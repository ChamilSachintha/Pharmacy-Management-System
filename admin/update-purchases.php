<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Purchases</h2>

        <br>
    
        <?php
            ob_start();

            // Check whether the id is set or not
            if(isset($_GET['id'])) {
                // Get the purchases details
                $id=$_GET['id'];

                // Get all other details based on this id
                // SQL query to get the order details
                $sql = "SELECT * FROM tbl_purchases WHERE id=$id";
                // Execute the query
                $res = mysqli_query($conn, $sql);
                // Count rows
                $count = mysqli_num_rows($res);

                if($count == 1) {
                    // Details available
                    $row = mysqli_fetch_assoc($res);

                    $current_pharmacy = $row['pharmacy_id'];
                    $company_id = $row['company_id'];
                    $medicine_id = $row['medicine_id'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $total = $row['total'];
                    $status = $row['status'];
                } else {
                    // Details not available
                    // Redirect to Manage Purchases page
                    header('location:'.SITEURL.'admin/manage-purchases.php');
                }
            } else {
                // Redirect to Manage Purchases page
                header('location:'.SITEURL.'admin/manage-purchases.php');
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">

            <tr>
                    <td>Pharmacy Branch: </td>
                    <td>
                        <b>
                            <?php
                                // Create PHP code to display categories from the database
                                // 1. Create SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_pharmacy";

                                // Execute the query
                                $res = mysqli_query($conn, $sql);

                                // Count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                if($count>0) {
                                    // We have categories
                                    while($row=mysqli_fetch_assoc($res)) {
                                        // Get details of categories
                                        $pharmacy_id = $row['id'];
                                        $pharmacy_name = $row['name']; 

                                        if ($current_pharmacy==$pharmacy_id) {
                                            echo $pharmacy_name;
                                        }

                                        ?>

                                        <?php
                                    }
                                } else {
                                    // We don't have categories
                                    ?>

                                    <option value="0">No categories found!</option>

                                    <?php
                                }
                            ?>
                        </b>
                    </td>
                </tr>

                <tr>
                    <td>Company Name: </td>
                    <td>
                        <b>
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

                        </b>
                    </td>
                </tr>

                <tr>
                    <td>Medicine Name: </td>
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
                            <option <?php if($status=="Purchased"){echo "Selected";} ?> value="Purchased">Purchased</option>
                            <option <?php if($status=="Cancelled"){echo "Selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspam="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Purchases" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
            // Check whether the "Update Purchases" button is clicked or not
            if(isset($_POST['submit'])) {
            // echo "Button clicked";
            // Get all the values from form to update
            $id = $_POST['id'];
            $pharmacy = $_POST['pharmacy'];
            $company_id = $_POST['company_id'];
            $medicine_id = $_POST['medicine_id'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];

            $total = $price * $quantity;

            $status = $_POST['status'];

            // Creat sql query to update order
            $sql4 = "UPDATE tbl_purchases SET
                status = '$status'
                WHERE id='$id'
            ";

            // Execute the query
            $res4 = mysqli_query($conn, $sql4);

            // Check whether the query is executed successfully or not
            if($res4==TRUE) {
                // Query executed and order updated
                $_SESSION['update'] = "<div class='success'>Purchases updated successfully!</div>";
                // Redirect to Manage Order page
                header('location:'.SITEURL.'admin/manage-purchases.php');
            } else {
                // Failed to update purchases
                $_SESSION['update'] = "<div class='error'>Failed to update purchases!</div>";
                // Redirect to Manage Purchases page
                header('location:'.SITEURL.'admin/manage-purchases.php');
                }
            }

        ?>
    </div>
</div>



<?php include('partials/footer.php'); ?>
