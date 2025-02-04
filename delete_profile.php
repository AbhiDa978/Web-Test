<?php
session_start();
include('db.php');

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    echo "Error: You must be logged in to delete your account.";
    exit();
}

$username = $_SESSION['username'];

// Delete user from database
$query = "DELETE FROM users WHERE username = :username";
$stmt = $conn->prepare($query);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);

if ($stmt->execute()) {
    session_destroy();
    echo "success";
} else {
    echo "Error: Unable to delete account.";
}
?>
