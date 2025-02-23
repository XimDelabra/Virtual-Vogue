<?php
require_once 'db_conexion.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barber Bros</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/b1473ebfe8.js" crossorigin="anonymous"></script>
</head>
<body class="body-index">
    <nav class="navbar">
        <div class="logo"><img src="img/logo-3.png" alt=""></div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="nav-links">
            <a href="#home">Inicio</a>
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
                <source src="videos/videosi.mp4" type="video/mp4">
            </video>
        </div>
        <div class="container-video-title">
            <img src="img/logo-3.png" alt="">
        </div>
    </div> 

    <div class="container-informacion">
        <div class="container-informacion-img">
            <img   data-aos="fade-up" src="img/img-1.jpg" alt="">
        </div>
        <div class="container-informacion-text">
            <div>
            <h1 data-aos="fade-left">Bienvenido a Barber Bros</h1>
            <br>
            <p data-aos="fade-right">En Barber Bros no solo se trata de cortes de cabello, se trata de ofrecer una experiencia. Somos más que una barbería; somos un lugar donde la tradición y el estilo moderno se encuentran para crear un espacio único dedicado al cuidado y la confianza personal.</p>
            <br>
            <h1 data-aos="fade-left">¿Qué Nos Hace Únicos?</h1>
            <br>
            <ul data-aos="fade-up-right">
                <li><strong>Atención personalizada:</strong> Nos tomamos el tiempo para entender tu estilo y tus necesidades.</li>
                <li><strong>Ambiente único:</strong> Disfruta de un espacio moderno y acogedor diseñado para que te relajes mientras te transformamos.</li>
                <li><strong>Experiencia profesional:</strong> Cada miembro de nuestro equipo está altamente capacitado en las últimas técnicas de barbería.</li>
                <li><strong>Compromiso con la calidad:</strong> Usamos productos premium y las mejores herramientas del mercado.</li>
            </ul>
            </div>
        </div>
    </div>
    <div class="container-equipo">
        <h3 data-aos="fade-down-right">Equipo profesional</h3>
        <h1 data-aos="fade-down">Somos expertos de barbería.</h1>
        <div class="container-imganes-equipo">
            <div data-aos="flip-left" class="box box-1" style="--img: url(img/brandon.webp);" data-text="Brandon"></div>
            <div data-aos="flip-right" class="box box-2" style="--img: url(img/daniel.webp);" data-text="Daniel"></div>
            <div data-aos="flip-up" class="box box-3" style="--img: url(img/gabriel.webp);" data-text="Gabriel"></div>
        </div>
    </div>
    <div class="container-list-precio">
        <p data-aos="fade-down">Nuestros precios</p>
        <h1 data-aos="fade-down">Lista de precios</h1>
        <div class="content-list-precio">
        <div class="price-list">
            <img data-aos="fade-right" src="img/precios-Photoroom.png" alt="">
        </div>
        <div class="list-precio-img">
            <img data-aos="flip-down" src="img/img-2.jpg" alt="">
        </div>
    </div>
    </div>
    <div class="container-img-gallery">
        <h1 data-aos="fade-down-right">Galeria</h1>
    <div class="gallery-container">
        <div class="gallery-item">
            <img data-aos="flip-up" src="https://media.tycsports.com/files/2024/11/12/786333/corte-de-pelo_862x485.webp" alt="Corte de cabello 1">
        </div>
        <div class="gallery-item">
            <img data-aos="zoom-in" src="https://tvazteca.brightspotcdn.com/dims4/default/860b2f7/2147483647/strip/true/crop/577x695+0+0/resize/620x747!/format/webp/quality/90/?url=http%3A%2F%2Ftv-azteca-brightspot.s3.amazonaws.com%2F99%2F60%2F0c93f16141ba9bff06acbbf91c78%2Faa1.jpg" alt="Corte de cabello 2">
        </div>
        <div class="gallery-item">
            <img data-aos="fade-up"
            data-aos-anchor-placement="top-bottom" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBayiuLdIj8h5sS6OpehpaSpJf4YBCp5qIKQ&s" alt="Afeitado profesional">
        </div>
        <div class="gallery-item">
            <img data-aos="fade-up"
            data-aos-anchor-placement="top-center" src="https://plus.unsplash.com/premium_photo-1661380558859-40df8dd91dfd?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8aGVycmFtaWVudGFzJTIwZGUlMjBiYXJiZXJvfGVufDB8fDB8fHww" alt="Herramientas de barbería">
        </div>
        <div class="gallery-item">
            <img data-aos="fade-right"
            data-aos-offset="300"
            data-aos-easing="ease-in-sine" src="https://media.istockphoto.com/id/869786676/es/foto/peluquero-de-preparaci%C3%B3n-de-cara-para-el-afeitado-con-toalla-caliente.jpg?s=612x612&w=0&k=20&c=cLUxeoId9zuGF7Ud5IdOfjx3cfB-nRzQ6iXItQSHlO0=" alt="Afeitado con toalla caliente">
        </div>
        <div class="gallery-item">
            <img data-aos="fade-up"
            data-aos-anchor-placement="top-bottom" src="https://www.ole.com.ar/2021/07/01/RcjdSDCBQ_720x0__1.jpg" alt="Estilos modernos de corte">
        </div>
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