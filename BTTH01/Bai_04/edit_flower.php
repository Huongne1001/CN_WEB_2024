<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM flowers WHERE id=$id";
$result = $conn->query($sql);
$flower = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa thông tin hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4">Sửa thông tin hoa</h1>
        <form action="index.php" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo $flower['id']; ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Tên hoa:</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo $flower['name']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả:</label>
                <textarea name="description" class="form-control" id="description" rows="4" required><?php echo $flower['description']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="current_image_preview" class="form-label">Ảnh hiện tại:</label><br>
                <img id="image_preview" src="<?= $flower['image_path'] ?>" alt="Ảnh hiện tại" class="img-thumbnail mb-3" style="max-width: 150px; max-height: 150px;">
                <input type="file" id="image" name="image" class="form-control" accept="image/*" onchange="previewNewImage(event)">
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="index.php" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
</body>
</html>

<script>
function previewNewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('image_preview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}
</script>
