<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require "../config/config.php";
require "../includes/header.php";

// ✅ Ensure user is logged in
if (!isset($_SESSION['username'])) {
    die("<p style='color:red;'>Error: You must be logged in to write a review.</p>");
}

// ✅ Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['review'])) {
        $error = "Please write something in your review.";
    } else {
        $review = trim($_POST['review']);
        $user_name = $_SESSION['username']; // Assuming username is stored in session

        try {
            // ✅ Insert review into database (created_at auto-fills)
            $insertReview = $conn->prepare("
                INSERT INTO reviews (user_name, review)
                VALUES (:user_name, :review)
            ");

            $insertReview->execute([
                ':user_name' => $user_name,
                ':review'    => $review
            ]);

            // ✅ Redirect to homepage or orders page
            header("Location: " . APPURL . "/index.php");
            exit();

        } catch (PDOException $e) {
            $error = "Database error: " . htmlspecialchars($e->getMessage());
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
          <h1 class="mb-3 mt-5 bread">Write a Review</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL; ?>/index.php">Home</a></span> <span>Write Review</span></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <?php if(isset($error)): ?>
      <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    
    <div class="row">
      <div class="col-md-12 ftco-animate">
        <form action="" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
          <h3 class="mb-4 billing-heading">Your Review</h3>
          <div class="row align-items-end">
            <div class="col-md-12">
              <div class="form-group">
                <label for="review">Write your review</label>
                <textarea name="review" class="form-control" placeholder="Share your experience..." rows="4" required></textarea>
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="form-group mt-4">
                <button type="submit" name="submit" class="btn btn-primary py-3 px-4">Submit Review</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php require "../includes/footer.php"; ?>
