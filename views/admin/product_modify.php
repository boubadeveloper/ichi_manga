<?php include_once 'views/includes/admin_header.php'; ?>







<section class="page-login pt-5 pb-5">

    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-5">
                <?php if (isset($_POST["update-product"]) && !empty($_POST["category"]) && !empty($_POST["name"]) && !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["stock"])): ?>
                    <div class="alert alert-success mt-2 mx-2 container mx-auto text-center d-flex justify-content-center">
                        Produit mis à jour avec succès.</div>
                <?php endif; ?>

                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger mt-2 mx-2 container mx-auto text-center d-flex justify-content-center">
                        Erreur lors de la mise à jour du produit :
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="row">
                        <!-- Affichage du message de succès -->

                        <form class="px-5 py-2" id="update-product-form" action="product_modify" method="POST"
                            enctype="multipart/form-data">

                            <div class="text-center mb-4">
                                <img src="public/uploads/logo-ichimanga.webp" alt="Logo" class="logo logo-form" />
                                <h5 class="display-6 mt-3 mb-4 text-uppercase">Modifier un produit</h5>
                            </div>

                            <input type="hidden" name="product_id"
                                value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">


                            <div class="mb-3">
                                <label for="category" class="form-label">Catégorie du produit :</label>
                                <input type="text" id="category" name="category"
                                    class="form-control border-2 border-dark" required autocomplete="off"
                                    value="<?php echo isset($product['category']) ? $product['category'] : ''; ?>">
                            </div>
                            <input type="hidden" name="current_image"
                                value="<?php echo isset($product['image']) ? $product['image'] : ''; ?>">

                            <div class="mb-3">
                                <label for="current_image" class="form-label">Image actuelle du produit :</label>
                                <div class="current-image">
                                    <img src="<?php echo isset($product['image']) ? $product['image'] : ''; ?>"
                                        alt="Current Image" class="img-fluid">
                                </div>
                                <label for="new_image" class="form-label">Nouvelle image du produit :</label>
                                <input type="file" id="new_image" name="new_image"
                                    class="form-control border-2 border-dark" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom du produit :</label>
                                <input type="text" id="name" name="name" class="form-control border-2 border-dark"
                                    autocomplete="off" required
                                    value="<?php echo isset($product['name']) ? $product['name'] : ''; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description du produit :</label>
                                <textarea name="description" id="description" class="form-control border-2 border-dark"
                                    autocomplete="off"
                                    required><?php echo isset($product['description']) ? $product['description'] : ''; ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Prix du produit :</label>
                                <input type="number" id="price" name="price" class="form-control border-2 border-dark"
                                    autocomplete="off" required
                                    value="<?php echo isset($product['price']) ? $product['price'] : ''; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock du produit :</label>
                                <input type="number" id="stock" name="stock" class="form-control border-2 border-dark"
                                    autocomplete="off" required
                                    value="<?php echo isset($product['stock']) ? $product['stock'] : ''; ?>">
                            </div>

                            <button type="submit" class="btn btn-danger btn-lg btn-block" name="update-product">Mettre à
                                jour</button>
                            <button type="button" class="btn btn-dark btn-lg btn-block">Effacer</button>
                        </form>




                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once 'views/includes/admin_footer.php'; ?>