<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Medicine</h2>

        <br>

        <?php
            ob_start();

            // Check whether the id is set or not
            if(isset($_GET['id'])) {
                // Get the id and all other details
                // echo "Getting the data";
                $id = $_GET['id'];
                // Create SQL query to get all other details
                $sql2 = "SELECT * FROM tbl_medicine WHERE id=$id";

                // Execute the query
                $res2 = mysqli_query($conn, $sql2);

                // Count the rows to check whether the id is valid or not
                $count2 = mysqli_num_rows($res2);

                if($count2==1) {
                    // Get all the data
                    $row2 = mysqli_fetch_assoc($res2);
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $current_image = $row2['image_name'];
                    $current_category = $row2['category_id'];
                    $featured = $row2['featured'];
                    $active = $row2['active'];
                } else {
                    // Redirect to manage-category with a message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found!</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            } else {
                // Redirect to Manage Medicine page
                header('location:'.SITEURL.'admin/manage-medicine.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != "") {
                                // Display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/medicine/<?php echo $current_image; ?>" width="150px">
                                <?php
                            } else {
                                // Display a message
                                echo "<div class='error'>Image not added</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                // Create PHP code to display categories from the database
                                // 1. Create SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                // Execute the query
                                $res = mysqli_query($conn, $sql);

                                // Count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                if($count>0) {
                                    // We have categories
                                    while($row=mysqli_fetch_assoc($res)) {
                                        // Get details of categories
                                        $category_id = $row['id'];
                                        $category_title = $row['title']; 

                                        ?>
                                        <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                        <?php
                                    }
                                } else {
                                    // We don't have categories
                                    ?>

                                    <option value="0">No categories found!</option>

                                    <?php
                                }
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes   
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspam="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Medicine" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
        
            if(isset($_POST['submit'])) {
                // echo "Clicked";
                // 1. Get all the values from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category']; 
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // 2. Updating new image if selected
                // Check whether the image is selected or not
                if(isset($_FILES['image']['name'])) {
                    // Get the image details
                    $image_name = $_FILES['image']['name'];

                    // Check whether the image is available or not
                    if($image_name != "") {
                        // Image available

                        // a) Upload the new image

                        // Auto rename the image
                        // Get the extension of the imaage (jpg, png, gif, and etc.)
                        $ext = end(explode('.', $image_name));

                        // Rename the image
                        $image_name = "Medicine_name_".rand(00000, 99999).'.'.$ext; // eg:- Medicine_name_10000.jpg

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/medicine/".$image_name;

                        // Finally upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check whether the image is uploaded or not
                        // If the image is not uploaded then we will stop the process and redirect with an error message
                        if($upload==FALSE) {
                            // Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload new image!</div>";
                            // Redirect to Manage Medicine page 
                            header('location:'.SITEURL.'admin/manage-medicine.php');
                            // Stop the process
                            die();
                        }
                        // b) Remove the current image if available
                        if($current_image != "") {
                            $remove_path = "../images/medicine/".$current_image;
                            $remove = unlink($remove_path);

                            // Check whether the image is removed or not
                            // If failed to remove then display a message and stop the process
                            if($remove==FALSE) {
                                // Failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the current image!</div>";
                                header('location:'.SITEURL.'admin/manage-medicine.php');
                                die(); // Stop the process
                            }
                        }
                        
                    } else {
                        $image_name = $current_image;
                    }
                } else {
                    $image_name = $current_image;
                }

                // 3. Update the database
                $sql3 = "UPDATE tbl_medicine SET
                    title = '$title',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                ";

                // Execute the query
                $res3 = mysqli_query($conn, $sql3);

                // 4. Redirect to Manage Medicine page with a message
                // Check whether the query is executed or not
                if($res3==TRUE) {
                    // Medicine updated
                    $_SESSION['update'] = "<div class='success'>Medicine is updated successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-medicine.php');
                } else {
                    // Failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to update medicine!</div>";
                    header('location:'.SITEURL.'admin/manage-medicine.php');
                }
            }
            ob_end_flush();
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
