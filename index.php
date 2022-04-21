<?php include('partials-front/menu.php'); ?>

    <!-- Medicine Search Section Starts Here -->
    <section class="medicine-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>medicine-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Medicine.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Medicine Search Section Ends Here -->

    <?php
        if(isset($_SESSION['order'])) {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Medicines</h2>

            <?php
                // Create SQL query to display categories from the database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 6";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Count rows to check whether categories are available or not
                $count = mysqli_num_rows($res);

                if($count>0) {
                    // Categories are available
                    while($row=mysqli_fetch_assoc($res)) {
                        // Get values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        ?>

                        <a href="<?php echo SITEURL; ?>category-medicine.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    // Check whether image is available or not 
                                    if($image_name == "") {
                                        // Image not available
                                        echo "<div class='error'>Image not available</div>";
                                    } else {
                                        // Image available
                                        ?>

                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">

                                        <?php
                                    }
                                ?>

                                <h3 class="float-text text-white txt-shadow"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                } else {
                    // Categories are not available
                    echo "<div class='error'>Categories were not added!</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>categories.php">See All Categories</a>
        </p>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- medicine MEnu Section Starts Here -->
    <section class="medicine-menu">
        <div class="container">
            <h2 class="text-center">Medicine Menu</h2>

            <?php
                // Create SQL query to display medicines from the database
                $sql2 = "SELECT * FROM tbl_medicine WHERE active='Yes' AND featured='Yes' LIMIT 6";

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
                                <p class="medicine-price"><?php echo $price; ?></p>
                                
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

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>medicine.php">See All Medicines</a>
        </p>
    </section>
    <!-- medicine Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
    