<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Category</h2>

        <br>

        <?php
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br>

        <!-- Add category form starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Add category form ends -->

        <?php
            // Check whether the submit button is clicked or not
            if(isset($_POST['submit'])) {
                // echo "Clicked";

                // 1. Get the value from category form
                $title = $_POST['title'];

                // For radio input type, need to check whether a button is selected or not
                if(isset($_POST['featured'])) {
                    // Get the value from form
                    $featured = $_POST['featured'];
                } else {
                    // Set the default value
                    $featured = "No";
                }

                if(isset($_POST['active'])) {
                    $active = $_POST['active'];
                } else {
                    $active = "No";
                }

                // Check whether the image is selected or not and set the value for image name accordingly 
                // print_r($_FILES['image']);

                // die(); // Break the code here

                if(isset($_FILES['image']['name'])) {
                    // Upload the image
                    // To upload the image, we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    // Upload the image only if image is selected
                    if($image_name != "") {
                        
                        // Auto rename the image
                        // Get the extension of the imaage (jpg, png, gif, and etc.)
                        $ext = end(explode('.', $image_name));

                        // Rename the image
                        $image_name = "Medicine_category_".rand(000, 999).'.'.$ext; // eg:- Medicine_category_100.jpg

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        // Finally upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check whether the image is uploaded or not
                        // If the image is not uploaded then we will stop the process and redirect with an error message
                        if($upload==FALSE) {
                            // Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload the image!</div>";
                            // Redirect to add-category page 
                            header('location:'.SITEURL.'admin/add-category.php');
                            // Stop the process
                            die();
                        }
                    }
                } else {
                    // Don't upload the image and set the image_name value as blank
                    $image_name="";
                }

                // 2. Create SQL query to insert category into database
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                // 3. Execute the query and save in database
                $res = mysqli_query($conn, $sql);

                // 4. Check whether the query is executed or not and data is added or not
                if($res==TRUE) {
                    // Query executed and category added
                    $_SESSION['add'] = "<div class='success'>Category added successfully.</div>";
                    // Redirect to Manage Category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                } else {
                    // Failed to add category
                    $_SESSION['add'] = "<div class='error'>Failed add category!</div>";
                    // Redirect to Add Category page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
