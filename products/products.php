<?php
session_start();
require_once '../includes/db.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch user's products
$stmt = $conn->prepare("SELECT * FROM products WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Products</title>
</head>
<body>
    <h2>My Products</h2>
    <p><a href="../dashboard/index.php">← Back to Dashboard</a></p>

    <?php if (empty($products)): ?>
        <p>You haven't added any products yet.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($products as $product): ?>
                <li>
                    <strong><?php echo htmlspecialchars($product['name']); ?></strong><br>
                    <?php echo nl2br(htmlspecialchars($product['description'])); ?><br>
                    <small>Added on: <?php echo $product['created_at']; ?></small>
                </li>
                <hr>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
