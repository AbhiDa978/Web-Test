<?php
ini_set('display_errors', 1);

if (!isset($_SESSION['username'])) {
    $username = "Guest";
    $profile_image = "default-profile.png";
} else {
    $username = $_SESSION['username'];
    $profile_image = "profile-images/" . $username . ".png";
}
?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    footer {
        width: 100%;
        background: #333;
        color: white;
        text-align: center;
        padding: 10px 0; 
        position: fixed;
        bottom: 0;
        left: 0;
    }

    .footer-social a {
        margin: 0 10px;
        display: inline-block;
    }

    .footer-bottom {
        margin-top: 5px; 
        font-size: 12px; 
    }

    .footer-social img {
        width: 25px; 
        height: 25px;
        transition: transform 0.3s;
    }

    .footer-social img:hover {
        transform: scale(1.1);
    }
</style>

<footer>
    <div class="footer-social">
        <a href="facebook.com"><img src="assets/fb.png" alt="Facebook"></a>
        <a href="x.com"><img src="assets/x.png" alt="Twitter"></a>
        <a href="instagram.com"><img src="assets/insta.png" alt="Instagram"></a>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 My Practical Exam. All rights reserved.</p>
    </div>
</footer>