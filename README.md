# comedhub

**ComedHub** is a platform for Computer Engineering students to access and share study materials like notes, previous year question papers, and project ideas—all in one convenient place.

## 🚀 Features

- 📚 Easy access to subject-wise notes
- 📝 Previous year question papers for better preparation
- 🤝 Community contributions to keep content updated

## 🛠️ Tech Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL

## 💻 Setup Instructions

Follow these steps to set up the project locally:

### 1. Clone the repository

```bash
git clone https://github.com/pramukhprajapati17/comedhub.git
cd comedhub
```

### 2. Start a local server

You can use **XAMPP**, **WAMP**, or any local PHP server:

- Place the `comedhub` folder inside your server's root directory:
  - For **XAMPP**, it's usually `C:\xampp\htdocs\`
  - For **WAMP**, it's `C:\wamp\www\`

### 3. Set up the database

- Open **phpMyAdmin**
- Create a new database (e.g., `comedhub`)
- Import the SQL file if provided (e.g., `comedhub.sql`) using phpMyAdmin

### 4. Configure database credentials

Update `index.php` or config file with your database credentials:

```php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'comedhub';
```

### 5. Run the project

- Open your browser and go to:  
  `http://localhost/comedhub/`

## 🤝 Contribution

Feel free to fork the repo, make improvements, and submit a pull request. Contributions are welcome!

Happy Learning! 💻📘
