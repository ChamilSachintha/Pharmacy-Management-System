<?php include('partials-front/menu.php'); ?>

    <!-- medicine sEARCH Section Starts Here -->
    <section class="medicine-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>medicine-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Medicine.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- medicine sEARCH Section Ends Here -->


    <!-- medicine MEnu Section Starts Here -->
    <section class="medicine-menu">
        <div class="container">
            <h2 class="text-center">Medicine Menu</h2>

            <?php
                // Create SQL query to display medicines from the database
                $sql = "SELECT * FROM tbl_medicine WHERE active='Yes'";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Count rows to check whether medicines are available or not
                $count = mysqli_num_rows($res);

                if($count>0) {
                    // Medicines are available
                    while($row=mysqli_fetch_assoc($res)) {
                        // Get values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];

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

    </section>
    <!-- medicine Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>