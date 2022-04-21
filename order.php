<?php include('partials-front/menu.php'); ?>

<?php
    // Check whether id is passed or not
    if(isset($_GET['medicine_id'])) {
        // Medicine id is set and get the id
        $medicine_id = $_GET['medicine_id'];
        // Get the medicine title based on medicine id
        $sql = "SELECT * FROM tbl_medicine WHERE id=$medicine_id";
        // Execute the query
        $res = mysqli_query($conn, $sql);
        // Count the rows
        $count = mysqli_num_rows($res);

        // Check whether the data is available or not
        if($count == 1) {
            // Data available
            // Get data from database
            $row = mysqli_fetch_assoc($res);
            $medicine_name = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        } else {
            // Medicine not available
            // Redirect to home page
            header('location:'.SITEURL);
        }
    } else {
        // Redirect to home page
        header('location:'.SITEURL);
    }
?>

    <!-- medicine sEARCH Section Starts Here -->
    <section class="medicine-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Medicine</legend>

                    <div class="medicine-menu-img">

                        <?php
                            // Check whether image is available or not 
                            if($image_name == "") {
                                // Image is not available
                                echo "<div class='error'>Image not available!</div>";
                            } else {
                                // Image is available
                                ?>

                                    <img src="<?php echo SITEURL; ?>images/medicine/<?php echo $image_name; ?>" class="img-responsive img-curve">

                                <?php
                            }
                        ?>
                        
                    </div>
    
                    <div class="medicine-menu-desc">
                        <h3><?php echo $medicine_name; ?></h3>
                        <input type="hidden" name="medicine_name" value="<?php echo $title; ?>">
                        <p class="medicine-price">Rs.<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="quantity" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Chamil Sachintha" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 07xxxxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. chamil@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. No.x, Street, City" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            
                // Check whether the "Confirm Order" button is clicked or not
                if(isset($_POST['submit'])) {
                    // Get all details from form
                    $medicine_name = $_POST['medicine_name'];
                    $price = $_POST['price'];
                    $quantity = $_POST['quantity'];

                    $total = $price * $quantity; // total = price x quantity

                    $order_date = date("Y-m-d h:i:sa"); // Order date

                    $status = "Ordered"; // Ordered / On Dilivery / Dilivered / Cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    // Save the order in database
                    // Create SQL to save data
                    $sql2 = "INSERT INTO tbl_order SET
                        medicine_id = '$medicine_id',
                        price = $price,
                        quantity = $quantity,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    // Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    // Check whether the query is executed or not
                    if($res2 == TRUE) {
                        // Query is executed and order saved
                        $_SESSION['order'] = "<div class='success text-center'>Successfully ordered your medicines.</div>";
                        header('location:'.SITEURL);
                    } else {
                        // Failed to save order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to order!</div>";
                        header('location:'.SITEURL);
                    }
                }
 
            ?>
        </div>
    </section>
    <!-- medicine sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?> 