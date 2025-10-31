<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

require "../config/config.php";
require "../includes/header.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php"); // Redirect to home page
    exit();
}

// Fetch cart products for current user
$products = $conn->query("SELECT * FROM cart WHERE user_id = '" . $_SESSION['user_id'] . "'");
$allproducts = $products->fetchAll(PDO::FETCH_OBJ);

// If cart is empty, display message and exit early
if (count($allproducts) == 0) {
    echo '<section class="ftco-section ftco-cart">
            <div class="container text-center">
                <h3>Your cart is empty!</h3>
                <p>Add products to your cart to proceed to checkout.</p>
                <a href="'.APPURL.'/index.php" class="btn btn-primary mt-3">Go Shopping</a>
            </div>
          </section>';
    require "../includes/footer.php";
    exit();
}

// Calculate subtotal
$subtotal = 0;
foreach ($allproducts as $product) {
    $subtotal += $product->quantity * $product->price;
}

// Set delivery charges dynamically
if ($subtotal >= 500) {
    $delivery = 0;
    $delivery_text = "Free Delivery";
} elseif ($subtotal >= 200) {
    $delivery = 5;
    $delivery_text = "₹5 Delivery";
} else {
    $delivery = 10;
    $delivery_text = "₹10 Delivery";
}

// Set discount dynamically
if ($subtotal >= 1000) {
    $discount = $subtotal * 0.1;
    $discount_text = "10% Discount";
} elseif ($subtotal >= 500) {
    $discount = $subtotal * 0.05;
    $discount_text = "5% Discount";
} else {
    $discount = 0;
    $discount_text = "No Discount";
}

// Calculate total
$total = $subtotal + $delivery - $discount;

// Proceed to checkout
if (isset($_POST['checkout'])) {
    $_SESSION['total_price'] = $_POST['total_price'];
    header("Location: checkout.php"); // Redirect to checkout
    exit();
}
?>

<section class="ftco-section ftco-cart">
  <div class="container">
    <!-- Cart Table -->
    <div class="row">
      <div class="col-md-12 ftco-animate">
        <div class="cart-list">
          <table class="table">
            <thead class="thead-primary">
              <tr class="text-center">
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($allproducts as $product): ?>
              <tr class="text-center">
                <td class="product-remove"><a href="delete-product.php?id=<?php echo $product->id; ?>"><span class="icon-close"></span></a></td>
                <td class="image-prod"><div class="img" style="background-image: url('<?php echo APPURL; ?>/images/<?php echo $product->image; ?>');"></div></td>
                <td class="product-name">
                  <h3><?php echo $product->name; ?></h3>
                  <p><?php echo $product->description; ?></p>
                </td>
                <td class="price">₹<?php echo $product->price; ?></td>
                <td><input disabled type="text" value="<?php echo $product->quantity; ?>" class="form-control w-25"></td>
                <td class="total">₹<?php echo $product->quantity * $product->price; ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Cart Totals -->
    <div class="row justify-content-end">
      <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
          <h3>Cart Totals</h3>
          <p class="d-flex">
            <span>Subtotal</span>
            <span>₹<?php echo number_format($subtotal, 2); ?></span>
          </p>
          <p class="d-flex">
            <span>Delivery</span>
            <span><?php echo $delivery_text; ?></span>
          </p>
          <p class="d-flex">
            <span>Discount</span>
            <span><?php echo $discount_text; ?></span>
          </p>
          <hr>
          <p class="d-flex total-price">
            <span>Total</span>
            <span>₹<?php echo number_format($total, 2); ?></span>
          </p>
        </div>
        <form method="POST" action="cart.php">
          <input type="hidden" name="total_price" value="<?php echo number_format($total, 2); ?>">
          <button name="checkout" type="submit" class="btn btn-primary py-3 px-4">Proceed to Checkout</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php require "../includes/footer.php"; ?>
