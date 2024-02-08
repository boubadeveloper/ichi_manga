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
function getImage($imageData) {
    $name = $imageData['name'];
    $size = $imageData['size'];
    $error = $imageData['error'];

    $tabExtension = explode('.', $name);
    $extension = strtolower(end($tabExtension));
    $uploadDir = 'public/uploads/';

    $webpExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Extensions supportées pour la conversion en WebP
    $maxSize = 400000;

    // Vérification des conditions pour le téléchargement
    if (in_array($extension, $webpExtensions) && $size <= $maxSize && $error == 0){
        // Génération d'un nom unique pour le fichier
        $uniqueName = uniqid();
        
        // Création du fichier WebP
        if ($extension === 'jpg' || $extension === 'jpeg') {
            $image = imagecreatefromjpeg($imageData['tmp_name']);
        } elseif ($extension === 'png') {
            $image = imagecreatefrompng($imageData['tmp_name']);
        } elseif ($extension === 'gif') {
            $image = imagecreatefromgif($imageData['tmp_name']);
        }

        if ($image) {
            $webpFile = $uploadDir . $uniqueName . ".webp";
            if (imagewebp($image, $webpFile)) {
                // Libération de la mémoire
                imagedestroy($image);

                return $webpFile;
            } else {
                // Libération de la mémoire en cas d'échec
                imagedestroy($image);

                return false;
            }
        }
    }
    return false;
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

        // Initialisation du chemin de l'image à vide
        $image_path = "";

        // Vérification si un fichier d'image a été téléchargé
        if (!empty($_FILES["image"]["tmp_name"])) {
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
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
                // Gestion de l'erreur si le téléchargement échoue
                die("Erreur lors du téléchargement de l'image.");
            }
        } elseif (!empty($_POST["image_url"])) {
            // Utilisation de l'URL de l'image fournie
            $image_path = htmlspecialchars(strip_tags($_POST["image_url"]));
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

