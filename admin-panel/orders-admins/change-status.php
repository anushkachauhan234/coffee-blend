<?php
require '../../config/config.php';
require '../layouts/header.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header("Location: " . ADMINURL . "admins/login-admins.php");
    exit;
}
  if(isset($_GET['id']))
  {
   $id=$_GET['id'];
    if (isset($_POST['submit'])) {
        if (empty($_POST['status'])) {
            echo "<script>alert('One or more fields are empty');</script>";
        } else {
            $status = $_POST['status'];
            // $email = trim($_POST['email']);
            // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
            try {
                $update = $conn->prepare("UPDATE orders SET status = :status  WHERE id='$id'");
                $update->execute([
                    ':status' => $status,
                    
                ]);
    
                header("Location: show-orders.php");
                exit;
            } catch (PDOException $e) {
                echo "<script>alert('Database Error: " . $e->getMessage() . "');</script>";
            }
        }
    }
  }

?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Update status</h5>

        <form method="POST" action="change-status.php?id-<?php echo $id; ?>">
          <div class="form-outline mb-4 mt-4">
            


          <div class="form-outline mb-4 mt-4">

<select name="status" class="form-select  form-control" aria-label="Default select example">
  <option selected>Choose Type</option>
  <option value="Pending">Pending</option>
  <option value="Delivered">Delivered</option>
</select>
</div>

          <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require '../layouts/footer.php'; ?>