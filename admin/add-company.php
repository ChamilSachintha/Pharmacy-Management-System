<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Company</h2>

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
                    <td>Company Name: </td>
                    <td>
                        <input type="text" name="company_name" placeholder="Enter company name here">
                    </td>
                </tr>

                <tr>
                    <td>Company Contact: </td>
                    <td>
                        <input type="tel" name="company_contact" placeholder="Enter company contact">
                    </td>
                </tr>

                <tr>
                    <td>Company Email: </td>
                    <td>
                        <input type="email" name="company_email" placeholder="Enter email">
                    </td>
                </tr>

                <tr>
                    <td>Company Address: </td>
                    <td>
                        <textarea name="company_address" rows="5" cols="30" placeholder="E.g. No.x, Street, City" class="input-responsive"></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspam="2">
                        <input type="submit" name="submit" value="Save Company" class="btn-primary">
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

        // 1. Get data fro form
        $company_name = $_POST['company_name'];
        $company_contact = $_POST['company_contact'];
        $company_email = $_POST['company_email'];
        $company_address = $_POST['company_address'];

        // 2. SQL query to save data into database
        $sql = "INSERT INTO tbl_company SET
            company_name='$company_name',
            company_contact='$company_contact',
            company_email='$company_email',
            company_address='$company_address'
        ";   

        // 3. Executing query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. Check whether the data is inserted (query is executed) or not and display appropriate message
        if($res==TRUE) {
            // Data inserted
            // echo "Data inserted";
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Company added successfully!</div>";
            // Redirect to Manage Company page
            header("location:".SITEURL.'admin/manage-company.php');
        } else {
            // Failed to insert data
            // echo "Failed to insert data";
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to add company!</div>";
            // Redirect to add admin page
            header("location:".SITEURL.'admin/add-company.php');
        }
    } 
?>