<?php include('partials-front/menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Medicines</h2>

            <?php
                // Create SQL query to display categories from the database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

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
    </section>
    <!-- Categories Section Ends Here -->

<?php include('partials-front/footer.php'); ?>