<a class="btn btn-success mx-5" href="create_product.php">Thêm mới</a>

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
                <a href="edit_product.php?index=<?= $index ?>"><i class="fa-solid fa-pen-to-square text-primary"></i></a>
            </td>
            <td>
                <a href="?action=delete&index=<?= $index ?>" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash text-primary"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
   
    </tbody>
</table>