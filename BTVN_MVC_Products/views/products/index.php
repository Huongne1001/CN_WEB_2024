<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
  
</head>
<body>
    <a class="btn btn-success mx-5" href="index.php?controller=product&action=create">Thêm mới</a>
    <table class="table mx-5">
        <thead>
            <tr>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Giá thành</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $index => $product): ?>
                <tr>
                    <th scope="row"><?= $product['name'] ?></th>
                    <td><?= $product['price'] ?></td>
                    <td>
                        <a href="index.php?controller=product&action=edit&id=<?= $product['id'] ?>"><i class="fa-solid fa-pen-to-square text-primary"></i></a>
                    </td>
                    <td>
                        <a href="index.php?controller=product&action=delete&id=<?= $product['id'] ?>" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash text-primary"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>