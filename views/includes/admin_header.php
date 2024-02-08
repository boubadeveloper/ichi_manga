<?php 
$title = $title ?? "Ichi Manga";
$desc = $desc ?? "Bienvenue sur Ichi-manga STORE, votre source ultime pour les figurines, cartes et goodies. Découvrez nos collections uniques";
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $desc; ?>">
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/main.css">

    <title><?= $title; ?></title>
</head>

<body>

    <nav class="navbar navbar-expand-sm navbar-white bg-white shadow-sm">
        <div class="container-fluid d-flex flex-column">
            <div class="row w-100 nav-top">
                <div class="col-12 d-flex align-items-center">
                    <a class="navbar-brand" href="./index.php">
                        <img src="public/uploads/logo-ichimanga.webp" alt="Logo"
                            class="d-inline-block align-top logo" />
                    </a>
                    <div class="d-flex ms-auto icons-navigation align-items-center">
                        <a class="icon" id="btn-search" href="#"><ion-icon name="search"></ion-icon></a>
                        <a class="icon" id="btn-search"
                            href="<?php echo isset($_SESSION['admin']) ? 'logout_admin' : 'login_admin'; ?>"
                            title="<?php echo isset($_SESSION['admin']) ? 'Se déconnecter' : 'Se connecter en tant qu\'administrateur'; ?>">
                            <ion-icon
                                name="<?php echo isset($_SESSION['admin']) ? 'lock-closed' : 'person'; ?>"></ion-icon>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row w-100 nav-bottom">
                <button class="navbar-toggler border-0 " type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse order-lg-1" id="navbarNav">
                    <ul class="navbar-nav ms-auto me-auto text-center text-uppercase">
                        <li class="nav-item px-1 py-1">
                            <a class="nav-link small" href="admin_home">Tableau de bord</a>
                        </li>
                        <li class="nav-item px-1 py-1">
                            <a class="nav-link small" href="show_members">Gestions Utilisateurs</a>
                        </li>
                        <li class="nav-item px-1 py-1">
                            <a class="nav-link small" href="show_products">Gestions Produits</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

</body>

</html>
