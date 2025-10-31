<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "config/config.php";
require "includes/header.php";

// Fetch desserts
$desserts = $conn->query("SELECT * FROM products WHERE type='dessert'");
$desserts->execute();
$allDesserts = $desserts->fetchAll(PDO::FETCH_OBJ);

// Fetch drinks
$drinks = $conn->query("SELECT * FROM products WHERE type='drink'");
$drinks->execute();
$allDrinks = $drinks->fetchAll(PDO::FETCH_OBJ);
?>

<!-- Home Slider -->
<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Our Menu</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Menu</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Booking Form -->
<section class="ftco-section ftco-booking">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Book a Table</span>
                <h2 class="mb-4">Reserve Your Spot</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 ftco-animate">
                <form action="booking/book.php" method="post" class="booking-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="date" name="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="time" name="time" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="message" class="form-control" placeholder="Message">
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <input type="submit" name="submit" value="Book a Table" class="btn btn-primary py-3 px-5">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Menu Section -->
<section class="ftco-menu mb-5 pb-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Discover</span>
                <h2 class="mb-4">Our Products</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
            </div>
        </div>
        <div class="row d-md-flex">
            <div class="col-lg-12 ftco-animate p-md-5">
                <div class="row">
                    <div class="col-md-12 nav-link-wrap mb-5">
                        <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist">
                            <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1">Drinks</a>
                            <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2">Desserts</a>
                        </div>
                    </div>

                    <div class="col-md-12 d-flex align-items-center">
                        <div class="tab-content ftco-animate" id="v-pills-tabContent">

                            <!-- Drinks -->
                            <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel">
                                <div class="row">
                                    <?php foreach($allDrinks as $drink): ?>
                                        <div class="col-md-4 text-center">
                                            <div class="menu-wrap">
                                                <a href="products/product-single.php?id=<?php echo $drink->id; ?>" class="menu-img img mb-4" style="background-image: url(images/<?php echo $drink->image; ?>);"></a>
                                                <div class="text">
                                                    <h3><a href="products/product-single.php?id=<?php echo $drink->id; ?>"><?php echo htmlspecialchars($drink->name); ?></a></h3>
                                                    <p><?php echo htmlspecialchars($drink->description); ?></p>
                                                    <p class="price"><span>$<?php echo htmlspecialchars($drink->price); ?></span></p>
                                                    <p><a href="#" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Desserts -->
                            <div class="tab-pane fade" id="v-pills-2" role="tabpanel">
                                <div class="row">
                                    <?php foreach($allDesserts as $dessert): ?>
                                        <div class="col-md-4 text-center">
                                            <div class="menu-wrap">
                                                <a href="products/product-single.php?id=<?php echo $dessert->id; ?>" class="menu-img img mb-4" style="background-image: url(images/<?php echo $dessert->image; ?>);"></a>
                                                <div class="text">
                                                    <h3><a href="products/product-single.php?id=<?php echo $dessert->id; ?>"><?php echo htmlspecialchars($dessert->name); ?></a></h3>
                                                    <p><?php echo htmlspecialchars($dessert->description); ?></p>
                                                    <p class="price"><span>$<?php echo htmlspecialchars($dessert->price); ?></span></p>
                                                    <p><a href="#" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
require "includes/footer.php";
?>
