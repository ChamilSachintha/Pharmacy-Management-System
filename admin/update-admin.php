<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Admin</h2>

        <br>

        <?php
            ob_start();

            // Check whether the id is set or not
            if(isset($_GET['id'])) {
                // Get the id and all other details
                // echo "Getting the data";
                $id = $_GET['id'];
                // Create SQL query to get all other details
                $sql2 = "SELECT * FROM tbl_admin WHERE id=$id";

                // Execute the query
                $res2 = mysqli_query($conn, $sql2);

                // Count the rows to check whether the id is valid or not
                $count2 = mysqli_num_rows($res2);

                if($count2==1) {
                    // Get all the data
                    $row2 = mysqli_fetch_assoc($res2);

                    $current_pharmacy = $row2['pharmacy_id'];
                    $full_name = $row2['full_name'];
                    $username = $row2['username'];
                } else {
                    // Redirect to manage-category with a message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found!</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            } else {
                // Redirect to Manage Admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Pharmacy Branch: </td>
                    <td>
                        <select name="pharmacy">

                            <?php
                                // Create PHP code to display categories from the database
                                // 1. Create SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_pharmacy";

                                // Execute the query
                                $res = mysqli_query($conn, $sql);

                                // Count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                if($count>0) {
                                    // We have categories
                                    while($row=mysqli_fetch_assoc($res)) {
                                        // Get details of categories
                                        $pharmacy_id = $row['id'];
                                        $pharmacy_name = $row['name']; 

                                        ?>
                                        <option <?php if($current_pharmacy==$pharmacy_id){echo "selected";} ?> value="<?php echo $pharmacy_id; ?>"><?php echo $pharmacy_name; ?></option>

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
                    <td colspam="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
        
            if(isset($_POST['submit'])) {
                // echo "Clicked";
                // 1. Get all the values from the form
                $id = $_POST['id'];
                $pharmacy = $_POST['pharmacy'];
                $full_name = $_POST['full_name'];
                $username = $_POST['username'];

                // 3. Update the database
                $sql3 = "UPDATE tbl_admin SET
                    pharmacy_id = '$pharmacy',
                    full_name = '$full_name',
                    username = '$username'
                    WHERE id = $id
                ";

                // Execute the query
                $res3 = mysqli_query($conn, $sql3);

                // 4. Redirect to Manage Admin page with a message
                // Check whether the query is executed or not
                if($res3==TRUE) {
                    // Admin updated
                    $_SESSION['update'] = "<div class='success'>Admin is updated successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                } else {
                    // Failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to update admin!</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            ob_end_flush();
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
