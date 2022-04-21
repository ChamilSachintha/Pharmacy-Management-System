<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Pharmacy Branch</h2>

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
                    <td>Branch Name: </td>
                    <td>
                        <input type="text" name="name" placeholder="Enter branch name here">
                    </td>
                </tr>

                <tr>
                    <td>Contact: </td>
                    <td>
                        <input type="tel" name="contact" placeholder="Enter contact details here">
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email" name="email" placeholder="Enter email here">
                    </td>
                </tr>

                <tr>
                    <td>Address: </td>
                    <td>
                        <textarea name="address" rows="10" placeholder="E.g. No.x, Street, City"></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspam="2">
                        <input type="submit" name="submit" value="Save Branch" class="btn-primary">
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
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        // 2. SQL query to save data into database
        $sql = "INSERT INTO tbl_pharmacy SET
            name='$name',
            contact='$contact',
            email='$email',
            address='$address'
        ";   

        // 3. Executing query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. Check whether the data is inserted (query is executed) or not and display appropriate message
        if($res==TRUE) {
            // Data inserted
            // echo "Data inserted";
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Branch added successfully!</div>";
            // Redirect to Manage Pharmacy Branches page
            header("location:".SITEURL.'admin/manage-pharmacy.php');
        } else {
            // Failed to insert data
            // echo "Failed to insert data";
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to add branch!</div>";
            // Redirect to add Pharmacy Branches page
            header("location:".SITEURL.'admin/add-pharmacy.php');
        }
    } 
?>