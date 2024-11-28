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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4">Quản trị danh sách các loài hoa</h1>
        <a href="add_flower.php" class="btn btn-primary mb-3">Thêm loài hoa mới</a>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th class="col-md-2">Tên hoa</th>
                        <th class="col-md-7">Mô tả</th>
                        <th class="col-md-2">Ảnh</th>
                        <th class="col-md-1">Hành động</th>
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
                            echo "<td><img src='{$row['image_path']}' class='img-thumbnail' width='100'></td>";
                            echo "<td>
                                    <a href='edit_flower.php?id={$row['id']}' class='btn btn-warning btn-sm'>Sửa</a>
                                    <a href='index.php?action=delete&id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Bạn có chắc muốn xóa?');\">Xóa</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>Không có dữ liệu.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
