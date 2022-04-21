<?php include('partials-front/menu.php'); ?>

    <!-- medicine sEARCH Section Starts Here -->
    <section class="medicine-search text-center">
        <div class="container">

        <?php

            // Get the search keyword
            // $search = $_POST['search'];
            $search = mysqli_real_escape_string($conn, $_POST['search']);

        ?>
            
            <h2>Medicines on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- medicine sEARCH Section Ends Here -->



    <!-- medicine MEnu Section Starts Here -->
    <section class="medicine-menu">
        <div class="container">
            <h2 class="text-center">Medicine Menu</h2>

            <?php

                // SQL query to get medicines based on search keyword
                // $search = citrate '; DROP database name; 
                // "SELECT * FROM tbl_medicine WHERE title LIKE '%citrate'%' OR description LIKE '%citrate %'";
                $sql = "SELECT * FROM tbl_medicine WHERE title LIKE '%$search%'";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Count rows
                $count = mysqli_num_rows($res);

                // Check whether medicines are available or not
                if($count>0) {
                    // Medicine are available
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
                                        echo "<div class='error'>Image not available</div>";
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
                    echo "<div class='error'>Medicines not found!</div>";
                }

            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- medicine Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>