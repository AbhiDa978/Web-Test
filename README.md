 Web Application Programming Project 🎯💻🚀

 Overview 🌟📌🔍

This project is a PHP-based web application designed for user authentication, profile management, and CRUD operations. The system allows users to register, log in, update their profile details, and delete their account. The project is built using PHP, MySQL, HTML, CSS, and JavaScript with AJAX for dynamic updates. 🎨📊⚡

The key objectives of this project include:
- Implementing a secure user authentication system with session management. 🔒🛡️✅
- Providing an intuitive and user-friendly profile management interface. 👤📂🖱️
- Ensuring smooth navigation and optimized database interactions. 🚀🔄📊
- Adopting a responsive design for accessibility across different devices. 📱💻🖥️
- Utilizing AJAX to enhance user experience by updating data dynamically without requiring a page refresh. ⚡🔄🔗

 Features 🎯🔍✨

 1. User Authentication 🔑🛡️✅
- Secure login and logout using PHP sessions.
- User registration system with validation for email, phone, and username uniqueness.
- Passwords are securely hashed before storage for enhanced security.
- Redirects to `homepage.php` after successful login.
- Displays appropriate error messages for incorrect login credentials or missing information.
- Prevents access to protected pages unless the user is logged in.

 2. Profile Management 👤📂🖼️
- Displays user details, including first name, last name, email, phone, username, and profile picture.
- Users can update their profile information via a modal form for a seamless experience.
- Profile picture upload and update functionality with file validation.
- Only modified fields are updated in the database to optimize performance.
- Uses AJAX for smooth and instant profile updates without reloading the page.
- Users can delete their account permanently, removing all associated data.
- Securely fetches user details from the database using prepared statements to prevent SQL injection.

 3. CRUD Operations ✍️🗂️🛠️
- Create: Users can register and create a profile.
- Read: Profile information is retrieved securely using prepared statements.
- Update: Users can edit and update their details in the profile section.
- Delete: Users can remove their account permanently via `delete_profile.php`.

 4. Database Integration 🗄️🔗🔍
- Uses MySQL to store user details efficiently.
- Employs prepared statements to prevent SQL injection and unauthorized data access.
- Profile pictures are stored in the `uploads/` directory, with file paths referenced in the database.
- Implements foreign key constraints where necessary for data integrity.

 5. Responsive Design 📱💻🖥️
- The website is accessible on desktops, tablets, and mobile devices.
- CSS ensures a clean and structured layout, enhancing readability and usability.
- Elements adjust dynamically to different screen sizes, providing a consistent user experience.

 File Structure 📁📌📜

```
WebApplicationProgramming/
│── index.php (Login & Registration Page)
│── homepage.php (Main Page after Login)
│── profile.php (User Profile Page)
│── update_profile.php (Handles Profile Updates)
│── delete_profile.php (Handles Account Deletion)
│── db.php (Database Connection File)
│── header.php (Navigation Bar)
│── footer.php (Footer with Social Links)
│── uploads/ (Stores User Profile Pictures)
│── assets/ (Contains Static Images)
│── README.md (This File)
```

 Database Schema 🛢️📊🔍

The application uses a `users` table to store user information:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL,
    profile_photo VARCHAR(255) DEFAULT 'uploads/default-profile.png'
);
```

 Installation & Setup 🔧📦🛠️

 1. Install XAMPP 🖥️🔥🐘
- Download and install XAMPP from [https://www.apachefriends.org](https://www.apachefriends.org).
- Start the Apache and MySQL services from the XAMPP control panel.

 2. Project Setup 📁⚙️🚀
- Place the `WebApplicationProgramming` folder inside `htdocs`.
- Open phpMyAdmin and create a new database (e.g., `webapp_db`).
- Import `database.sql` into the newly created database.
- Configure `db.php` with your database credentials.
- Open the browser and navigate to: `http://localhost/WebApplicationProgramming/index.php`.

 Pages and Functionality 📄⚙️🖱️

 1. index.php (Login & Registration Page) 🔑👤✅
- Users can log in using their email or username.
- New users can register with first name, last name, email, phone, and password.
- Passwords are securely hashed before being stored in the database.
- Error messages are displayed for incorrect credentials or missing information.
- Redirects to `homepage.php` on successful login.
- Uses session management to maintain user authentication status.

 2. homepage.php (Main Page After Login) 🏠📜📌
- Displays a welcome message and basic user details.
- Provides navigation links to the profile page and logout functionality.

 3. profile.php (User Profile Page) 👤📄🖼️
- Shows user details including profile picture.
- Users can update their information using a modal form for a seamless experience.
- AJAX is used to update profile information dynamically without reloading the page.
- Users can delete their account permanently.

 4. update_profile.php (Handles Profile Updates) 📝🔄✅
- Processes profile updates sent via AJAX.
- Ensures only changed values are updated in the database for efficiency.
- Handles profile picture uploads and replacements with validation for file types and size limits.

 5. delete_profile.php (Handles Account Deletion) 🗑️🔒🚀
- Deletes all user data from the database upon request.
- Uses AJAX for a smooth account deletion process without unnecessary reloads.
- Redirects users to `index.php` after deletion.

 6. logout.php 🔓👋🚪
- Ends the user session securely and redirects to the login page.

 Troubleshooting 🛠️⚡🔍

- Database Connection Issues:
  - Ensure MySQL is running in XAMPP.
  - Verify `db.php` contains the correct database credentials.

- JavaScript Errors:
  - Check the browser console (`F12 > Console` in Chrome) for error messages.
  - Ensure JavaScript files are correctly linked in HTML.

- PHP Debugging:
  - Enable error reporting for debugging purposes:

```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

 Future Improvements 🚀💡🔮
- Implement password reset functionality via email verification.
- Enhance UI with a modern CSS framework like Bootstrap.
- Introduce two-factor authentication for additional security.
- Optimize database queries for better performance.
- Develop an admin panel for user management.

 Author ✍️👨‍💻📖
- Abhishek Dahal (0355408)
- Course: Web Applications Programming (ITS64504)

 License 📜⚖️🔍
This project is for educational purposes only.

