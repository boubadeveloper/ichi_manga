<?php include_once 'views/includes/admin_header.php'; ?>

<!-- Formulaire de modification de produit avec Bootstrap -->
<div class="content py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 shadow p-4 rounded bg-white text-dark">
                <div class="text-center mb-4">
                    <img src="public/uploads/logo-ichimanga.webp" alt="Logo" class="logo logo-form" />
                    <h5 class="display-6 mt-3 mb-4 text-uppercase">Modifier le produit</h5>
                </div>
                <form action="modify_product?id=<?php echo $product['id']; ?>" method="POST" enctype="multipart/form-data">
                    <!-- Champ caché pour l'ID du produit -->
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                    <div class="mb-3">
                        <input type="text" class="form-control" id="category" name="category" placeholder="Catégorie du produit" value="<?php echo $product['category']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <input type="file" class="form-control" id="image" name="image">
                        <img src="<?php echo $product['image']; ?>" alt="Product Image" class="img-fluid mt-2" style="max-width: 200px;">
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom du produit" value="<?php echo $product['name']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control" id="description" name="description" placeholder="Description du produit" rows="3" required><?php echo $product['description']; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <input type="number" class="form-control" id="price" name="price" placeholder="Prix du produit" value="<?php echo $product['price']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock du produit" value="<?php echo $product['stock']; ?>" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger btn-lg" name="modify_product">Modifier</button>
                        <a href="show_products" class="btn btn-dark btn-lg">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once 'views/includes/admin_footer.php'; ?>
