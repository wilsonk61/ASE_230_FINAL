<?php
require_once('../../lib/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;

    $stmt = $pdo->prepare("INSERT INTO user (first_name, last_name, email, password, isAdmin) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$firstName, $lastName, $email, $password, $isAdmin]);

    header('Location: adminview.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 style="text-align: center; margin-bottom: 20px;">Create User</h3>
        <form method="POST">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" placeholder="Enter first name" required>
            
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" placeholder="Enter last name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter email address" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>
            
            <label for="isAdmin">Admin:</label>
            <input type="checkbox" id="isAdmin" name="isAdmin">
            
            <button type="submit">Create User</button>
        </form>
        <a href="adminview.php" class="back-link">Back to Admin View</a>
    </div>
</body>
</html>

