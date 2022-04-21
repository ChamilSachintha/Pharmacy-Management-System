<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts-->
        <div class="main-content">
            <div class="wrapper">
                <h2>Dashboard</h2>

                <br><br>

                <?php
                    if(isset($_SESSION['login'])) {
                        echo $_SESSION['login'];
                        unset ($_SESSION['login']);
                    }
                ?>

                <br><br>
                
                <a href="<?php echo SITEURL; ?>admin/manage-category.php">
                <div class="col-4 text-center">

                    <?php
                        // SQL query
                        $sql = "SELECT * FROM tbl_category";
                        // Execute the query
                        $res = mysqli_query($conn, $sql);
                        // Count rows
                        $count = mysqli_num_rows($res);
                    ?>
                    
                    <h2><?php echo $count; ?></h2>
                    <br />
                    Categories
                </div>
                </a>

                <a href="<?php echo SITEURL; ?>admin/manage-medicine.php">
                <div class="col-4 text-center">

                    <?php
                        // SQL query
                        $sql2 = "SELECT * FROM tbl_medicine";
                        // Execute the query
                        $res2 = mysqli_query($conn, $sql2);
                        // Count rows
                        $count2 = mysqli_num_rows($res2);
                    ?>

                    <h2><?php echo $count2; ?></h2>
                    <br />
                    Medicines
                </div>
                </a>

                <a href="<?php echo SITEURL; ?>admin/manage-order.php">
                <div class="col-4 text-center">

                    <?php
                        // SQL query
                        $sql3 = "SELECT * FROM tbl_order";
                        // Execute the query
                        $res3 = mysqli_query($conn, $sql3);
                        // Count rows
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h2><?php echo $count3; ?></h2>
                    <br />
                    Total Orders
                </div>
                </a>

                <div class="col-4 text-center">

                    <?php
                        // Create SQL query to get total revenue generated
                        // Aggregate function in SQL
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                        // Execute the query
                        $res4 = mysqli_query($conn, $sql4);

                        // Get the value
                        $row4 = mysqli_fetch_assoc($res4);

                        // Get the total revenue
                        $total_revenue = $row4['Total'];
                    ?>

                    <h2>Rs. <?php echo $total_revenue; ?></h2>
                    <br />
                    Revenue Generated
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Content Section Ends-->

<?php include('partials/footer.php'); ?>
        

