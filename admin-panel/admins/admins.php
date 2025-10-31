<?php
require '../../config/config.php';
require '../layouts/header.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header("Location: " . ADMINURL . "admins/login-admins.php");
    exit;
}

$admins = $conn->prepare("SELECT * FROM admins");
$admins->execute();
$allAdmins = $admins->fetchAll(PDO::FETCH_OBJ);
?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Admins</h5>
        <a href="create-admins.php" class="btn btn-primary mb-4 float-right">Create Admins</a>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Username</th>
              <th scope="col">Email</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($allAdmins as $admin): ?>
              <tr>
                <th scope="row"><?= $admin->id; ?></th>
                <td><?= $admin->adminname; ?></td>
                <td><?= $admin->email; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require '../layouts/footer.php'; ?>
