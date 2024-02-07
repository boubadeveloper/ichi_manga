<?php
include("models/ProductModel.php");


function render_products_product_getAll()
{
    global $pdo;
    $title = "Tous les produits | Ichi Manga";

    try {
        // if (!isset($_SESSION['admin'])) {
        //     // Rediriger vers la page de connexion admin
        //     header('Location: login_admin');
        //     exit();
        // }
        // // Vérifier la connexion PDO
        // if (!$pdo) {
        //     throw new Exception("Erreur de connexion à la base de données.");
        // }

        // Vérifier si l'utilisateur est authentifié en tant qu'administrateur

        // Récupérer tous les produits depuis la base de données
        $products = getAllProducts();

        // Inclure la vue pour afficher les produits
        include_once('views/admin/products.php');
    } catch (Exception $e) {
        // Gérer les erreurs
        echo "Une erreur s'est produite : " . $e->getMessage();
    }
}
