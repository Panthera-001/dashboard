<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

    <ul>
        <li><a href="add_product.php">Add Product</a></li>
        <li><a href="../products/products.php">View My Products</a></li>
        <li><a href="../auth/logout.php">Logout</a></li>
    </ul>
    <?php include '../includes/chatbot.php'; ?>

</body>
</html>
