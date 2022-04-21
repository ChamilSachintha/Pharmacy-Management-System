<?php include('partials-front/menu.php'); ?>

<?php
    // Check whether id is passed or not
    if(isset($_GET['category_id'])) {
        // Category id is set and get the id
        $category_id = $_GET['category_id'];
        // Get the category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Get the value from database
        $row=mysqli_fetch_assoc($res);

        // Get the title
        $category_title = $row['title'];
    } else {
        // Category not passed
        // Redirect to home page
        header('location:'.SITEURL);
    }
?>

    <!-- medicine sEARCH Section Starts Here -->
    <section class="medicine-search text-center">
        <div class="container">
            
            <h2>Medicines on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- medicine sEARCH Section Ends Here -->



    <!-- medicine MEnu Section Starts Here -->
    <section class="medicine-menu">
        <div class="container">
            <h2 class="text-center">Medicine Menu</h2>

            <?php
            
                // Create a SQL query to get medicines based on the selected category
                $sql2 = "SELECT * FROM tbl_medicine WHERE category_id=$category_id";

                // Execute the query
                $res2 = mysqli_query($conn, $sql2);

                // Count rows to check whether medicines are available or not
                $count2 = mysqli_num_rows($res2);

                if($count2>0) {
                    // Medicines are available
                    while($row2=mysqli_fetch_assoc($res2)) {
                        // Get values
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $image_name = $row2['image_name'];

                        ?>

                        <div class="medicine-menu-box">
                            <div class="medicine-menu-img">
                                <?php
                                    // Check whether image is available or not 
                                    if($image_name == "") {
                                        // Image not available
                                        echo "<div class='error'>Image not available!</div>";
                                    } else {
                                        // Image available
                                        ?>

                                        <img src="<?php echo SITEURL; ?>images/medicine/<?php echo $image_name; ?>" class="img-responsive img-curve">

                                        <?php
                                    }
                                ?>

                            </div>

                            <div class="medicine-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="medicine-price">Rs.<?php echo $price; ?></p>
                                
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?medicine_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        

                        <?php
                    }
                } else {
                    // Medicines are not available
                    echo "<div class='error'>Medicines are not available!</div>";
                }

            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- medicine Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>