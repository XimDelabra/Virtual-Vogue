<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Vogue</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/b1473ebfe8.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar">
        <div class="div1-logo-nav">
            <img src="img/logo-3.png" alt="">
            <div class="svg-nav">
                <text x="50%" y="50%" dy=".35em" text-anchor="middle">
                    Virtual Vogue
                </text>
            </div>
        </div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="nav-links">
            <a href="#">Inicio</a>
            <a href="#">Tiendas</a>
            <a href="#">Eventos</a>
            <a href="#">Contactos</a>
        </div>
    </nav>

    <div class="cssportal-grid">
        <div class="div1">
            <video autoplay loop muted>
                <source src="videos/video.mp4" type="video/mp4">
            </video>
            <div class="div1-logo">
                <img id="logo" src="img/logo-3.png" alt="">
                <svg>
                    <text x="50%" y="30%" dy=".35em" text-anchor="middle">
                        Virtual Vogue
                    </text>
                </svg>
            </div>
        </div>
    </div>
</div>
<div class="container-bienvenida">
    <div class="contenido-bienvenida">
        <h1>Bienvenido a Virtual Vogue</h1>
        <p>
            Tu estilo, nuestra pasión. Descubre las mejores tiendas, productos y servicios en un solo lugar.
            Encuentra todo lo que necesitas para ti y tu familia, desde ropa y accesorios hasta servicios.
        </p>
    </div>
    <img src="https://images.pexels.com/photos/2375131/pexels-photo-2375131.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Moda" class="imagen">
</div>

    <div class="container-sobre-nosotros">
        <div class="contenido">
            <h1>Sobre Nosotros</h1>
            <p>
                En Virtual Vogue, reinventamos la experiencia de compra llevando el centro comercial directamente a
                ti. Somos una plataforma digital innovadora que reúne las mejores marcas, tiendas exclusivas y
                productos de calidad en un solo lugar, permitiéndote comprar de manera fácil, segura y cómoda.
            </p>
            <br>
            <button>Explorar Tiendas</button>
        </div>
    </div>
    <h1 class="title-tiendas">Nuestras tiendas</h1>
    <div class="projects">
        
        <div class="card">
            <img src="img/Fondo_Guarderia.png" alt="Guarderia" class="card-img">
            <div class="card-body">
                <h1 class="card-title">Little Angel</h1>
                <p class="card-info">
                    Ofrecemos un ambiente seguro y acogedor para niños de <br>
                    6 meses a 5 años, con actividades lúdicas, 
                    educativas y atención personalizada para su desarrollo integral.
                </p>
                <a href="Guarderia/" class="card-btn">button</a>
            </div>
        </div>
        <div class="card">
            <img src="img/card_pasteleria.png" alt="Pasteleria" class="card-img">
            <div class="card-body">
                <h1 class="card-title">Kamv</h1>
                <p class="card-info">Disfruta de Kamv: los mejores postres de Saltillo,<br>ahora a tu alcance. Postres artesanales, calidad insuperable<br>y sabor que conquista paladares.</p>
                <a href="pasteleria_kamv/" class="card-btn">Visitar</a>
            </div>
        </div>
        <div class="card">
            <img src="img/fondo-card.png" alt="" class="card-img">
            <div class="card-body">
                <h1 class="card-title">Titulo</h1>
                <p class="card-info">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas reprehenderit
                    asperiores cumque alias! Deleniti quaerat amet facere laudantium minus dolore repellat quae iste
                </p>
                <a href="" class="card-btn">button</a>
            </div>
        </div>
        <div class="card">
            <img src="img/findo-card-barber.png" alt="" class="card-img">
            <div class="card-body">
                <h1 class="card-title">Barber Bros</h1>
                <p class="card-info">En Barber Bros no solo se trata de cortes de cabello, se trata de ofrecer una experiencia. </p>
                <a href="Barber Bros/login.php" class="card-btn">button</a>
            </div>
        </div>
        <div class="card">
            <img src="img/stylen-banner.png" alt="" class="card-img">
            <div class="card-body">
                <h1 class="card-title">Stylen</h1>
                <p class="card-info">Ven y visita la mejor tienda de renta de trajes del mundo! <br> Todo lo que necesitas al mejor precio y a un solo click</p>
                <a href="stylen/" class="card-btn">button</a>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="footer-section">
                <div class="div1-logo">
                    <img id="logo" src="img/logo-3.png" alt="">
                    <svg>
                        <text x="50%" y="30%" dy=".35em" text-anchor="middle">
                            Virtual Vogue
                        </text>
                    </svg>
                </div>
                <p>Tu estilo, nuestra pasión. Visítanos y vive la experiencia.</p>
            </div>
            <div class="footer-section">
                <h3>Contacto</h3>
                <p>📍 Dirección: Calle Principal #123, Ciudad</p>
                <p>📞 Teléfono: +1 (555) 123-4567</p>
                <p>✉️ Email: contacto@Virtual Vogue.com</p>
            </div>
            <div class="footer-section">
                <h3>Enlaces</h3>
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Tiendas</a></li>
                    <li><a href="#">Eventos</a></li>
                    <li><a href="#">Contactos</a></li>
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
            <p>&copy; 2025 Virtual Vogue | Todos los derechos reservados.</p>
        </div>
    </footer>



    <script src="script.js"></script>
</body>

</html>