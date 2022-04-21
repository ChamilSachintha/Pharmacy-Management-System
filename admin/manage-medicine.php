<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h2>Manage Medicine</h2>

            <br>

            <?php
                if(isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete'])) {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['remove'])) {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if(isset($_SESSION['unauthorize'])) {
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                }

                if(isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if(isset($_SESSION['failed-remove'])) {
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                }

                if(isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>

            <br><br>

                <!-- Button to add medicine -->
                <a href="<?php echo SITEURL; ?>admin/add-medicine.php" class="btn-primary">Add Medicine</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>

                    <?php

                        // Query to get all medicine from database
                        $sql = "SELECT * FROM tbl_medicine";

                        // Execute query
                        $res = mysqli_query($conn, $sql);

                        // Count rows
                        $count = mysqli_num_rows($res);

                        // Create ID variable and assign value as 1
                        $sn=1;

                        // Check whether we have data in the database or not
                        if($count>0) {
                            // We have data in database
                            // Get the data and display
                            while($row=mysqli_fetch_assoc($res)) {
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $price; ?></td>

                                        <td>

                                            <?php
                                                // Check whether the image name is available or not
                                                if($image_name != "") {
                                                    // Display the image
                                                    ?>

                                                    <img src="<?php echo SITEURL; ?>images/medicine/<?php echo $image_name; ?>" width="100px">

                                                    <?php

                                                } else {
                                                    // Display a message
                                                    echo "<div class='error'>Image not added!</div>";
                                                }
                                            ?>

                                        </td>

                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-medicine.php?id=<?php echo $id; ?>" class="btn-secondary">Update Medicine</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-medicine.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Medicine</a>
                                        </td>
                                    </tr>

                                <?php
                            }

                        } else {
                            // We don't have data in database
                            // Display a message inside table
                            ?>

                            <tr>
                                <td colspam="7"><div class="error">No medicine added!</div></td>
                            </tr>

                            <?php
                        }
                    ?>

                </table>
                
        </div>
    </div>

<?php include('partials/footer.php'); ?>
