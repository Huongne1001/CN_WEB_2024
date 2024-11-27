<?php
// Bắt đầu session nếu cần
session_start();

// Đọc danh sách sản phẩm từ cookie
$products = isset($_COOKIE['products']) ? json_decode($_COOKIE['products'], true) : [];

// Hàm lưu danh sách sản phẩm vào cookie
function saveProductsToCookie($products) {
    setcookie('products', json_encode($products), time() + (86400 * 30), "/"); // Lưu trong 30 ngày
}

// Thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $products[] = ['name' => $name, 'price' => $price];
    saveProductsToCookie($products);
    header('Location: index.php');
    exit;
}

// Xóa sản phẩm
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['index'])) {
    $index = $_GET['index'];
    if (isset($products[$index])) {
        array_splice($products, $index, 1);
        saveProductsToCookie($products);
    }
    header('Location: index.php');
    exit;
}

// Sửa sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $index = $_POST['index'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    if (isset($products[$index])) {
        $products[$index] = ['name' => $name, 'price' => $price];
        saveProductsToCookie($products);
    }
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <?php include_once("header.php") ?>
</head>
<body>
    <?php include_once("main.php"); ?>
</body>
<?php include_once("footer.php") ?>
</html>