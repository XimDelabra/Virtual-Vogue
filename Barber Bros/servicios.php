<?php
require_once 'db_conexion.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/b1473ebfe8.js" crossorigin="anonymous"></script>
</head>
<body class="body-servicios">

<nav class="navbar">
        <div class="logo"><img src="img/logo-3.png" alt=""></div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="nav-links">
            <a href="inicio.php">Inicio</a>
            <a href="servicios.php">Services</a>
            <a href="citas.php">Citas</a>
            <a type="button" class="toggle-btn" onclick="toggleSidebar()">Mi Perfil</a>
        </div>
        <div class="search-bar" style="opacity: 0;">
            <input type="text" placeholder="Search...">
            <button>Search</button>
        </div>
    </nav>
    <div class="sidebar" id="sidebar">
        <div class="img-perfil">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaCOobWuX1QLBAc-35uq5XO8Ozghn5Lej6yw&s" alt="">
        </div>
        <button class="close-btn" onclick="toggleSidebar()">✖</button>
        <br>
        <h1>Mi Perfil</h1>
        <br>
        <p>Nombre: <?php echo $_SESSION['nombre'] ?></p>
        <p>Correo: <?php echo $_SESSION['correo'] ?></p>
        <a type="button" href="logout.php" class="btn-cerrar-sesion">Cerrar Sesion</a>
        <div class="img-perfil-logo">
            <img src="img/logo-3.png" alt="">
        </div>
    </div>

    
    <div class="container_principal">
        <div class="container-video">
            <video autoplay loop muted>
                <source src="videos/video-2.mp4" type="video/mp4">
            </video>
        </div>
        <div class="container-video-title">
            <img src="img/logo-3.png" alt="">
        </div>
    </div> 
    <div class="title-cards">
        <h5 data-aos="fade-left">Servicios Profesionales</h5>
        <h1 data-aos="fade-right">Nuestros mejores servicios que le ofrecemos</h1>
    </div>

    <div class="card-container">
        <div data-aos="fade-up" class="card">
            <img src="https://tahecosmetics.com/trends/wp-content/uploads/2023/02/mohicano-personalizado.jpg" alt="Imagen 1">
            <h3>Corte de cabello.</h3>
            <p>Te recibiremos con una bebida de cortecia, el barbero y tu seleccionaran el estilo ideal para tu rostro.</p>
        </div>
        <div data-aos="fade-down" class="card">
            <img src="https://fundacioncarlosslim.org/wp-content/uploads/2022/02/servicio-barberia-barba-bigote-2.jpg" alt="Imagen 2">
            <h3>Servicio de barba.</h3>
            <p>Experiencia con toalla caliente,limpieza facial,exforación asi como de nuestros vaporizadores que abren los poros de tu rostro.</p>
        </div>
        <div data-aos="fade-up" class="card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNrmWQqC4UbDU024dy_wxJ8Id-SspzgONrJQ&s" alt="Imagen 3">
            <h3>Facial especial.</h3>
            <p>Nuestro servicio para tu rostro aplicando la mascarilla negra de carbón activado, te renueva totalmente y elimina todos los puntos negros de frente, nariz y mejillas..</p>
        </div>
        <div data-aos="fade-down" class="card">
            <img src="https://casaazulspa.mx/wp-content/uploads/2020/06/Mascarillas-corporales-1.png" alt="Imagen 4">
            <h3>Ritual Spa.</h3>
            <p>Nuestro servicio de ritual spa para caballeros es un momento único y relajante, dejándote un rostro totalmente renovado.</p>
        </div>
        <div data-aos="fade-up" class="card">
            <img src="https://img.optimalcdn.com/www.posta.com.mx/2023/07/7c478bfa45254fbc5d8a657a8d6fe2df33c18648/WhatsApp_Image_2023-07-21_at_12.04.45_PM.webp" alt="Imagen 5">
            <h3>Diseño De Autor.</h3>
            <p>Te recibiremos con una bebida de cortecia, el barbero y tu seleccionaran el estilo ideal para tu rostro.</p>
        </div>
        <div data-aos="fade-down" class="card">
            <img src="https://hips.hearstapps.com/hmg-prod/images/esquire-skin-10-6697917d84c49.jpg?crop=1.00xw:0.667xh;0,0&resize=640:*" alt="Imagen 6">
            <h3>Parches de colágeno</h3>
            <p>los parches de colágeno hidratan profundamente la delicada área debajo de los ojos.</p>
        </div>

    </div>

    <footer  class="footer">
    <div class="container">
    <div class="footer-section">
        <img  class="img-footer" src="img/logo-3.png" alt="">
        <p>Tu estilo, nuestra pasión. Visítanos y vive la experiencia.</p>
    </div>
    <div class="footer-section">
        <h3>Contacto</h3>
        <p>📍 Dirección: Calle Principal #123, Ciudad</p>
        <p>📞 Teléfono: +1 (555) 123-4567</p>
        <p>✉️ Email: contacto@barberiaelestilo.com</p>
    </div>
    <div class="footer-section">
        <h3>Enlaces</h3>
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Servicios</a></li>
            <li><a href="#">Citas</a></li>
            <li><a href="#">Contacto</a></li>
        </ul>
    </div>
    <div class="footer-section">
        <h3>Síguenos</h3>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p >&copy; 2025 Barbería El Estilo | Todos los derechos reservados.</p>
    </div>
</footer>
<script>
    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("open");
    }
</script>
    
    <script>
    const navbar = document.querySelector(".navbar");
    
    window.addEventListener("scroll", () => {
        if (window.scrollY === 0) {
            navbar.classList.remove("hidden");
        } else {
            navbar.classList.add("hidden");
        }
    });
    document.addEventListener("mousemove", (event) => {
        if (event.clientY < 150) { 
            navbar.classList.remove("hidden");
        }
    });
    window.addEventListener("scroll", function () {
        var navbar = document.querySelector(".navbar"); 
        if (window.scrollY > 800) { 
            navbar.classList.add("scrolled"); 
        } else {
            navbar.classList.remove("scrolled"); 
        }
    });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>