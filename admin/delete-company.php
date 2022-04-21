<?php 

    // Include constants.php file 
    include('../config/constants.php');

    // 1. Get the id of company to be deleted
    $id = $_GET['id'];

    // 2. Create sql query to delete company
    $sql = "DELETE FROM tbl_company WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    //  Check whether the query executed successfully or not
    if($res==TRUE) {
        // Query executed successfully and company deleted
        // echo "Company deleted";
        //  Create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Company deleted successfully!</div>";
        // Redirect to Manage Company page
        header('location:'.SITEURL.'admin/manage-company.php');
    } else {
        // Failed to delete company
        // echo "Failed delete company";
        $_SESSION['delete'] = "<div class='error'>Failed to delete company! Try again later.</div>";
        header('location:'.SITEURL.'admin/manage-company.php');
    }

?>