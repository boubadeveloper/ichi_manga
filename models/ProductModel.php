<?php
require_once("Database.php");

// AJOUTER UN PRODUIT
function addProduct($products)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO products (category_id, image, name, description, price, stock) VALUES (:category, :image, :name, :description, :price, :stock)");

        // Liaison des paramètres
        $stmt->bindParam(':category', $products['product_category']);
        $stmt->bindParam(':image', $products['product_image']);
        $stmt->bindParam(':name', $products['product_name']);
        $stmt->bindParam(':description', $products['product_description']);
        $stmt->bindParam(':price', $products['product_price']);
        $stmt->bindParam(':stock', $products['product_stock']);

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

function updateProduct($productId, $category, $image, $name, $description, $price, $stock)
{
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE products SET category_id = :category, image = :image, name = :name, description = :description, price = :price, stock = :stock WHERE id = :id");

        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':id', $productId);

        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $error) {
        throw new Exception('Erreur lors de la mise à jour du produit : ' . $error->getMessage());
    }
}

// DANS LE FRONT END AFFICHER LES CATEGORIES

function get_product_categories() {
    
    global $pdo;
    $categoriesStmt = $pdo->query("SELECT DISTINCT category_id FROM products");

  
    $categories = $categoriesStmt->fetchAll(PDO::FETCH_ASSOC);

    return $categories;
}
