<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Medicine</h2>

        <br>

        <?php
            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Medicine title">
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
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
                                        $id = $row['id'];
                                        $title = $row['title']; 

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

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
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspam="2">
                        <input type="submit" name="submit" value="Add Medicine" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
        
            // Check whether the button is clicked or not
            if(isset($_POST['submit'])) {
                // Add medicine into database
                // echo "Clicked";

                // 1. Get the data from form
                $title = $_POST['title'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                
                // Check whether radio buttons for featured and active are checked or not
                if(isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                } else {
                    $featured = "No"; // Setting the default value
                }

                if(isset($_POST['active'])) {
                    $active = $_POST['active'];
                } else {
                    $active = "No"; // Setting the default value
                }

                // 2. Upload the image if selected
                // Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name'])) {
                    // Get details of the selected image
                    $image_name = $_FILES['image']['name'];

                    // Check whether the image is selected or not and upload image only if selected
                    if($image_name != "") {
                        // Image is selected
                        // a) Rename the image
                        // Get the extension of the imaage (jpg, png, gif, and etc.)
                        $ext = end(explode('.', $image_name));

                        // Rename the image
                        $image_name = "Medicine_name_".rand(00000, 99999).'.'.$ext; // eg:- Medicine_name_10000.jpg

                        // b) Upload the image
                        // Get the source path and destination path

                        // Source path is the current location of the image
                        $source_path = $_FILES['image']['tmp_name'];

                        // Destination path for the image to be uploaded
                        $destination_path = "../images/medicine/".$image_name;

                        // Finally upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check whether the image is uploaded or not
                        // If the image is not uploaded then we will stop the process and redirect with an error message
                        if($upload==FALSE) {
                            // Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload the image!</div>";
                            // Redirect to Add Medicine page 
                            header('location:'.SITEURL.'admin/add-medicine.php');
                            // Stop the process
                            die();
                        }
                    }
                } else {
                    $image_name = ""; // Setting default value as blank
                }

                // 3. Insert data into database
                // 2. Create SQL query to insert medicine into database
                $sql2 = "INSERT INTO tbl_medicine SET
                    title='$title',
                    price=$price,
                    image_name='$image_name',
                    category_id=$category,
                    featured='$featured',
                    active='$active'
                ";

                // Execute the query and save in database
                $res2 = mysqli_query($conn, $sql2);

                // Check whether the query is executed or not and data is added or not
                // 4. Redirect with a message to Manage Medicine page
                if($res2==TRUE) {
                    // Query executed and medicine added
                    $_SESSION['add'] = "<div class='success'>Medicine added successfully.</div>";
                    // Redirect to Manage Medicine page
                    // header('location:'.SITEURL.'admin/manage-medicine.php');

                    echo("<script>location.href = '".SITEURL."/admin/manage-medicine.php?msg=$msg';</script>");

                } else {
                    // Failed to add medicine
                    $_SESSION['add'] = "<div class='error'>Failed add medicine!</div>";
                    // Redirect to Add Medicine page
                    header('location:'.SITEURL.'admin/add-medicine.php');
                }

            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
