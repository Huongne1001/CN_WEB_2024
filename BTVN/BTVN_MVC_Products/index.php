<?php
include_once 'config.php';
include_once 'header.php';
include_once 'footer.php';

// Get the controller and action from the URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'product'; // Get tham số controller từ URL
$action = isset($_GET['action']) ? $_GET['action'] : 'index'; // Get tham số action từ URL

// Create the controller class name
$controllerClass = ucfirst($controller) . 'Controller'; // ProductController

// Instantiate the controller
$controllerFile = "controllers/$controllerClass.php"; // controllers/ProductController.php
if (file_exists($controllerFile)) {
    include_once $controllerFile;
    $controllerInstance = new $controllerClass(); // $controllerInstance = new ProductController()
    $controllerInstance->$action(); // ProductController->index()
} else {
    echo "Controller not found.";
}
?>
