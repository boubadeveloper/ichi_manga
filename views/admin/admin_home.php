<?php include_once 'views/includes/admin_header.php'; ?>

<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-3">
        <div class="text-center text-white">
            <img class="logo-admin pb-2" src="public/uploads/avataaars.svg" alt="avatar de connexion" />
            <h2>Bienvenue sur le Tableau de bord</h2>
            <p>Choisissez l'une des options ci-dessous pour commencer la gestion.</p>
        </div>
    </div>
</header>
<div class="content py-5">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title text-uppercase">Gestion des Produits</h5>
                        <p class="card-text">Ajoutez, modifiez ou supprimez des produits.</p>
                        <a href="show_products" class="btn btn-outline-dark">Accéder</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title text-uppercase">Gestion des Utilisateurs</h5>
                        <p class="card-text">Gérez les utilisateurs de votre application.</p>
                        <a href="show_members" class="btn btn-outline-dark" target="_blank">Accéder</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title text-uppercase">Déconnexion</h5>
                        <p class="card-text">Se déconnecter de votre compte.</p>
                        <a href="index.php?action=logout_admin" class="btn btn-danger">Déconnexion</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'views/includes/admin_footer.php'; ?>
















