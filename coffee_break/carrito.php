<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
            padding: 60px;
            position: relative;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .video-background video {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100vw;
            height: 100vh;
            object-fit: cover;
        }

        .navbar {
            position: fixed; 
            top: 0; 
            left: 0;
            width: 100%; 
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #208f5a;
            padding: 10px 20px;
            height: 60px;
            color: white;
            z-index: 1000;
        }
        .navbar-left .logo {
            font-size: 1.5em;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }
        .navbar-right a {
            color: #ffeb5b;
            text-decoration: none;
            margin: 0 10px;
            font-size: 0.9em;
            transition: color 0.3s ease;
        }
        h2, h3 {
            color: #343a40;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: separate; /* Cambiado de collapse a separate */
            border-spacing: 0; /* Para eliminar separación entre celdas */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.55);
            border-radius: 10px;
            overflow: hidden;
        }

        th:first-child {
    border-top-left-radius: 10px;
}
th:last-child {
    border-top-right-radius: 10px;
}
tr:last-child td:first-child {
    border-bottom-left-radius: 10px;
}
tr:last-child td:last-child {
    border-bottom-right-radius: 10px;
}
        th, td {
            padding: 12px;
            color: #fff;
            border: 1px solid #ddd;
            background-color:rgba(36, 36, 36, 0.58);
        }
        th {
            background-color:rgba(245, 225, 77, 0.77);
            color: #fff;
            text-transform: uppercase;
        }


tr:hover td {
    background-color: rgba(116, 116, 116, 0.3);
    transition: background 0.3s ease-in-out;
}
        button {
            padding: 10px 15px;
            margin-top: 10px;
            border: none;
            background-color: #208f5a;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s;
        }
        button:hover {
            background-color: rgb(19, 80, 50);
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .delete-btn:hover {
            background-color: rgb(124, 23, 33);
        }
        #ticket {
            display: none;
            margin: 20px auto;
            padding: 15px;
            width: 300px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        #ticket h3 {
            text-align: center;
            color: #208f5a;
        }
        #detalle-ticket {
            margin-top: 10px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }
</style>
</head>
<body>
    <div class="video-background">
        <video autoplay loop muted playsinline>
            <source src="image/carro.mp4" type="video/mp4">
            Tu navegador no soporta videos.
        </video>
    </div>

    <nav class="navbar">
        <div class="navbar-left">
            <a href="#" class="logo">Coffee Break</a>
        </div>
        <div class="navbar-right">
            <a href="menu.html">Menú</a>
        </div>
    </nav>

    <h2 style="color:white;">Carrito de Compras</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody id="tabla-carrito"></tbody>
    </table>
    <h3 style="color:white;">Total: $<span id="total-carrito">0</span></h3>
    <button onclick="generarTicket()">Generar Ticket</button>
    
    <div id="ticket">
        <h3>Ticket de Compra</h3>
        <div id="detalle-ticket"></div>
        <h3>Total: $<span id="total-ticket"></span></h3>
    </div>

    <script>
        function cargarCarrito() {
            $.getJSON("mostrar_carrito.php", function(data) {
                let tabla = "";
                let total = 0;

                if (data.status === "empty") {
                    $("#tabla-carrito").html("<tr><td colspan='5'>El carrito está vacío</td></tr>");
                    $("#total-carrito").text("0");
                    return;
                }

                data.forEach(item => {
                    let subtotal = item.precio * item.cantidad;
                    total += subtotal;
                    tabla += `<tr>
                        <td>${item.nombre}</td>
                        <td>$${item.precio}</td>
                        <td>${item.cantidad}</td>
                        <td>$${subtotal}</td>
                        <td><button class='delete-btn' onclick="eliminarProducto(${item.id})">Eliminar</button></td>
                    </tr>`;
                });

                $("#tabla-carrito").html(tabla);
                $("#total-carrito").text(total);
            });
        }

        function eliminarProducto(id) {
            $.post("eliminar_del_carrito.php", { id: id }, function(response) {
                alert(response.message);
                cargarCarrito();
            }, "json");
        }

        function generarTicket() {
            $.getJSON("mostrar_carrito.php", function(data) {
                let detalle = "";
                let total = 0;

                if (data.status === "empty") {
                    alert("El carrito está vacío.");
                    return;
                }

                data.forEach(item => {
                    let subtotal = item.precio * item.cantidad;
                    total += subtotal;
                    detalle += `<p>${item.cantidad} x ${item.nombre} - $${subtotal}</p>`;
                });

                $("#detalle-ticket").html(detalle);
                $("#total-ticket").text(total);
                $("#ticket").fadeIn();
            });
        }

        $(document).ready(function() {
            cargarCarrito();
        });
    </script>
</body>
</html>
