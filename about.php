<?php 
require "config/config.php";
require "includes/header.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
}

// Fetch reviews
$reviews = $conn->query("SELECT * FROM reviews ORDER BY created_at DESC");
$allReviews = $reviews->fetchAll(PDO::FETCH_OBJ);
?>

<section class="home-slider owl-carousel">
  <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center">
        <div class="col-md-7 col-sm-12 text-center ftco-animate">
          <h1 class="mb-3 mt-5 bread">About Us</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>About</span></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-about d-md-flex">
  <div class="one-half img" style="background-image: url(images/about.jpg);"></div>
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

<!-- Dynamic Reviews Section -->
<section class="ftco-section img" id="ftco-testimony" style="background-image: url(images/bg_1.jpg);" data-stellar-background-ratio="0.5">
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
                <div class="name align-self-center">
                  <?php echo $review->user_name; ?> 
                  <span class="position"><?php echo $review->position ?? ''; ?></span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
</section>

<?php require "includes/footer.php"; ?>
