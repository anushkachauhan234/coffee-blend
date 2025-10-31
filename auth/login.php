<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "../config/config.php";
require "../includes/header.php";
?>

<?php
// if(!isset($_SESSION['username']))
// {
//    header("location:". APPURL);
// }


if (isset($_POST['login'])) {


   if (empty($_POST['email']) || empty($_POST['password'])) {
       echo "<script>alert('Email or Password is empty');</script>";
   } else {
       $email = trim($_POST['email']);
       $password = $_POST['password'];


       try {
           // Prepare statement to select user by email
           $login = $conn->prepare("SELECT * FROM users WHERE email = :email");
           $login->execute([':email' => $email]);
           $fetch = $login->fetch(PDO::FETCH_ASSOC);


           if ($fetch) {
               // Verify password
               if (password_verify($password, $fetch['password'])) {
                   // Password correct, start session and redirect
                   session_start();
                   $_SESSION['user_id'] = $fetch['id'];
                   $_SESSION['username'] = $fetch['username'];
                   $_SESSION['email'] = $fetch['email'];


                   //header("Location: index.php"); // or dashboard.php
                    header("Location: " . APPURL . "/index.php");
                   exit;
               } else {
                   echo "<script>alert('Incorrect password');</script>";
               }
           } else {
               echo "<script>alert('Email not found');</script>";
           }


       } catch (PDOException $e) {
           echo "<script>alert('Database Error: " . $e->getMessage() . "');</script>";
       }
   }
}
?>


<section class="home-slider owl-carousel">
   <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
       <div class="overlay"></div>
       <div class="container">
           <div class="row slider-text justify-content-center align-items-center">
               <div class="col-md-7 col-sm-12 text-center ftco-animate">
                   <h1 class="mb-3 mt-5 bread">Login</h1>
                   <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Login</span></p>
               </div>
           </div>
       </div>
   </div>
</section>


<section class="ftco-section">
   <div class="container">
       <div class="row">
           <div class="col-md-12 ftco-animate">
               <form action="" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
                   <h3 class="mb-4 billing-heading">Login</h3>
                   <div class="row align-items-end">
                       <div class="col-md-12">
                           <div class="form-group">
                               <label for="Email">Email</label>
                               <input type="text" name="email" class="form-control" placeholder="Email">
                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="form-group">
                               <label for="Password">Password</label>
                               <input type="password" name="password" class="form-control" placeholder="Password">
                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="form-group mt-4">
                               <div class="radio">
                                   <button type="submit" name="login" class="btn btn-primary py-3 px-4">Login</button>
                               </div>
                           </div>
                       </div>
                   </div>
               </form><!-- END -->
           </div>
       </div>
   </div>
</section>


<?php require "../includes/footer.php"; ?>

