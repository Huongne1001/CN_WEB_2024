<?php
include 'db.php'; 

if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $targetDir = "images/";
    $imageName = basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $imageName;

    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false || $_FILES["image"]["size"] > 5000000 || !in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Lỗi: Ảnh không hợp lệ.";
    } elseif (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $sql = "INSERT INTO flowers (name, description, image_path) VALUES ('$name', '$description', '$targetFile')";
        $conn->query($sql);
        header('Location: index.php');
    } else {
        echo "Lỗi khi upload ảnh.";
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $imagePath = $_POST['current_image'];

    if (!empty($_FILES["image"]["name"])) {
        $targetDir = "images/";
        $imageName = basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $imageName;

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false && $_FILES["image"]["size"] <= 5000000 && in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $imagePath = $targetFile;
            }
        }
    }

    $sql = "UPDATE flowers SET name='$name', description='$description', image_path='$imagePath' WHERE id=$id";
    $conn->query($sql);
    header('Location: index.php');
}

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'];
    $sql = "DELETE FROM flowers WHERE id=$id";
    $conn->query($sql);
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản trị danh sách hoa</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <h2>Bài 2: Upload questions</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="txtfile" accept=".txt">
        <button type="submit">Tải Lên</button>
    </form>


    <h2>Bài 3: Upload accounts</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="csvfile" accept=".csv">
        <button type="submit">Tải Lên</button>
    </form>

    <h1>Bài 1: Quản trị danh sách các loài hoa</h1>
    <a href="add_flower.php">Thêm loài hoa mới</a>
    <table>
        <thead>
            <tr>
                <th>Tên hoa</th>
                <th>Mô tả</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM flowers";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['description']}</td>";
                    echo "<td><img src='{$row['image_path']}' width='100'></td>";
                    echo "<td>
                            <a href='edit_flower.php?id={$row['id']}'>Sửa</a> | 
                            <a href='index.php?action=delete&id={$row['id']}' onclick=\"return confirm('Bạn có chắc muốn xóa?');\">Xóa</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Không có dữ liệu.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
