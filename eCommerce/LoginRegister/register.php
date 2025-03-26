<?php
require 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username or email already exists
    $check_sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<p class='error-message'>Username or email already exists. Please choose another.</p>";
    } else {
        // Insert new user if username and email are unique
        $sql = "INSERT INTO users (title, first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $title, $first_name, $last_name, $username, $email, $hashed_password);

        if ($stmt->execute()) {
            header("Location: index.php"); // Redirect to login page after successful registration
            exit();
        } else {
            echo "<p class='error-message'>Error: " . $stmt->error . "</p>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../styles/registerStyles.css">
</head>
<body class="register-background">
    <div class="form-container">
        <h2>Register</h2>
        <form action="register.php" method="post">
            <select id="title" name="title" required>
                <option value="" disabled selected>Title</option>
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
                <option value="Ms">Ms</option>
                <option value="Dr">Dr</option>
            </select>
            
            <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
            <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="index.php">Log in here</a>.</p>
    </div>
</body>
</html>
