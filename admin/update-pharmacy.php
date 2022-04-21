<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Pharmacy Branch</h2>

        <br>

        <?php
            ob_start();

            // Check whether the id is set or not
            if(isset($_GET['id'])) {
                // Get the id and all other details
                // echo "Getting the data";
                $id = $_GET['id'];
                // Create SQL query to get all other details
                $sql2 = "SELECT * FROM tbl_pharmacy WHERE id=$id";

                // Execute the query
                $res2 = mysqli_query($conn, $sql2);

                // Count the rows to check whether the id is valid or not
                $count2 = mysqli_num_rows($res2);

                if($count2==1) {
                    // Get all the data
                    $row2 = mysqli_fetch_assoc($res2);

                    $name = $row2['name'];
                    $contact = $row2['contact'];
                    $email = $row2['email'];
                    $address = $row2['address'];
                } else {
                    // Redirect to Manage Pharmacy Branches with a message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found!</div>";
                    header('location:'.SITEURL.'admin/manage-pharmacy.php');
                }
            } else {
                // Redirect to Manage Pharmacy Branches page
                header('location:'.SITEURL.'admin/manage-pharmacy.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Branch Name: </td>
                    <td>
                        <input type="text" name="name" value="<?php echo $name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Contact: </td>
                    <td>
                        <input type="tel" name="contact" value="<?php echo $contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email" name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Address: </td>
                    <td>
                        <textarea name="address" rows="5" cols="30"><?php echo $address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspam="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Branch" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
        
            if(isset($_POST['submit'])) {
                // echo "Clicked";
                // 1. Get all the values from the form
                $id = $_POST['id'];
                $name = $_POST['name'];
                $contact = $_POST['contact'];
                $email = $_POST['email'];
                $address = $_POST['address'];

                // 3. Update the database
                $sql3 = "UPDATE tbl_pharmacy SET
                    name = '$name',
                    contact = '$contact',
                    email = '$email',
                    address = '$address'
                    WHERE id = $id
                ";

                // Execute the query
                $res3 = mysqli_query($conn, $sql3);

                // 4. Redirect to Manage Pharmacy Branches page with a message
                // Check whether the query is executed or not
                if($res3==TRUE) {
                    // Branch updated
                    $_SESSION['update'] = "<div class='success'>Branch is updated successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-pharmacy.php');
                } else {
                    // Failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to update branch!</div>";
                    header('location:'.SITEURL.'admin/manage-pharmacy.php');
                }
            }
            ob_end_flush();
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
