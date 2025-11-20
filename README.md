# ParkSmart1 🚗🅿️

![Project Status](https://img.shields.io/badge/status-active-success)
![Language](https://img.shields.io/github/languages/top/smishra0606/ParkSmart1)
![License](https://img.shields.io/badge/license-MIT-blue)

**Innovative Parking Management Solution**

ParkSmart1 is a web-based application designed to streamline the process of finding and managing parking spaces. It aims to make parking easier, more cost-effective, and efficient for both administrators and users.

---

## 📖 Table of Contents
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Folder Structure](#-folder-structure)
- [Installation](#-installation)
- [Usage](#-usage)
- [Contributing](#-contributing)
- [Contact](#-contact)

---

## ✨ Features

- **User Authentication**: Secure login and registration system.
- **Password Recovery**: Includes `forgot_password.php` and `reset_password.php` for account recovery.
- **Dashboard**: User-friendly interface to view parking options.
- **Responsive Design**: Optimized for both desktop and mobile devices using custom CSS.
- **Data Management**: PHP-based backend to handle user sessions and database interactions.

---

## 🛠 Tech Stack

| Component | Technology |
|-----------|------------|
| **Frontend** | HTML5, CSS3, JavaScript |
| **Backend** | PHP (Vanilla) |
| **Database** | MySQL |
| **Server** | Apache (XAMPP/WAMP) |

---
🚀 Installation
Follow these steps to set up the project locally:

1. Prerequisites
Ensure you have a local server environment installed:

XAMPP (Recommended)

WAMP or MAMP

2. Clone the Repository
Open your terminal and run:

Bash

git clone [https://github.com/smishra0606/ParkSmart1.git](https://github.com/smishra0606/ParkSmart1.git)
3. Move to Server Directory
Move the ParkSmart1 folder to your server's root directory:

XAMPP: C:\xampp\htdocs\

WAMP: C:\wamp64\www\

4. Database Setup
Open phpMyAdmin (http://localhost/phpmyadmin).

Create a new database named parksmart_db (or similar).

Import the SQL file (if provided) or create a users table manually.

Configure the connection in includes/db_connect.php (or similar file):

PHP

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parksmart_db";
5. Run the Project
Open your browser and navigate to: http://localhost/ParkSmart1

🖥️ Usage
Sign Up: Register a new user account.

Log In: Access the main dashboard using your credentials.

Reset Password: If you forget your password, use the "Forgot Password" link on the login page.

🤝 Contributing
Contributions are strictly prohibited without prior approval, or purely for educational purposes. If you wish to contribute:

Fork the project.

Create your Feature Branch (git checkout -b feature/AmazingFeature).

Commit your Changes (git commit -m 'Add some AmazingFeature').

Push to the Branch (git push origin feature/AmazingFeature).

Open a Pull Request.

📧 Contact
Developer: smishra0606

Project Link: https://github.com/smishra0606/ParkSmart1

## 📂 Folder Structure

```text
ParkSmart1/
│
├── 📂 assets/               # Static assets for the UI
│   ├── 📂 css/              # Stylesheets
│   │   └── style.css        # Main stylesheet for the application
│   ├── 📂 js/               # JavaScript files
│   │   └── main.js          # Client-side logic (form validation, UI toggles)
│   └── 📂 img/              # Images and Icons
│       ├── logo.png         # Project logo
│       └── banner.jpg       # Landing page banner
│
├── 📂 includes/             # Reusable PHP fragments
│   ├── db_connect.php       # Database connection configuration
│   ├── header.php           # Navigation bar and HTML head
│   ├── footer.php           # Footer content and script tags
│   └── functions.php        # Helper functions (sanitization, auth checks)
│
├── 📂 pages/                # Core application views
│   ├── dashboard.php        # User dashboard (after login)
│   ├── register.php         # User registration form
│   └── profile.php          # User profile management
│
├── forgot_password.php      # Logic to handle "Forgot Password" requests
├── reset_password.php       # Logic to process password resets
├── index.php                # Landing page & Login entry point
└── README.md                # Project documentation

