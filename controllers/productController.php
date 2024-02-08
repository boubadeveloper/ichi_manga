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

// Fonction pour télécharger l'image

function getImage($imageData, $imageUrl) {
    $uploadDir = 'public/uploads/';

    // Si une image est téléchargée
    if (!empty($imageData["tmp_name"])) {
        $name = $imageData['name'];
        $size = $imageData['size'];
        $error = $imageData['error'];

        $tabExtension = explode('.', $name);
        $extension = strtolower(end($tabExtension));

        $webpExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $maxSize = 400000;

        // Vérification des conditions pour le téléchargement
        if (in_array($extension, $webpExtensions) && $size <= $maxSize && $error == 0) {
            $uniqueName = uniqid();

            $image = null;
            if ($extension === 'jpg' || $extension === 'jpeg') {
                $image = @imagecreatefromjpeg($imageData['tmp_name']); // Supprimer le message d'erreur PHP
            } elseif ($extension === 'png') {
                $image = @imagecreatefrompng($imageData['tmp_name']); // Supprimer le message d'erreur PHP
            } elseif ($extension === 'gif') {
                $image = @imagecreatefromgif($imageData['tmp_name']); // Supprimer le message d'erreur PHP
            }

            if ($image) {
                $webpFile = $uploadDir . $uniqueName . ".webp";
                if (@imagewebp($image, $webpFile)) { // Supprimer le message d'erreur PHP
                    imagedestroy($image);
                    return $webpFile;
                } else {
                    imagedestroy($image);
                    return false;
                }
            } else {
                return "Erreur lors de la création de l'image à partir du fichier.";
            }
        } else {
            return "Conditions pour le téléchargement non remplies.";
        }
    } elseif (!empty($imageUrl)) {
        // Si une URL d'image est fournie
        $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Vérification de l'extension de l'URL de l'image
        if (in_array($extension, $allowedExtensions)) {
            // Téléchargement de l'image depuis l'URL
            $image = file_get_contents($imageUrl);
            if ($image !== false) {
                $uniqueName = uniqid();
                $webpFile = $uploadDir . $uniqueName . ".webp";
                if (file_put_contents($webpFile, $image) !== false) {
                    return $webpFile;
                } else {
                    return "Erreur lors de l'écriture du fichier WebP.";
                }
            } else {
                return "Erreur lors du téléchargement de l'image depuis l'URL.";
            }
        } else {
            return "Extension de l'URL de l'image non valide.";
        }
    } else {
        return "Aucune image ni URL d'image fournies.";
    }

  
}


function render_products_product_add()
{
    global $pdo;

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_product"])) {
        
        // Vérification de la présence des données requises
        $required_fields = ["category", "name", "description", "price", "stock"];

        // Sécurisation des données du formulaire
        $category = htmlspecialchars(strip_tags($_POST["category"]));
        $name = htmlspecialchars(strip_tags($_POST["name"]));
        $description = htmlspecialchars(strip_tags($_POST["description"]));
        $price = floatval($_POST["price"]);
        $stock = intval($_POST["stock"]);

        // Récupération de l'image convertie en WebP
        $image_path = getImage($_FILES["image"], $_POST["image_url"]);

        // Vérification si un fichier d'image a été téléchargé et converti en WebP
        if ($image_path === false) {
            // Gestion de l'erreur si le traitement de l'image échoue
            die("Erreur lors du traitement de l'image.");
        }
        
        // Appel de la fonction addProduct() avec les données correctes
        try {
            addProduct([
                'product_category' => $category,
                'product_image' => $image_path,
                'product_name' => $name,
                'product_description' => $description,
                'product_price' => $price,
                'product_stock' => $stock
            ]);
            $_SESSION['confirmation_message'] = "Le produit a été ajouté avec succès.";
            $_SESSION['confirmation_time'] = time(); // Enregistrer l'heure actuelle
            // Redirection vers la page show_products après l'ajout réussi
            header('Location: show_products');
            exit(); // Assure que le script s'arrête après la redirection
        } catch (Exception $e) {
            // Affichage d'un message d'erreur
            echo "Erreur lors de l'ajout du produit : " . $e->getMessage();
        }
    }

    // Inclusion de la vue pour afficher le formulaire
    include('views/admin/add_product.php');
}

function delete_product_action()
{
    global $pdo; // Accéder à la variable $pdo globalement

    if (isset($_GET['id'])) {
        $productId = $_GET['id'];
        $_SESSION['confirmation_message'] = "Le produit a été supprimé avec succès.";
        $_SESSION['confirmation_time'] = time(); // Enregistrer l'heure actuelle
        deleteProduct($productId);
        
        header('Location: show_products');
        exit();
    } else {
        echo "L'ID du produit à supprimer n'est pas spécifié.";
    }
}

// Vérifie et supprime le message de confirmation après un certain temps
function check_confirmation_message()
{
    if (isset($_SESSION['confirmation_message'])) {
        // Récupérer le temps où le message a été affiché
        $confirmation_time = isset($_SESSION['confirmation_time']) ? $_SESSION['confirmation_time'] : 0;
        
        // Définir la durée pendant laquelle le message reste affiché (en secondes)
        $confirmation_duration = 5; // Par exemple, 5 secondes
        
        // Vérifier si la durée écoulée dépasse la durée maximale
        if (time() - $confirmation_time > $confirmation_duration) {
            unset($_SESSION['confirmation_message']);
            unset($_SESSION['confirmation_time']);
        }
    }
}



function modify_product_controller()
{
    global $pdo;

    try {
        // Vérifier si l'identifiant du produit est spécifié dans l'URL
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
            // Récupérer les détails du produit à partir de son identifiant
            $product = getProductById($pdo, $productId);
            // Vérifier si le produit existe
            if (!$product) {
                echo "Le produit spécifié n'existe pas.";
                return;
            }

            // Traitement de la soumission du formulaire de modification
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["modify_product"])) {
                handle_product_modification($pdo, $product);
            }

            // Afficher le formulaire de modification avec les détails du produit
            include('views/admin/modify_product.php');
        } else {
            echo "Identifiant du produit non spécifié.";
        }
    } catch (Exception $e) {
        echo "Une erreur s'est produite : " . $e->getMessage();
    }
}

function handle_product_modification($pdo, $product) {
    // Vérification de la présence des données requises
    $required_fields = ["id", "category", "name", "description", "price", "stock"];

    // Sécurisation des données du formulaire
    $id = intval($_POST["id"]);
    $category = htmlspecialchars(strip_tags($_POST["category"]));
    $name = htmlspecialchars(strip_tags($_POST["name"]));
    $description = html_entity_decode($_POST["description"]);
    $price = floatval($_POST["price"]);
    $stock = intval($_POST["stock"]);

    // Initialisation du chemin de l'image à vide
    $image_path = "";

    // Traitement de l'image du produit
    if (!empty($_FILES["image"]["tmp_name"])) {
        $image_path = handle_uploaded_image($_FILES["image"]);
    } elseif (!empty($_POST["image_url"])) {
        $image_path = htmlspecialchars(strip_tags($_POST["image_url"]));
    }

    // Appel de la fonction updateProduct() avec les données correctes
    updateProduct($id, $category, $image_path, $name, $description, $price, $stock);
    $_SESSION['confirmation_message'] = "Le produit a été modifié avec succès.";
    $_SESSION['confirmation_time'] = time(); // Enregistrer l'heure actuelle
    // Redirection vers la page show_products après la modification réussie
    header('Location: show_products');
    exit(); // Assure que le script s'arrête après la redirection
}

function handle_uploaded_image($image) {
    // Chemin du répertoire "uploads/"
    $uploadDir = 'public/uploads/';
    // Vérification si le répertoire "uploads/" existe, sinon le créer
    if (!file_exists($uploadDir) && !is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    // Génération d'un nom de fichier unique
    $image_name = uniqid('image_') . '.jpg';
    // Définition du chemin complet du fichier téléchargé
    $image_path = $uploadDir . $image_name;
    // Déplacement du fichier téléchargé vers le répertoire "public/uploads/"
    if (!move_uploaded_file($image["tmp_name"], $image_path)) {
        // Gestion de l'erreur si le téléchargement échoue
        die("Erreur lors du téléchargement de l'image.");
    }
    return $image_path;
}
?>
