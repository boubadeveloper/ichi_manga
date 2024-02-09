<?php include_once 'views/includes/admin_header.php'; ?>

<div class="content py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 shadow p-4 rounded bg-white text-dark">
                <div class="text-center mb-4">
                    <img src="public/uploads/logo-ichimanga.webp" alt="Logo" class="logo logo-form" />
                    <h5 class="display-6 mt-3 mb-4 text-uppercase">Ajouter un produit</h5>
                </div>
                <form action="add_product" method="POST" enctype="multipart/form-data">
                    <!-- Champ caché pour l'ID du produit -->
                    <!-- Ce champ n'est pas nécessaire lors de l'ajout d'un nouveau produit -->
                    <!-- <input type="hidden" name="id" value="<?php //echo $product['id']; ?>"> -->

                    <div class="mb-3">
                        <input type="text" class="form-control" id="category" name="category"
                            placeholder="Catégorie du produit" required>
                    </div>

                    <div class="mb-3">
                        <input type="file" class="form-control" id="image" name="image" required >
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom du produit"
                            required>
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control description-textarea" id="description" name="description"
                            placeholder="Description du produit" rows="3" required></textarea>
                            <button type="button" class="btn btn-sm btn-danger mt-1" onclick="agrandirDescription()">Agrandir la description</button>

                    </div>


                    <div class="mb-3">
                        <input type="number" class="form-control" id="price" name="price" placeholder="Prix du produit"
                            required>
                    </div>

                    <div class="mb-3">
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock du produit"
                            required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger btn-lg" name="add_product">Ajouter</button>
                        <a href="show_products" class="btn btn-dark btn-lg">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once 'views/includes/admin_footer.php'; ?>