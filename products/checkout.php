<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

require "../config/config.php";
require "../includes/header.php";

// Check if user_id and total_price exist in session
if (!isset($_SESSION['user_id']) || !isset($_SESSION['total_price'])) {
    die("<p style='color:red;'>Error: Session expired or invalid. Please try again.</p>");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Check for empty fields
    if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['street_address']) || empty($_POST['state']) || empty($_POST['town']) || empty($_POST['zip_code']) || empty($_POST['phone'])) {
        $error = "All fields are required!";
    } else {
        // Assign variables
        $first_name     = $_POST['first_name'];
        $last_name      = $_POST['last_name'];
        $street_address = $_POST['street_address'];
        $state          = $_POST['state'];
        $town           = $_POST['town'];
        $zip_code       = $_POST['zip_code'];
        $phone          = $_POST['phone'];
        $user_id        = $_SESSION['user_id'];
        $total_price    = $_SESSION['total_price'];
        $status         = 'pending'; // default value for status

        // Insert into database
        try {
            $place_orders = $conn->prepare("
                INSERT INTO orders 
                (user_id, first_name, last_name, street_address, state, town, zip_code, phone, total_price, status) 
                VALUES 
                (:user_id, :first_name, :last_name, :street_address, :state, :town, :zip_code, :phone, :total_price, :status)
            ");

            $place_orders->execute([
                ':user_id'        => $user_id,
                ':first_name'     => $first_name,
                ':last_name'      => $last_name,
                ':street_address' => $street_address,
                ':state'          => $state,
                ':town'           => $town,
                ':zip_code'       => $zip_code,
                ':phone'          => $phone,
                ':total_price'    => $total_price,
                ':status'         => $status
            ]);

            // Redirect to payment page
            header("Location: pay.php");
            exit();

        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>

<section class="home-slider owl-carousel">
  <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center">
        <div class="col-md-7 col-sm-12 text-center ftco-animate">
          <h1 class="mb-3 mt-5 bread">Checkout</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <div class="row">
      <div class="col-md-12 ftco-animate">
        <form action="checkout.php" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
          <h3 class="mb-4 billing-heading">Billing Details</h3>
          <div class="row align-items-end">

            <div class="col-md-6">
              <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="">
              </div>
            </div>

            <div class="w-100"></div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="state">State / Country</label>
                <select name="state" class="form-control">
                  <option value="">Select</option>
                  <option value="France">France</option>
                  <option value="Italy">Italy</option>
                  <option value="Philippines">Philippines</option>
                  <option value="South Korea">South Korea</option>
                  <option value="Hongkong">Hongkong</option>
                  <option value="Japan">Japan</option>
                </select>
              </div>
            </div>

            <div class="w-100"></div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="street_address">Street Address</label>
                <input type="text" name="street_address" class="form-control" placeholder="House number and street name">
              </div>
            </div>

            <div class="w-100"></div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="town">Town / City</label>
                <input type="text" name="town" class="form-control" placeholder="">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="zip_code">Postcode / ZIP *</label>
                <input type="text" name="zip_code" class="form-control" placeholder="">
              </div>
            </div>

            <div class="w-100"></div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="">
              </div>
            </div>

            <div class="w-100"></div>

            <div class="col-md-12">
              <div class="form-group mt-4">
                <button type="submit" name="submit" class="btn btn-primary py-3 px-4">Place an order</button>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php
require "../includes/footer.php";
?>
