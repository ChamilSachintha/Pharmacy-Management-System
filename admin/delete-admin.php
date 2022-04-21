<?php 

    // Include constants.php file 
    include('../config/constants.php');

    // 1. Get the id of admin to be deleted
    $id = $_GET['id'];

    // 2. Create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    //  Check whether the query executed successfully or not
    if($res==TRUE) {
        // Query executed successfully and admin deleted
        // echo "Admin deleted";
        //  Create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin deleted successfully!</div>";
        // Redirect to Manage Admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    } else {
        // Failed to delete admin
        // echo "Failed delete admin";
        $_SESSION['delete'] = "<div class='error'>Failed to delete admin! Try again later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

?>