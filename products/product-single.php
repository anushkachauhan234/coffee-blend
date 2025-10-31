<?php
// Start session and show errors
// config.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../config/config.php";
require "../includes/header.php";

// Initialize variables
$singleproduct = null;
$allrelatedproducts = [];

// ✅ Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../users/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ✅ Check if 'id' is provided and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch product accessible to this user
    // If all users can see all products, remove AND user_id = :user_id
    $product = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $product->execute([':id' => $id]);
    $singleproduct = $product->fetch(PDO::FETCH_OBJ);

    if (!$singleproduct) {
        header("Location: " . APPURL . "/404.php");
        exit();
    }

    // Fetch related products (same type, exclude current)
    $related = $conn->prepare("SELECT * FROM products WHERE type = :type AND id != :id");
    $related->execute([':type' => $singleproduct->type, ':id' => $id]);
    $allrelatedproducts = $related->fetchAll(PDO::FETCH_OBJ);

    // ✅ Add to Cart
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $image = $_POST['image'];
        $price = $_POST['price'];
        $pro_id = $_POST['pro_id'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];

        // Check if already in cart
        $check_cart = $conn->prepare("SELECT * FROM cart WHERE pro_id = :pro_id AND user_id = :user_id");
        $check_cart->execute([':pro_id' => $pro_id, ':user_id' => $user_id]);

        if ($check_cart->rowCount() > 0) {
            echo "<script>alert('This product is already in your cart!');</script>";
        } else {
            $insert_cart = $conn->prepare("
                INSERT INTO cart (name, image, price, description, quantity, user_id, pro_id)
                VALUES (:name, :image, :price, :description, :quantity, :user_id, :pro_id)
            ");
            $insert_cart->execute([
                ':name' => $name,
                ':image' => $image,
                ':price' => $price,
                ':description' => $description,
                ':quantity' => $quantity,
                ':user_id' => $user_id,
                ':pro_id' => $pro_id
            ]);
            echo "<script>alert('Product added to cart successfully!');</script>";
        }
    }

} else {
    // ❌ No valid ID, redirect to 404
    header("Location: " . APPURL . "/404.php");
    exit();
}
?>

<!-- Page Header -->
<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url('<?php echo APPURL; ?>/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Product Details</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL; ?>">Home</a></span> <span>Product</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product Section -->
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <!-- Product Image -->
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="<?php echo APPURL; ?>/images/<?php echo $singleproduct->image; ?>" class="image-popup">
                    <img src="<?php echo APPURL; ?>/images/<?php echo $singleproduct->image; ?>" class="img-fluid" alt="<?php echo $singleproduct->name; ?>">
                </a>
            </div>

            <!-- Product Details -->
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3><?php echo $singleproduct->name; ?></h3>
                <p class="price"><span>₹<?php echo $singleproduct->price; ?></span></p>
                <p><?php echo $singleproduct->description; ?></p>

                <!-- Size dropdown -->
                <div class="row mt-4 mb-4">
                    <div class="col-md-6">
                        <div class="form-group d-flex">
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select class="form-control">
                                    <option>Small</option>
                                    <option>Medium</option>
                                    <option>Large</option>
                                    <option>Extra Large</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add to Cart Form -->
                <form method="POST" action="product-single.php?id=<?php echo $id; ?>">
                    <input type="hidden" name="name" value="<?php echo $singleproduct->name; ?>">
                    <input type="hidden" name="image" value="<?php echo $singleproduct->image; ?>">
                    <input type="hidden" name="price" value="<?php echo $singleproduct->price; ?>">
                    <input type="hidden" name="description" value="<?php echo $singleproduct->description; ?>">
                    <input type="hidden" name="pro_id" value="<?php echo $singleproduct->id; ?>">

                    <!-- Quantity -->
                    <div class="input-group col-md-6 d-flex mb-3">
                        <span class="input-group-btn mr-2">
                            <button type="button" class="quantity-left-minus btn" data-type="minus">
                                <i class="icon-minus"></i>
                            </button>
                        </span>
                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                        <span class="input-group-btn ml-2">
                            <button type="button" class="quantity-right-plus btn" data-type="plus">
                                <i class="icon-plus"></i>
                            </button>
                        </span>
                    </div>

                    <button type="submit" name="submit" class="btn-add-cart">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
<?php if (!empty($allrelatedproducts)): ?>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <h2 class="mb-4">Related Products</h2>
            </div>
        </div>
        <div class="row">
            <?php foreach ($allrelatedproducts as $product): ?>
            <div class="col-md-3 text-center">
                <div class="menu-entry">
                    <a href="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $product->id; ?>" class="img" style="background-image: url('<?php echo APPURL; ?>/images/<?php echo $product->image; ?>');"></a>
                    <div class="text text-center pt-4">
                        <h3><a href="#"><?php echo $product->name; ?></a></h3>
                        <p><?php echo substr($product->description, 0, 50); ?>...</p>
                        <p class="price"><span>₹<?php echo $product->price; ?></span></p>
                        <p><a href="<?php echo APPURL; ?>/products/product-single.php?id=<?php echo $product->id; ?>" class="btn btn-primary btn-outline-primary">View</a></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php require "../includes/footer.php"; ?>

<!-- Quantity Buttons -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const minus = document.querySelector('.quantity-left-minus');
    const plus = document.querySelector('.quantity-right-plus');
    const quantityInput = document.getElementById('quantity');

    plus.addEventListener('click', function(e) {
        e.preventDefault();
        let quantity = parseInt(quantityInput.value);
        if (quantity < 100) quantityInput.value = quantity + 1;
    });

    minus.addEventListener('click', function(e) {
        e.preventDefault();
        let quantity = parseInt(quantityInput.value);
        if (quantity > 1) quantityInput.value = quantity - 1;
    });
});
</script>