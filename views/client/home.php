<?php include_once 'views/includes/header.php'; ?>




<header id="header">
    <div class="container">
        <div>
            <h1 class="text-capitalize title-principal">Bienvenue sur IchiManga.fr</h1>
        </div>
    </div>
</header>



<section id="collection">
    <section class="container py-5">
        <div class="py-5 bg-dark text-white">
            <div class="container">
                <div class="title text-center">
                    <h2 class="position-relative d-inline-block display-5">
                        Collections
                    </h2>
                    <div class="row">
                        <div class="d-flex justify-content-center mt-3 flex-wrap text-white" id="filtre-collection">
                            <span data-id="tous" class="btn m-2 active-filter-btn text-white">Tous</span>
                            <?php foreach ($categories as $category) { ?>
                                <span data-id="<?= strtolower($category['category']); ?>" class="btn m-2 text-white">
                                    <?= $category['category'] ?>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-2">
    <div class="container mt-3">
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-6 col-lg-4 element filtre-<?= strtolower($product['category']) ?>">
                    <div class="product-card">
                        <div id="category_banner" class="p-1 rounded">
                            <?= $product['category'] ?>
                        </div>
                        <!-- Product image-->
                        <img class="card-img-top" src="<?= $product['image'] ?>" alt="Product Image">
                        <!-- Product details-->
                        <div class="card-body p-3">
                            <!-- Product name-->
                            <h5 class="card-title fw-bolder">
                                <?= $product['name'] ?>
                            </h5>
                            <p class="card-text text-center pt-2">
                                <?= substr($product['description'], 0, 150) ?>...
                            </p>
                            <!-- Product price-->
                            <p class="text-muted text-center h5 fw-bold pb-2">
                                <?= $product['price'] ?> €
                            </p>
                            <div class="direction">
                                <a href="show_product_details?id=<?= $product['id']; ?>"
                                    class="btn btn-dark d-flex justify-content-center py-2 mb-2">Voir en détails</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>




































<?php include_once 'views/includes/footer.php'; ?>
