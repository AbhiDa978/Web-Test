<?php
session_start();
include('db.php');

if (!isset($_SESSION['username'])) {
    echo "Unauthorized access!";
    exit();
}

$id = $_POST['id'];
$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$username = $_SESSION['username']; 

// Fetch current user details
$query = "SELECT profile_photo FROM users WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$profile_photo = $user['profile_photo'];

// Handle Profile Picture Upload
if (!empty($_FILES['profile_photo']['name'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_photo"]["name"]);
    
    if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
        $profile_photo = $target_file;
    }
}

// Update user information
$query = "UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, profile_photo = :profile_photo WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
$stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
$stmt->bindParam(':profile_photo', $profile_photo, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo "Profile updated successfully!";
} else {
    echo "Error updating profile!";
}
?>
