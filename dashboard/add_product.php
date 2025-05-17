<?php
session_start();
require_once '../includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if (empty($name) || empty($description)) {
        $error = "All fields are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO products (user_id, name, description) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $name, $description]);
        $success = "Product added successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h2>Add New Product</h2>
    <p><a href="index.php">← Back to Dashboard</a></p>

    <?php
    if (!empty($error)) echo "<p style='color:red;'>$error</p>";
    if (!empty($success)) echo "<p style='color:green;'>$success</p>";
    ?>

    <form method="POST">
        <label>Product Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" required></textarea><br><br>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>
