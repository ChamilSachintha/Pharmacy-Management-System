<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Admin</h2>

        <br>

        <?php 
            if(isset($_SESSION['add'])) {   // Checking whether the session is set or not
                echo $_SESSION['add'];      // Display the session message if set
                unset($_SESSION['add']);    // Remove session message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter admin's full name here">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter a username for admin">
                    </td>
                </tr>

                <tr>
                    <td>Pharmacy Branch: </td>
                    <td>
                        <select name="pharmacy_name">

                            <?php
                                // Create PHP code to display pharmacy branches from the database
                                // 1. Create SQL to get all pharmacy branches from database
                                $sql2 = "SELECT * FROM tbl_pharmacy";

                                // Execute the query
                                $res2 = mysqli_query($conn, $sql2);

                                // Count rows to check whether we have categories or not
                                $count2 = mysqli_num_rows($res2);

                                if($count2>0) {
                                    // We have categories
                                    while($row2=mysqli_fetch_assoc($res2)) {
                                        // Get details of categories
                                        $id = $row2['id'];
                                        $name = $row2['name']; 

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $name; ?></option>

                                        <?php
                                    }
                                } else {
                                    // We don't have categories
                                    ?>

                                    <option value="0">No pharmacy branches found!</option>

                                    <?php
                                }

                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter a password">
                    </td>
                </tr>

                <tr>
                    <td colspam="2">
                        <input type="submit" name="submit" value="Save Admin" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    // Process the value from form and save it in database

    // Check whether the submit button is clicked or not

    if(isset($_POST['submit'])) 
    {
        // Button clicked
        // echo "Button clicked";

        // 1. Get data from form
        $pharmacy_name = $_POST['pharmacy_name'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Password encription with MD5

        // 2. SQL query to save data into database
        $sql = "INSERT INTO tbl_admin SET
            pharmacy_id='$pharmacy_name',
            full_name='$full_name',
            username='$username',
            password='$password'
        ";   

        // 3. Executing query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. Check whether the data is inserted (query is executed) or not and display appropriate message
        if($res==TRUE) {
            // Data inserted
            // echo "Data inserted";
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin added successfully!</div>";
            // Redirect to manage admin page
            // header("location:".SITEURL.'admin/manage-admin.php');

            echo("<script>location.href = '".SITEURL."/admin/manage-admin.php?msg=$msg';</script>");

        } else {
            // Failed to insert data
            // echo "Failed to insert data";
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to add admin!</div>";
            // Redirect to add admin page
            header("location:".SITEURL.'admin/add-admin.php');
        }
    } 
?>