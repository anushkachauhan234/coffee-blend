<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "config/config.php";
require "includes/header.php"; 

// Fetch products
$products = $conn->query("SELECT * FROM products");
$allproducts = $products->fetchAll(PDO::FETCH_OBJ);

// Fetch reviews
$reviews = $conn->query("SELECT * FROM reviews ORDER BY created_at DESC");
$allReviews = $reviews->fetchAll(PDO::FETCH_OBJ);
?>

<!-- Home Slider -->
<section class="home-slider owl-carousel">
  <?php 
  $slider_images = ['bg_1.jpg','bg_2.jpg','bg_3.jpg'];
  $slider_titles = [
    'The Best Coffee Testing Experience',
    'Amazing Taste &amp; Beautiful Place',
    'Creamy Hot and Ready to Serve'
  ];
  $slider_texts = [
    'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
    'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
    'A small river named Duden flows by their place and supplies it with the necessary regelialia.'
  ];
  for($i=0;$i<count($slider_images);$i++): ?>
  <div class="slider-item" style="background-image: url('<?php echo APPURL; ?>/images/<?php echo $slider_images[$i]; ?>');">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
        <div class="col-md-8 col-sm-12 text-center ftco-animate">
          <span class="subheading">Welcome</span>
          <h1 class="mb-4"><?php echo $slider_titles[$i]; ?></h1>
          <p class="mb-4 mb-md-5"><?php echo $slider_texts[$i]; ?></p>
          <p>
            <a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a>
            <a href="#" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <?php endfor; ?>
</section>

<!-- Intro / Book Table -->
<section class="ftco-intro">
  <div class="container-wrap">
    <div class="wrap d-md-flex align-items-xl-end">
      <div class="info">
        <div class="row no-gutters">
          <div class="col-md-4 d-flex ftco-animate">
            <div class="icon"><span class="icon-phone"></span></div>
            <div class="text">
              <h3>000 (123) 456 7890</h3>
              <p>A small river named Duden flows by their place and supplies.</p>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="icon"><span class="icon-my_location"></span></div>
            <div class="text">
              <h3>198 West 21th Street</h3>
              <p>203 Fake St. Mountain View, San Francisco, California, USA</p>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="icon"><span class="icon-clock-o"></span></div>
            <div class="text">
              <h3>Open Monday-Friday</h3>
              <p>8:00am - 9:00pm</p>
            </div>
          </div>
        </div>
      </div>
      <div class="book p-4">
        <h3>Book a Table</h3>
        <form action="booking/book.php" method='POST' class="appointment-form">
          <div class="d-md-flex">
            <div class="form-group">
              <input type="text" name="first_name" class="form-control" placeholder="First Name">
            </div>
            <div class="form-group ml-md-4">
              <input type="text" name="last_name" class="form-control" placeholder="Last Name">
            </div>
          </div>
          <div class="d-md-flex">
            <div class="form-group">
              <div class="input-wrap">
                <div class="icon"><span class="ion-md-calendar"></span></div>
                <input name="date" class="form-control appointment_date" placeholder="Date">
              </div>
            </div>
            <div class="form-group ml-md-4">
              <div class="input-wrap">
                <div class="icon"><span class="ion-ios-clock"></span></div>
                <input name="time" type="text" class="form-control appointment_time" placeholder="Time">
              </div>
            </div>
            <div class="form-group ml-md-4">
              <input name="phone" type="text" class="form-control" placeholder="Phone">
            </div>
          </div>
          <div class="d-md-flex">
            <div class="form-group">
              <textarea name="message" cols="30" rows="2" class="form-control" placeholder="Message"></textarea>
            </div>
            <div class="form-group ml-md-4">
              <button type="submit" name="submit" class="btn btn-white py-3 px-4">Book a table</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- About Section -->
<section class="ftco-about d-md-flex">
  <div class="one-half img" style="background-image: url('<?php echo APPURL; ?>/images/about.jpg');"></div>
  <div class="one-half ftco-animate">
    <div class="overlap">
      <div class="heading-section ftco-animate">
        <span class="subheading">Discover</span>
        <h2 class="mb-4">Our Story</h2>
      </div>
      <div>
        <p>On her way she met a copy. The copy warned the Little Blind Text…</p>
      </div>
    </div>
  </div>
</section>

<!-- Services -->
<section class="ftco-section ftco-services">
  <div class="container">
    <div class="row">
      <?php
      $services = [
        ['icon'=>'flaticon-choices','title'=>'Easy to Order','desc'=>'Even the all-powerful Pointing has no control about the blind texts.'],
        ['icon'=>'flaticon-delivery-truck','title'=>'Fastest Delivery','desc'=>'Even the all-powerful Pointing has no control about the blind texts.'],
        ['icon'=>'flaticon-coffee-bean','title'=>'Quality Coffee','desc'=>'Even the all-powerful Pointing has no control about the blind texts.'],
      ];
      foreach($services as $service): ?>
      <div class="col-md-4 ftco-animate">
        <div class="media d-block text-center block-6 services">
          <div class="icon d-flex justify-content-center align-items-center mb-5">
            <span class="<?php echo $service['icon']; ?>"></span>
          </div>
          <div class="media-body">
            <h3 class="heading"><?php echo $service['title']; ?></h3>
            <p><?php echo $service['desc']; ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Products / Menu Section -->
<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 heading-section ftco-animate text-center">
        <span class="subheading">Discover</span>
        <h2 class="mb-4">Best Coffee Sellers</h2>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
      </div>
    </div>
    <div class="row">
      <?php foreach($allproducts as $product): ?>
      <div class="col-md-3">
        <div class="menu-entry">
          <a target="_blank" href="images/<?php echo $product->image ?>" class="img" style="background-image: url('images/<?php echo $product->image; ?>');"></a>
          <div class="text text-center pt-4">
            <h3><a href="#"><?php echo $product->name; ?></a></h3>
            <p><?php echo $product->description; ?></p>
            <p class="price"><span><?php echo $product->price; ?></span></p>
            <p><a target="_blank" href="products/product-single.php?id=<?php echo $product->id ?>" class="btn btn-primary btn-outline-primary">Show</a></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Reviews Section -->
<section class="ftco-section img" id="ftco-testimony" style="background-image: url('<?php echo APPURL; ?>/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-7 heading-section text-center ftco-animate">
        <span class="subheading">Testimony</span>
        <h2 class="mb-4">Customers Say</h2>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
      </div>
    </div>
    <div class="container-wrap">
      <div class="row d-flex no-gutters">
        <?php foreach($allReviews as $review): ?>
        <div class="col-lg align-self-sm-end ftco-animate">
          <div class="testimony">
            <blockquote>
              <p>&ldquo;<?php echo $review->review; ?>&rdquo;</p>
            </blockquote>
            <div class="author d-flex mt-4">
              <div class="image mr-3 align-self-center">
                <img src="images/person_2.jpg" alt="">
              </div>
              <div class="name align-self-center"><?php echo $review->user_name; ?></div>
            </div>
          </div>
		  <?php endforeach; ?>
      </div> <!-- .row -->
    </div> <!-- .container-wrap -->
</section>

<?php require "includes/footer.php"; ?>
