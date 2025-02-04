<?php
error_reporting(E_ALL);
session_start();
include('db.php');

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    echo "<p style='text-align:center;'>Please <a href='index.php'>log in</a> to view your profile.</p>";
    exit();
}

$username = $_SESSION['username'];

// Fetch user details
$query = "SELECT id, username, first_name, last_name, email, phone, profile_photo FROM users WHERE username = :username";
$stmt = $conn->prepare($query);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<p style='text-align:center;'>User not found.</p>";
    exit();
}

$profilePicture = !empty($user['profile_photo']) ? $user['profile_photo'] : 'uploads/default-profile.png'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .profile-page {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            border-radius: 12px;
            background: linear-gradient(135deg, #ffffff, #e9eff5);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .profile-page img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 4px solid #4a90e2;
        }
        .profile-details {
            text-align: left;
            margin-top: 20px;
            background-color: #f8fbfd;
            padding: 15px;
            border-radius: 10px;
        }
        .profile-details p {
            margin: 10px 0;
            font-size: 16px;
            color: #34495e;
        }
        .profile-details strong {
            color: #2c3e50;
            display: inline-block;
            width: 120px;
        }
        .actions {
            margin-top: 20px;
        }
        button {
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            margin: 5px;
        }
        .edit-btn {
            background-color: #3498db;
            color: white;
        }
        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }
        .save-btn {
            background-color: #2ecc71;
            color: white;
        }
        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 60%;
            max-width: 600px;
            margin: 10% auto;
            text-align: left;
        }
        .modal-content h3 {
            text-align: center;
        }
        .modal-content form {
            display: flex;
            flex-direction: column;
        }
        .modal-content input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .close {
            float: right;
            cursor: pointer;
            font-size: 20px;
        }
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="profile-page">
    <img id="profile-img" src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture">
    <h2><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h2>
    <div class="profile-details">
        <p><strong>ID:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
    </div>
    <div class="actions">
        <button class="edit-btn" onclick="openModal()">Edit Info</button>
        <button class="delete-btn" onclick="deleteUser()">Delete Account</button>
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="edit-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3>Edit Profile</h3>
        <form id="edit-form" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <label>First Name</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
            <label>Last Name</label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <label>Phone</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            <label>Profile Picture</label>
            <input type="file" name="profile_photo">
            <button type="button" class="save-btn" onclick="updateProfile()">Save Changes</button>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>

<script>
    function openModal() {
        document.getElementById("edit-modal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("edit-modal").style.display = "none";
    }

    function updateProfile() {
        let formData = new FormData(document.getElementById("edit-form"));

        fetch("update_profile.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            if (!data.includes("Error")) {
                location.reload();
            }
        })
        .catch(error => console.error("Error updating profile:", error));
    }
    function deleteUser() {
    if (confirm("Are you sure you want to delete your account? This action cannot be undone!")) {
        fetch("delete_profile.php", {
            method: "POST",
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "success") {
                alert("Account deleted successfully.");
                window.location.href = "index.php"; 
            } else {
                alert(data);
            }
        })
        .catch(error => console.error("Error deleting account:", error));
    }
}
</script>

</body>
</html>
