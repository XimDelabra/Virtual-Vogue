<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand title " href="index.php">
            <img src="images/logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top ">
            Stylen
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav ms-auto pags">
                <a href="catalogo.php" class="btn btn-catalogo">Catálogo</a>
                <a href="<?php echo isset($_SESSION['email']) ? 'favoritos.php' : 'login.php'; ?>" class="btn btn-favoritos">Favoritos</a>
                
                
                <li class="nav-item dropdown">
                    <a class="navbar-brand title bi bi-person-fill dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                    <ul class="dropdown-menu ">
                        <?php if (isset($_SESSION['email'])): ?>
                            <li><a class="dropdown-item py-2 fw-bold" href="#"><?php echo ($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?></a></li>
                            <li><a class="dropdown-item" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Carrito</a></li>
                            <li><a class="dropdown-item" data-bs-toggle="offcanvas" href="#offcanvasAnuncio" role="button" aria-controls="offcanvasAnuncio">Anuncios</a></li>
                            <li><a class="dropdown-item" href="contacto.php">Contacto</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Cerrar Sesion</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item " href="login.php">Inicia Sesion</a></li>
                            <li><a class="dropdown-item" href="registro.php">Registrate</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" data-bs-toggle="offcanvas" href="#offcanvasAnuncio" role="button" aria-controls="offcanvasAnuncio">Anuncios</a></li>
                            <li><a class="dropdown-item" href="contacto.php">Contacto</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </div>
        </div>
    </div>
</nav>
<hr>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAnuncio" aria-labelledby="offcanvasAnuncioLabel">
  <div class="offcanvas-header">
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <img src="images/anuncio_cc.jpg" alt="" width="100%"><br>
    <img src="images/anuncio_chips.jpg" alt="" width="100%"><br>
    <img src="images/anuncio_pringles.jpg" alt="" width="100%">
  </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    function abrirAnuncio() {
        var offCanvas = new bootstrap.Offcanvas(document.getElementById("offcanvasAnuncio"));
        offCanvas.show();
    }

    // Abre el offcanvas cada 30 segundos (ajusta el tiempo según necesites)
    setInterval(abrirAnuncio, 30000);
});

</script>