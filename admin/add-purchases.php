<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Purchases</h2>

        <br>

        <?php 
            ob_start();
            
            if(isset($_SESSION['add'])) {   // Checking whether the session is set or not
                echo $_SESSION['add'];      // Display the session message if set
                unset($_SESSION['add']);    // Remove session message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">

            <tr>
                    <td>Pharmacy Branch: </td>
                    <td>
                        <select name="pharmacy_name">

                            <?php
                                // Create PHP code to display pharmacy branches from the database
                                // 1. Create SQL to get all pharmacy branches from database
                                $sql2 = "SELECT * FROM tbl_pharmacy";

                                // Execute the query
                                $res2 = mysqli_query($conn, $sql2);

                                // Count rows to check whether we have categories or not
                                $count2 = mysqli_num_rows($res2);

                                if($count2>0) {
                                    // We have categories
                                    while($row2=mysqli_fetch_assoc($res2)) {
                                        // Get details of categories
                                        $id = $row2['id'];
                                        $name = $row2['name']; 

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $name; ?></option>

                                        <?php
                                    }
                                } else {
                                    // We don't have categories
                                    ?>

                                    <option value="0">No pharmacy branches found!</option>

                                    <?php
                                }

                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Company Name: </td>
                    <td>
                        <select name="company_name">

                            <?php
                                // Create PHP code to display companies from the database
                                // 1. Create SQL to get all companies from database
                                $sql = "SELECT * FROM tbl_company";

                                // Execute the query
                                $res = mysqli_query($conn, $sql);

                                // Count rows to check whether we have companies or not
                                $count = mysqli_num_rows($res);

                                if($count>0) {
                                    // We have companies
                                    while($row=mysqli_fetch_assoc($res)) {
                                        // Get details of companies
                                        $id = $row['id'];
                                        $company_name = $row['company_name']; 

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $company_name; ?></option>

                                        <?php
                                    }
                                } else {
                                    // We don't have companies
                                    ?>

                                    <option value="0">No companies found!</option>

                                    <?php
                                }

                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Medicine Name: </td>
                    <td>
                        <select name="medicine_name">

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
                                        $medicine_id = $row3['id'];
                                        $medicine_name = $row3['title']; 

                                            
                                        ?>
                                        <option value="<?php echo $medicine_id; ?>"><?php echo $medicine_name; ?></option>                                       
                                        <?php
                                    }
                                } else {
                                    // We don't have companies
                                    ?>
                                    <option value="0">No medicine found!</option>
                                    <?php
                                }

                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Quantity: </td>
                    <td>
                        <input type="number" name="quantity" class="input-responsive" value="1" required>
                    </td>
                </tr>


                <tr>
                    <td colspam="2">
                        <input type="submit" name="submit" value="Save Purchases" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    // Process the value from form and save it in database

    // Check whether the submit button is clicked or not

    if(isset($_POST['submit'])) 
    {
        // Button clicked
        // echo "Button clicked";

        // 1. Get data from form
        $pharmacy_name = $_POST['pharmacy_name'];
        $company_name = $_POST['company_name'];
        $medicine_name = $_POST['medicine_name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        
        $total = $price * $quantity; // total = price x quantity

        $ordered_date = date("Y-m-d h:i:sa"); // Order date

        $status = "Ordered"; // Ordered / Purchased / Cancelled

        // 2. SQL query to save data into database
        $sql2 = "INSERT INTO tbl_purchases SET
            pharmacy_id='$pharmacy_name',
            company_id='$company_name',
            medicine_id=$medicine_name,
            price=$price,
            quantity=$quantity,
            total=$total,
            ordered_date='$ordered_date',
            status='$status'
        ";   

        // 3. Executing query and saving data into database
        $res2 = mysqli_query($conn, $sql2) or die(mysqli_error());

        // 4. Check whether the data is inserted (query is executed) or not and display appropriate message
        if($res==TRUE) {
            // Data inserted
            // echo "Data inserted";
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Purchases added successfully!</div>";
            // Redirect to Manage Purchases page
            header("location:".SITEURL.'admin/manage-purchases.php');
        } else {
            // Failed to insert data
            // echo "Failed to insert data";
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to add purchases!</div>";
            // Redirect to Add Purchases page
            header("location:".SITEURL.'admin/add-purchases.php');
        }
    } 
?>