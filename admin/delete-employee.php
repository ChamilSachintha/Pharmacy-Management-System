<?php 

    // Include constants.php file 
    include('../config/constants.php');

    // 1. Get the id of employee to be deleted
    $id = $_GET['id'];

    // 2. Create sql query to delete employee
    $sql = "DELETE FROM tbl_employee WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    //  Check whether the query executed successfully or not
    if($res==TRUE) {
        // Query executed successfully and employee deleted
        // echo "Employee deleted";
        //  Create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Employee deleted successfully!</div>";
        // Redirect to Manage Employee page
        header('location:'.SITEURL.'admin/manage-employee.php');
    } else {
        // Failed to delete employee
        // echo "Failed delete employee";
        $_SESSION['delete'] = "<div class='error'>Failed to delete employee! Try again later.</div>";
        header('location:'.SITEURL.'admin/manage-employee.php');
    }

?>