<?php

include("models/ProductModel.php");

function render_home_page($categories) {
    global $pdo;
    $title = "Page d'accueil | Ichi Manga";
    $products = getAllProducts();
    
    include('views/client/home.php');
}

function home_action() {
    global $pdo;
    
    $categories = get_product_categories();
   
   
    render_home_page($categories);
}
