<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Web Application</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php include('header.php'); ?> 

    <div class="container">
        <h1>Welcome to the <span class="highlight">PHP User Management System</span></h1>
        <p class="intro-text">An intuitive and efficient web application built with PHP, MySQL, JavaScript, and HTML5.</p>

        <div class="feature-box">
            <h2>✨ Key Features ✨</h2>
            <ul class="feature-list">
                <li>🔐 <strong>Secure Authentication</strong> – Signup & Login with encrypted passwords</li>
                <li>📝 <strong>Profile Management</strong> – Update personal details and profile picture</li>
                <li>📊 <strong>SQL Database Integration</strong> – Store and retrieve user data seamlessly</li>
                <li>📱 <strong>Responsive Design</strong> – Optimized for all devices</li>
            </ul>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            margin: 50px auto;
            padding: 30px;
            max-width: 700px;
            background: white;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            border-radius: 12px;
            text-align: center;
        }
        h1 {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .highlight {
            color: #3498db;
            font-weight: bold;
        }
        .intro-text {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }
        .feature-box {
            background: #ecf0f1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .feature-box h2 {
            color: #34495e;
            margin-bottom: 15px;
            font-size: 22px;
        }
        .feature-list {
            text-align: left;
            display: inline-block;
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .feature-list li {
            font-size: 16px;
            color: #2c3e50;
            margin: 10px 0;
        }
        strong {
            color: #e74c3c;
        }
    </style>

</body>
</html>
