<?php
session_start();
include('db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['username'])) {
    $username = "Guest";
    $full_name = "Guest User";
    $profile_image = "default-profile.png"; // Default profile image
} else {
    $username = $_SESSION['username'];

    // Fetch first_name, last_name, and profile_photo from the database
    $query = "SELECT first_name, last_name, profile_photo FROM users WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Combine first_name and last_name
    $full_name = isset($result['first_name']) && isset($result['last_name']) 
        ? $result['first_name'] . " " . $result['last_name'] 
        : "User";

    // Set profile image from database if available
    $profile_image = isset($result['profile_photo']) && !empty($result['profile_photo']) 
        ? $result['profile_photo'] 
        : "default-profile.png"; // Default image if none is set
}
?>

<header>
    <div class="header-container">
        <div class="logo">
            <a href="homepage.php">MyWebsite</a>
        </div>
        <nav class="navigation">
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <div class="user-profile">
            <div class="profile-info">
                <img src="<?php echo $profile_image; ?>" alt="Profile">
                <span class="username">@<?php echo $username; ?></span>
            </div>
            <div class="profile-dropdown">
                <img src="<?php echo $profile_image; ?>" alt="Profile">
                <p class="profile-name"><?php echo htmlspecialchars($full_name); ?></p>
                <button onclick="window.location.href='profile.php';">View Profile</button>
                <button onclick="window.location.href='logout.php';">Sign Out</button>
            </div>
        </div>
    </div>
</header>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    header {
        width: 100%;
        background: #333; /* Neutral background */
        padding: 15px 0;
        color: #fff;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 90%;
        margin: auto;
    }

    .logo a {
        font-size: 24px;
        font-weight: bold;
        text-decoration: none;
        color: #fff;
    }

    .navigation ul {
        list-style: none;
        display: flex;
    }

    .navigation ul li {
        margin: 0 15px;
    }

    .navigation ul li a {
        text-decoration: none;
        color: #fff;
        font-size: 18px;
    }

    .user-profile {
        position: relative;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .profile-info {
        display: flex;
        align-items: center;
        background: #fff;
        padding: 8px 12px;
        border-radius: 20px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .profile-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .username {
        font-weight: bold;
        font-size: 16px;
        color: #333;
    }

    .profile-dropdown {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 220px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        z-index: 10;
    }

    .profile-dropdown img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    .profile-name {
        color: #333;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .profile-dropdown button {
        margin-top: 10px;
        padding: 8px 12px;
        width: 100%;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    .profile-dropdown button:hover {
        background: #0056b3;
    }

    .user-profile:hover .profile-dropdown {
        display: block;
    }
</style>
