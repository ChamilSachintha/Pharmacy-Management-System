<?php
    // Include constants file
    include('../config/constants.php');

    // echo "Delete page";
    
    // Check whether the id and image_name values are set or not
    if(isset($_GET['id']) AND isset($_GET['image_name'])) {
        // Get the value and delete
        // echo "Get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file if it is available
        if($image_name != "") {
            // Image is available.
            $path = "../images/category/".$image_name;
            // Remove the image
            $remove = unlink($path);

            // If failed to remove the image then add an error message and stop the process
            if($remove==FALSE) {
                // Set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove the category image!</div>";
                // Redirect to manage-category page
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the process
                die();
            }
        }

        // Delete data from database 
        // SQL query to delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Check whether the data is deleted from the database or not
        if($res==TRUE) {
            // Set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category is deleted successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        } else {
            // Set error message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete the category!</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    } else {
        // Redirect to manage-category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>