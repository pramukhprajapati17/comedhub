# ComedHub 📚

ComedHub is an academic resource management web application that helps students and faculty efficiently access, share, and manage course-related files like syllabus, notes, and other educational materials.

## 🚀 Features

- 📂 Upload and organize files by semester, subject, and topic
- 🔍 Search and filter files easily
- 🔐 Admin and student login system
- 📥 Access shared Google Drive file links
- 🕒 Track file upload timestamps
- 🎓 Student information management

## 🛠️ Tech Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL

## 🗃️ Database Setup

Create the database using the following SQL:

CREATE DATABASE IF NOT EXISTS compedhub;
USE compedhub;

CREATE TABLE files (
    sem INT,
    code INT,
    subject VARCHAR(50),
    foldname VARCHAR(50),
    fname VARCHAR(50),
    ftype VARCHAR(10),
    flink TEXT,
    time DATETIME
);

CREATE TABLE admin (
    uname VARCHAR(50),
    password VARCHAR(50)
);

CREATE TABLE students (
    email VARCHAR(100),
    fname VARCHAR(50),
    lname VARCHAR(50),
    enrollment VARCHAR(20),
    sem INT,
    course VARCHAR(50),
    college VARCHAR(50),
    university VARCHAR(50),
    city VARCHAR(50),
    mobile VARCHAR(15),
    password VARCHAR(50),
    time DATETIME
);


## 🔌 Database Connection

Modify a file named `connection.php` in your root directory as per your requirements.

**Usage:**
Include this file in any PHP script where you want to connect to the database:



## 📦 Installation & Usage

1. **Clone the repository:**

   bash
   git clone https://github.com/pramukhprajapati17/comedhub.git
   cd comedhub

2. **Import the Database:**

   * Create a database named `compedhub`.
   * Use the SQL above or import `setup.sql` via phpMyAdmin or MySQL Workbench.

3. **Configure Database:**

   * Add the above `connection.php` file in your root folder.
   * Make sure credentials match your local setup.

4. **Run the Project:**

   * Move the project to your XAMPP/WAMP `htdocs` or `www` directory.
   * Start Apache and MySQL.
   * Access it at: `http://localhost/comedhub/`

## 🔐 Admin Login

> You must manually insert admin credentials in the `admin` table or add a registration form.

## 📧 Contact

**Developer:** Pramukh Prajapati
**Email:** [pramukhprajapati17@gmail.com](mailto:pramukhprajapati17@gmail.com)
**GitHub:** [pramukhprajapati17](https://github.com/pramukhprajapati17)

> “Knowledge increases by sharing but not by saving.”