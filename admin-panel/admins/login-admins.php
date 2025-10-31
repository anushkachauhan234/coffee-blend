<?php

require'../layouts/header.php'; 
require'../../config/config.php';  
 




 // If already logged in, redirect to dashboard
if (isset($_SESSION['admin_name'])) {
   header("Location: " . ADMINURL . "index.php");
   exit;
}
if (isset($_POST['submit'])) {


   if (empty($_POST['email']) || empty($_POST['password'])) {
       echo "<script>alert('Email or Password is empty');</script>";
   } else {
       $email = trim($_POST['email']);
       $password = $_POST['password'];


       try {
           // Prepare statement to select user by email
           $login = $conn->prepare("SELECT * FROM admins WHERE email = :email");
           $login->execute([':email' => $email]);
           $fetch = $login->fetch(PDO::FETCH_ASSOC);


           if ($fetch) {
               // Verify password
               if (password_verify($password, $fetch['password'])) {
                   // Password correct, start session and redirect
                  //  session_start();
                  
                   $_SESSION['admin_name'] = $fetch['adminname'];
                    $_SESSION['email'] = $fetch['email'];
              $_SESSION['admin_id'] = $fetch['id'];

                   //header("Location: index.php"); // or dashboard.php
                    header("Location: " . ADMINURL . "");
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



      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mt-5">Login</h5>
              <form method="POST" class="p-auto" action="login-admins.php">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                   
                  </div>

                  
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                    
                  </div>



                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                 
                </form>

            </div>
       </div>
     </div>
     <?php require'../layouts/footer.php';  ?>