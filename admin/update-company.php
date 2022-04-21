<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Company</h2>

        <br>

        <?php 
            // 1. Get the id of selected admin
            $id=$_GET['id'];

            // 2. Create sql query to get details
            $sql="SELECT * FROM tbl_company WHERE id=$id";

            // Execute the query
            $res=mysqli_query($conn, $sql);

            // Check whether the query is executed or not
            if($res==TRUE) {
                // Check whether the data is available or not
                $count = mysqli_num_rows($res);
                // Check whether we have admin data or not
                if($count==1) {
                    // Get the details
                    // echo "Admin available";
                    $row=mysqli_fetch_assoc($res);

                    $company_name = $row['company_name'];
                    $company_contact = $row['company_contact'];
                    $company_email = $row['company_email'];
                    $company_address = $row['company_address'];
                } else {
                    // Redirect to Manage Company page
                    header('location:'.SITEURL.'admin/manage-company.php');
                }
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Company Name: </td>
                    <td>
                        <input type="text" name="company_name" value="<?php
                        echo $company_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Company Contact: </td>
                    <td>
                        <input type="text" name="company_contact" value="<?php echo $company_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Company Email: </td>
                    <td>
                        <input type="email" name="company_email" value="<?php echo $company_email; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Company Address: </td>
                    <td>
                    <textarea name="company_address" rows="5" cols="30"><?php echo $company_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspam="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Company" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php
    // Check whether the "Update Company" button is clicked or not
    if(isset($_POST['submit'])) {
        // echo "Button clicked";
        // Get all the values from form to update
        $id = $_POST['id'];
        $company_name = $_POST['company_name'];
        $company_contact = $_POST['company_contact'];
        $company_email = $_POST['company_email'];
        $company_address = $_POST['company_address'];

        // Creat sql query to update company
        $sql = "UPDATE tbl_company SET
        company_name = '$company_name',
        company_contact = '$company_contact',
        company_email = '$company_email',
        company_address = '$company_address',
        WHERE id='$id'
        ";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Check whether the query is executed successfully or not
        if($res==TRUE) {
            // Query executed and company updated
            $_SESSION['update'] = "<div class='success'>Company updated successfully!</div>";
            // Redirect to Manage Company page
            header('location:'.SITEURL.'admin/manage-company.php');
        } else {
            // Failed to update company
            $_SESSION['update'] = "<div class='error'>Failed to update company!</div>";
            // Redirect to Manage Company page
            header('location:'.SITEURL.'admin/manage-company.php');
        }
    }

?>

<?php include('partials/footer.php'); ?>
