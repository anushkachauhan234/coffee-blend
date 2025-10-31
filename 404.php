<?php
session_start();
require "config/config.php";
require "includes/header.php";
?>

<!-- Hero / Banner Section -->
<section class="home-slider owl-carousel">
  <div class="slider-item" style="background-image: url('<?php echo APPURL; ?>/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center">
        <div class="col-md-7 col-sm-12 text-center ftco-animate">
          <h1 class="mb-3 mt-5 bread">Page Not Found</h1>

          <button href="<?php echo APPURL; ?>" class="btn btn-primary py-3 px-4"> Go Home </button>
          <p class="breadcrumbs">
            <span class="mr-2"><a href="<?php echo APPURL; ?>/index.php">Home</a></span> 
            <span>404</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 404 Message Section -->
<section class="ftco-section text-center">
  <div class="container">
    <h2>Oops! The page you are looking for does not exist.</h2>
    <p>It might have been removed, or the URL is incorrect.</p>
    <a href="<?php echo APPURL; ?>/index.php" class="btn btn-primary mt-3">Go Back Home</a>
  </div>
</section>

<?php require "../includes/footer.php"; ?>
