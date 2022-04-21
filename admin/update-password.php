<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Change Password</h2>

        <br>

        <?php 
            if(isset($_GET['id'])) {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspam="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php
    // Check whether the "Update Admin" button is clicked or not
    if(isset($_POST['submit'])) {
        // echo "Button clicked";

        // 1. Get data from form
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        // 2. Check whether the user with current ID and current password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        if($res==TRUE) {
            // Check whether data is available or not
            $count=mysqli_num_rows($res);

            if($count==1) {
                // User exists and password can be changed
                // echo "User found";

                // Check whether the new password and confirm password match or not
                if($new_password==$confirm_password) {
                    // Update the password
                    $sql2 = "UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id=$id
                    ";

                    // Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    // Check whether the query is executed or not
                    if($res2==TRUE) {
                        // Display message
                        // Redirect to manage-admin page
                        $_SESSION['change-password'] = "<div class='success'>Password is changed successfully!</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    } else {
                        // Display error message
                        // Redirect to manage-admin page
                        $_SESSION['change-password'] = "<div class='error'>Failed to change the password!</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');

                    }

                } else {
                    // Redirect to manage-admin page with an error message
                    $_SESSION['password-not-match'] = "<div class='error'>The confirm password doesn't match with the new password!</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            } else {
                // User does not exist, set message and redirect
                $_SESSION['user-not-found'] = "<div class='error'>The current password is not correct or the user is not found!</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

        // 3. Check whether the new password and confirm password match or not

        // 4. Change password if all above is true
    }

?>

<?php include('partials/footer.php'); ?>
