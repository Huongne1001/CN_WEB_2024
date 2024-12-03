<?php
require_once 'models/Product.php';

class ProductController
{
    // Display a list of products
    public function index()
    {
        $products = Product::getAll();
        require 'views/products/index.php';
    }

    // Display the product creation form
    public function create()
    {
        require 'views/products/create.php';
    }

    // Store a newly created product in the database
    public function store()
    {
        $name = $_POST['name'];
        $price = $_POST['price'];

        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);
        $product->save();

        header('Location: index.php?controller=product&action=index');
    }

    // Display the product editing form
    public function edit()
    {
        $id = $_GET['id'];
        $product = Product::getById($id);
        require 'views/products/edit.php';
    }

    // Update the specified product in the database
    public function update()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
    
        $product = new Product();
        
        $product->setId($id);
        $product->setName($name);
        $product->setPrice($price);
    
        $product->update();
        header('Location: index.php?controller=product&action=index');
    }

    // Delete the specified product from the database
    public function delete()
    {
        $id = $_GET['id'];
        $product = new Product();
    
        if ($product->delete($id)) {
            header('Location: index.php?controller=product&action=index');
        } else {
            echo "Xóa sản phẩm thất bại.";
        }
    }      
}
?>
