<?php
session_start();

// Đọc danh sách sản phẩm từ cookie
$products = isset($_COOKIE['products']) ? json_decode($_COOKIE['products'], true) : [];
$index = isset($_GET['index']) ? $_GET['index'] : -1;

if ($index === -1 || !isset($products[$index])) {
    header('Location: index.php');
    exit;
}

$product = $products[$index];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <form method="POST" action="index.php" class="mx-5 mt-5">
        <h1>Sửa sản phẩm</h1>
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="index" value="<?= $index ?>">
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Tên sản phẩm</label>
            <input type="text" value="<?= htmlspecialchars($product['name']) ?>" name="name" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Giá</label>
            <input type="text" value="<?= htmlspecialchars($product['price']) ?>" name="price" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a class="btn btn-danger" href="index.php">Cancel</a>
    </form>
</body>
</html>
