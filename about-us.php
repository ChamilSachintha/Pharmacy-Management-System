<?php include('partials-front/menu.php'); ?>

    <section class="abt-us">
        <div class="container">
  
                <fieldset>
                  <h2>
                    <legend class="text-right">About Health Guard</legend>
                  </h2>

                    <div class="abt-img"></div>
                    <p class="text-left txt-shadow-white">
                      Healthguard Pharmacy is the 1st branded retail Healthcare Chain in Sri Lanka. The Company entered the market with a view of creating differentiated offerings and retailing experiences for the consumer. The organization, headed by a team of professionals, has introduced an innovative retail concept centered on exceptional shopper experience through service, technology, product offering, pricing, and a host of value additions. Through this innovative concept, Healthguard has gained a market leadership position in Drug Store Retailing with a loyal consumer base.
                      <br><br>
                      Healthguard’s core tenet has been to be the standard in healthcare retailing. Centered on this belief, our business model strives to be more just than an ordinary pharmacy in our offerings, format, and solutions. Our view of Healthcare Retailing is not limited to the narrow focus of pharmaceuticals. To us, Healthcare Retailing is also about Living Better (Wellness) and Looking Better (Beauty).
                      </p>
                </fieldset>

        </div>
    </section>

    <section class="contact container text-center">
      <h3>Contact us</h3>

      <br><br>

      <table class="tbl-full">
        <tr>
          <th>Branch</th>
          <th>Contact No.</th>
          <th>Email</th>
          <th>Address</th>
        </tr>

        <?php
          // Query to get all details
          $sql = "SELECT * FROM tbl_pharmacy";
          // Execute the query
          $res = mysqli_query($conn, $sql);

          // Check whether the query is executed or not
          if($res==TRUE) {
            // Count rows to check whethere we have data in database or not
            $count = mysqli_num_rows($res); // Function to get all the rows in database 

            $sn=1; // Create a variable and assign the value

            // Check the number of rows
            if($count>0) {
              // We have data in database
              while($rows=mysqli_fetch_assoc($res)) {
                // Using while loop to get all the data from database 
                // While loop will run as long as we have data in database

                // Get individual data
                $id=$rows['id'];
                $name=$rows['name'];
                $contact=$rows['contact'];
                $email=$rows['email'];
                $address=$rows['address'];

                // Display the values in the table
                ?>
                <tr>
                  <td><br><br></td>
                </tr>

                <tr>
                  <td><?php echo $name; ?></td>
                  <td><?php echo $contact; ?></td>
                  <td><?php echo $email; ?></td>
                  <td><?php echo $address; ?></td>
                </tr>

                <?php
              }
            } else {
              // We don't have data in database
            }
          }
        ?>
      </table>
    </section>

    <br>
<?php include('partials-front/footer.php'); ?> 