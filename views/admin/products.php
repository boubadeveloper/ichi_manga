<?php include_once 'views/includes/admin_header.php'; ?>

<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <img src="../../../public/images/logo-ichimanga.webp" alt="" id="logo-ichimanga">
            <h1 class="display-6 text-uppercase">- Liste des produits - </h1>
            <div class="container bg-dark text-white d-flex justify-content-center align-items-center rounded mx-auto mt-2" id="d-flex-center">
                <a class="btn btn-sm bg-danger text-white" href="add_product" id="add-product-btn" target="_blank">
                    Ajouter un produit
                </a>
            </div>
        </div>
    </div>
</header>

<?php if (!empty($products)): ?>
    <?php
    if (isset($_GET['delete_success']) && $_GET['delete_success'] == true) {
        if (isset($_SESSION['confirmation_message'])) {
            echo '<div class="alert alert-success" role="alert">' . $_SESSION['confirmation_message'] . '</div>';
            unset($_SESSION['confirmation_message']);
        }
    }
    ?>
    <div class="content py-5">
        <div class="container mt-5 p-0 mb-5 ">
            <div class="table-responsive">
                <table class="table table-hover shadow-sm table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <?php foreach ($products[0] as $column => $value): ?>
                                <?php if ($column !== 'stock'): ?>
                                    <th scope="col" class="text-uppercase"><?= $column; ?></th>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <th scope="col" class="text-uppercase">Modifier</th>
                            <th scope="col" class="text-uppercase">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <?php foreach ($product as $column => $value): ?>
                                    <?php if ($column !== 'stock'): ?>
                                        <?php if ($column === 'image'): ?>
                                            <td><img src="<?= $value ?>" alt="Product Image" class="product-image"></td>
                                        <?php else: ?>
                                            <td><?= $value ?></td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <td><a href='modify_product?id=<?= $product['id'] ?>' class='btn btn-dark btn'>Modifier</a></td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $product['id'] ?>">Supprimer</button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal<?= $product['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $product['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel<?= $product['id'] ?>">Confirmation de suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr(e) de vouloir supprimer ce produit ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Annuler</button>
                                            <form action="index.php?action=delete_product&id=<?= $product['id'] ?>" method="post">
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
