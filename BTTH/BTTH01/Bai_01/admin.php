<?php include 'data.php'; ?>
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
    <h1>Quản trị danh sách các loài hoa</h1>
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
            <?php foreach ($flowers as $flower): ?>
                <tr>
                    <td><?php echo $flower['name']; ?></td>
                    <td><?php echo $flower['description']; ?></td>
                    <td><img src="<?php echo $flower['image']; ?>" width="100"></td>
                    <td>
                        <a href="edit_flower.php?name=<?php echo urlencode($flower['name']); ?>">Sửa</a> | 
                        <a href="delete_flower.php?name=<?php echo urlencode($flower['name']); ?>" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
