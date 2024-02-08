<?php include_once 'views/includes/admin_header.php'; ?>

<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <img src="../../../public/images/logo-ichimanga.webp" alt="" id="logo-ichimanga">
            <h1 class="display-6 text-uppercase">- Liste des produits - </h1>
            <div class="container bg-dark text-white d-flex justify-content-center align-items-center rounded mx-auto mt-2"
                id="d-flex-center">
                <a class="btn btn-sm bg-danger text-white" href="add_product" id="add-product-btn">
                    Ajouter un produit
                </a>
            </div>
        </div>
    </div>
</header>

<?php if (!empty($products)): ?>


    <div class="content py-5">
        <div class="container mt-5 p-0 mb-5 ">
            <div class="table-responsive">
                <table class="table table-hover shadow-sm table-bordered text-center">
                    
                    <?php if (isset($_SESSION['confirmation_message'])): ?>
                        <div id="confirmation-message" class="alert alert-success container confirmation-message" role="alert" >
                            <?= $_SESSION['confirmation_message']; ?>
                        </div>
                        <?php unset($_SESSION['confirmation_message']); ?>
                    <?php endif; ?>
                    
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Image</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Description</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Modifier</th>
                            <th scope="col">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td>
                                    <?= $product['id']; ?>
                                </td>
                                <td>
                                    <?= $product['category']; ?>
                                </td>
                                <td><img src="<?= $product['image']; ?>" alt="Product Image" class="product-image"></td>
                                <td>
                                    <?= $product['name']; ?>
                                </td>
                                <td>
                                    <?= $product['description']; ?>
                                </td>
                                <td>
                                    <?= $product['price']; ?>
                                </td>
                                <td>
                                    <?= $product['stock']; ?>
                                </td>
                                <td><a href='index.php?action=product_modify&id=<?= $product['id'] ?>' class='btn btn-dark btn'>Modifier</a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal<?= $product['id'] ?>">
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal de confirmation de suppression -->
                            <div class="modal fade" id="deleteModal<?= $product['id'] ?>" tabindex="-1"
                                aria-labelledby="deleteModalLabel<?= $product['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel<?= $product['id'] ?>">Confirmation de
                                                suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr(e) de vouloir supprimer ce produit ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Annuler</button>
                                            <form action="index.php?action=delete_product&id=<?= $product['id'] ?>"
                                                method="post">
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="content py-5">
        <div class="container mt-5">
            <div class="alert alert-info" role="alert">Aucun produit disponible pour le moment.</div>
        </div>
    </div>
<?php endif; ?>

<?php include_once 'views/includes/admin_footer.php'; ?>