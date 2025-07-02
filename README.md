# 💼 HR-Interect: HR Management System

HR-Interect is a comprehensive web-based Human Resource Management System (HRMS) designed to streamline HR operations including employee records, attendance tracking, payroll management, and leave requests. Built with **PHP**, **MySQL**, **JavaScript**, **HTML**, and **CSS**, this project provides separate interfaces for administrators and employees.

---

## ✨ Features

- 👥 Employee Registration and Management
- 📅 Attendance Tracking System
- 📝 Leave and Permission Requests
- 💰 Payroll and Salary Management
- 🔐 Secure Login with Password Recovery
- 📊 Admin Dashboard with Stats and Controls
- 📂 Role-Based Access for Admins and Employees

---

## 🛠️ Technologies Used

| Layer        | Stack                          |
|--------------|--------------------------------|
| Frontend     | HTML, CSS (`Style`, `E_Style`), JavaScript (`script.js`) |
| Backend      | PHP (Core PHP Scripts)         |
| Database     | MySQL (`hrms.sql`)             |
| Assets       | Bootstrap (in `vendor` folder), PNG icons for UI |

---

## ⚙️ Installation Guide

### 📌 Requirements

- PHP 7.2 or higher
- MySQL or MariaDB
- Web Server (XAMPP/WAMP/LAMP recommended)

### 🧑‍💻 Setup Steps

#### 1. Move Files to Server Directory

- Copy all contents from the `Clones/` folder.
- Paste them into your local server directory (e.g., `htdocs/` if you're using XAMPP).

#### 2. Import the Database

- Open **phpMyAdmin** in your browser.
- Create a new database named:  
  ```sql
  hrms
Click on the new database and go to the Import tab.

Choose the file hrms.sql from the project directory.

Click Go to import the database structure and data.

3. Configure the Database Connection
Open the file config.php in a code editor.

Update the MySQL connection variables as shown below:


$host = 'localhost';

$username = 'root';

$password = '';

$database = 'hrms';

4. Start Server and Access the App
Start Apache and MySQL from your local server tool (XAMPP, WAMP, etc.).

Open your browser and visit: 
http://localhost/index.php
