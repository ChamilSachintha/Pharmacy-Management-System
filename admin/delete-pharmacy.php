<?php 

    // Include constants.php file 
    include('../config/constants.php');

    // 1. Get the id of branch to be deleted
    $id = $_GET['id'];

    // 2. Create sql query to delete branch
    $sql = "DELETE FROM tbl_pharmacy WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    //  Check whether the query executed successfully or not
    if($res==TRUE) {
        // Query executed successfully and branch deleted
        // echo "Branch deleted";
        //  Create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Branch deleted successfully!</div>";
        // Redirect to Manage Pharmacy Branches page
        header('location:'.SITEURL.'admin/manage-pharmacy.php');
    } else {
        // Failed to delete branch
        // echo "Failed delete branch";
        $_SESSION['delete'] = "<div class='error'>Failed to delete branch! Try again later.</div>";
        header('location:'.SITEURL.'admin/manage-pharmacy.php');
    }

?>