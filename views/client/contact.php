<?php include_once 'views/includes/header.php'; ?>

<div class="content py-5">
    <div class="container">
        <div class="contact-form ">
            <div class="text-center mb-4">
                <img src="public/uploads/logo-ichimanga.webp" alt="Logo" class="logo logo-form" />
                <h5 class="display-6 mt-3 mb-4 text-uppercase">Contactez-nous</h5>
            </div>
            <form action="#" method="POST">
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Prénom" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nom" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="5" placeholder="Message" required></textarea>
                </div>
                <button type="submit" id="submitButton" class="btn btn-danger btn-block w-100">Envoyer</button>
            </form>
        </div>
    </div>
</div>


<?php include_once 'views/includes/footer.php'; ?>