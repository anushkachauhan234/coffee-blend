<?php require "../config/config.php"; ?>
<?php require "../includes/header.php"; ?>
<?php

// if(!isset($_SESSION['username']))
// {
//     header("Location: " . APPURL . "/auth/login.php");
//     exit();
// }

if (isset($_POST['submit'])) {
    // Check for empty fields
    if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo "<script>alert('One or more fields are empty');</script>";
    } else {
        // Clean input
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        try {
            // Prepare and execute insert
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) 
                                    VALUES (:username, :email, :password)");
            $stmt->execute([
                ":username" => $username,
                ":email" => $email,
                ":password" => $password
            ]);

            // Redirect after successful registration
            header("Location: login.php");
            exit;

        } catch (PDOException $e) {
            // Show database errors
            echo "<script>alert('Database Error: " . $e->getMessage() . "');</script>";
        }
    }
}
?>

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_2.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Register</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Register</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <form action="register.php" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
                    <h3 class="mb-4 billing-heading">Register</h3>
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Username">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username">
                            </div>
                        </div>
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
                                    <button type="submit" name="submit" class="btn btn-primary py-3 px-4">Register</button>
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
