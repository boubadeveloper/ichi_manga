<?php
require_once("Database.php");

// AJOUTER UN PRODUIT
function addProduct($products)
{
    global $pdo;
    try {
        // Préparer la requête d'insertion
        $stmt = $pdo->prepare("INSERT INTO products (category, image, name, description, price, stock) VALUES (:category, :image, :name, :description, :price, :stock)");

        // Sécuriser les données du formulaire
        $category = htmlspecialchars(strip_tags($products['product_category']));
        $name = htmlspecialchars(strip_tags($products['product_name']));
        $description = htmlspecialchars(strip_tags($products['product_description']));
        $price = floatval($products['product_price']);
        $stock = intval($products['product_stock']);
        $image = $products['product_image'];

        // Liaison des paramètres
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);

        $stmt->execute();
        return $stmt->rowCount();

    } catch (PDOException $error) {
        throw new Exception('Erreur lors de l\'ajout du produit: ' . $error->getMessage());
    }
}


// AFFICHER TOUS LES PRODUITS

function getAllProducts()
{
    global $pdo;
    try {
        $stmt = $pdo->prepare('SELECT * FROM products');

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        throw new Exception('Erreur lors de la récupération de tous les produits : ' . $error->getMessage());
    }
}


// SUPPRIMER LE PRODUIT

function deleteProduct($productId)
{
    global $pdo;
    try {
        
        $stmt = $pdo->prepare('DELETE FROM products WHERE id = :id');

        $stmt->bindParam(':id', $productId);

        $stmt->execute();
        return $stmt->rowCount();

    } catch (PDOException $error) {
        throw new Exception('Erreur lors de la suppression du produits : ' . $error->getMessage());
    }
}

// MODIFICATION DU PRODUIT

function updateProduct($productId, $category, $image, $name, $description, $price, $stock) {
    global $pdo;
    try {
        // Préparation de la requête de mise à jour
        $stmt = $pdo->prepare("UPDATE products SET category = :category, image = :image, name = :name, description = :description, price = :price, stock = :stock WHERE id = :id");

        // Liaison des paramètres
        $stmt->bindParam(':id', $productId);                 // Associe l'ID du produit au paramètre :id
        $stmt->bindParam(':category', $category);             // Associe la catégorie du produit au paramètre :category
        $stmt->bindParam(':image', $image);                   // Associe l'image du produit au paramètre :image
        $stmt->bindParam(':name', $name);                     // Associe le nom du produit au paramètre :name
        $stmt->bindParam(':description', $description);       // Associe la description du produit au paramètre :description
        $stmt->bindParam(':price', $price);                   // Associe le prix du produit au paramètre :price
        $stmt->bindParam(':stock', $stock);                   // Associe le stock du produit au paramètre :stock

        // Exécution de la requête
        $stmt->execute();

        return true;
    } catch (PDOException $error) {
        return false;
    }
   
}

function getProductById($pdo, $productId) {
    try {
        // Préparation de la requête SQL pour récupérer les détails du produit avec l'identifiant spécifié
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
        // Liaison du paramètre :id à la valeur de $productId
        $stmt->bindParam(':id', $productId);
        // Exécution de la requête
        $stmt->execute();
        // Récupération du résultat sous forme de tableau associatif
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        // Retourner le produit ou null s'il n'existe pas
        return $product;
    } catch (PDOException $error) {
        // Gérer les erreurs de requête SQL
        throw new Exception("Erreur lors de la récupération du produit : " . $error->getMessage());
    }
}





    


// DANS LE FRONT END AFFICHER LES CATEGORIES

function get_product_categories() {
    
    global $pdo;
    $categoriesStmt = $pdo->query("SELECT DISTINCT category FROM products");

  
    $categories = $categoriesStmt->fetchAll(PDO::FETCH_ASSOC);

    return $categories;
}
