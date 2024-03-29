<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

// Logique de routage
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'home_page':
        require_once 'controllers/homeController.php';
        home_action();
        include_once 'views/client/home.php';
        break;
    case 'admin_home':
        include_once 'views/admin/admin_home.php';
        break;
    case 'show_products':
        require_once 'controllers/productController.php';
        render_products_product_getAll();
        break;
    case 'add_product':
        require_once 'controllers/productController.php';
        render_products_product_add();
        break;
    case 'delete_product':
        require_once 'controllers/productController.php';
        delete_product_action();
    case 'modify_product':
        require_once 'controllers/productController.php';
        modify_product_controller();
        
        break;
    case 'contact':
        include 'views/client/contact.php';
        break;
    default:
        header("Location: home_page");
        exit();
}
?>