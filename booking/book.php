<?php
session_start();
require "../config/config.php";
require "../includes/header.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    // Check if all fields are filled
    if (
        empty($_POST['first_name']) || 
        empty($_POST['last_name']) ||
        empty($_POST['date']) || 
        empty($_POST['time']) || 
        empty($_POST['phone']) || 
        empty($_POST['message'])
    ) {
        echo "<script>alert('Please fill all fields');</script>";
        exit;
    } 

    // Collect form data
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $date       = $_POST['date'];
    $time       = $_POST['time'];
    $phone      = trim($_POST['phone']);
    $message    = trim($_POST['message']);
    $user_id    = $_SESSION['user_id'] ?? 1; // temporary/test user_id if not logged in

    // Validate date: must be today or later
    $booking_date = strtotime($date);
    $today = strtotime(date('Y-m-d'));

    if ($booking_date < $today) {
        echo "<script>alert('Please select a valid date (today or later)');</script>";
        exit;
    }

    try {
        // Prepare and execute insert query
        $insert = $conn->prepare("INSERT INTO bookings 
            (first_name, last_name, date, time, phone, message, user_id)
            VALUES (:first_name, :last_name, :date, :time, :phone, :message, :user_id)");

        $insert->execute([
            ':first_name' => $first_name,
            ':last_name'  => $last_name,
            ':date'       => $date,
            ':time'       => $time,
            ':phone'      => $phone,
            ':message'    => $message,
            ':user_id'    => $user_id
        ]);

        // Redirect to login page with query string
        echo "<script>
        alert('Booking successful!');
        window.location.href = '../index.php';
      </script>";
exit;


    } catch (PDOException $e) {
        // Show database error if insert fails
        echo "<script>alert('Database Error: " . $e->getMessage() . "');</script>";
        exit;
    }
} else {
    // If page accessed without POST
    echo "<h3>Error 405! Request method not allowed.</h3>";
    exit;
}
?>
