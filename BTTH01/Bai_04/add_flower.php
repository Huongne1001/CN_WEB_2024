<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Thêm loài hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4">Thêm loài hoa mới</h1>
        <form action="index.php" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">
            <input type="hidden" name="action" value="add">
            
            <div class="mb-3">
                <label for="name" class="form-label">Tên hoa:</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả:</label>
                <textarea name="description" class="form-control" id="description" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Ảnh:</label>
                <input type="file" name="image" class="form-control" id="image" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>
</html>
