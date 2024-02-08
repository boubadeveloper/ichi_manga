<?php include_once 'views/includes/admin_header.php'; ?>

<section class="page-login pt-5 pb-5">

    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-5">
                <?php if (isset($_POST["add-product"]) && !empty($_POST["category"]) && !empty($_POST["name"]) && !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["stock"]) && !empty($_POST["image"])): ?>
                    <div class="alert alert-success mt-2 mx-2 container mx-auto text-center d-flex justify-content-center">
                        Produit ajouté avec succès.</div>
                <?php endif; ?>

                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger mt-2 mx-2 container mx-auto text-center d-flex justify-content-center">
                        Erreur lors de l'ajout du produit :
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="row">
                        <!-- Affichage du message de succès -->

                        <form class="px-5 py-2" id="add-product-form" action="add_product" method="POST"
                            enctype="multipart/form-data">
                            <div class="text-center mb-4">
                                <img src="public/uploads/logo-ichimanga.webp" alt="Logo" class="logo logo-form" />
                                <h5 class="display-6 mt-3 mb-4 text-uppercase">Ajouter un produit</h5>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Catégorie du produit :</label>
                                <input type="text" id="category" name="category"
                                    class="form-control border-2 border-dark" required autocomplete="off">
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Choisissez une option :</label><br>
                                <input type="radio" id="file_option" name="upload_option" value="file" checked>
                                <label for="file_option">Fichier d'image</label><br>
                                <input type="radio" id="url_option" name="upload_option" value="url">
                                <label for="url_option">URL d'image</label>
                            </div>
                            <div id="file_input" class="mb-3">
                                <label for="image" class="form-label">Fichier de l'image :</label>
                                <input type="file" id="editimage" name="image" class="form-control border-2 border-dark"
                                    autocomplete="off" accept="image/*">
                            </div>
                            <div id="url_input" class="mb-3" style="display: none;">
                                <label for="image_url" class="form-label">URL de l'image :</label>
                                <input type="text" id="image_url" name="image_url"
                                    class="form-control border-2 border-dark">
                            </div>
                            <!-- Ajoutez un champ caché pour indiquer que la soumission est automatique -->
                            <input type="hidden" name="auto_submit" value="true">



                            <div class="mb-3">
                                <label for="name" class="form-label">Nom du produit :</label>
                                <input type="text" id="name" name="name" class="form-control border-2 border-dark"
                                    autocomplete="off" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description du produit :</label>
                                <textarea name="description" id="description" class="form-control border-2 border-dark"
                                    autocomplete="off" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Prix du produit :</label>
                                <input type="number" id="price" name="price" class="form-control border-2 border-dark"
                                    autocomplete="off" required>
                            </div>

                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock du produit :</label>
                                <input type="number" id="stock" name="stock" class="form-control border-2 border-dark"
                                    autocomplete="off" required>
                            </div>

                            <button type="submit" class="btn btn-danger btn-lg btn-block"
                                name="add_product">Ajouter</button>
                            <button type="button" class="btn btn-dark btn-lg btn-block">Effacer</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once 'views/includes/admin_footer.php'; ?>