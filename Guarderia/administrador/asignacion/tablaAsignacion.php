<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla Asignaciones</title>
    <?php require_once 'cdn.html'?>
    <style>
        body {
            background-image: url('../images/fondo.png');
            background-size: cover; /* Hace que la imagen cubra toda la pantalla */
            background-repeat: no-repeat;
        }
        .transparente{
            border: none;
            background-color: rgba(255, 255, 255, 0); 
        }
        th, td{
            background-color: rgba(255, 255, 255, 0.7) !important;
            color:black !important;
        }
        .custom-card-img .card-body::-webkit-scrollbar {
            width: 10px;
        }
        .custom-card-img .card-body::-webkit-scrollbar-thumb {
            background-color:rgb(238, 137, 87); /* Color negro para la barra */
            border-radius: 5px; /* Bordes redondeados */
            border: 2px solid #f1f1f1; /* Espacio entre la pista y la barra */
        }
        .bg-yellow{
            background-color: #f4e786;
        }
        .bg-pink{
            background-color: #f7c5eb;
        }
        .bg-green{
            background-color: #8cccc6;
        }
        .bg-acept{
            background-color: #b2fdb9;
        }
        @font-face {
            font-family: 'arco';
            src: url('../font/ARCO.ttf') format('truetype');
        }
        .menu{
            font-family: arco; 
            font-size: xxx-large;
            text-shadow:2px 2px 4px #f3b2fd;
            color:white;
            padding-left: 100px; 
        }
        .title{
            font-family: arco; 
            font-size: xxx-large;
            color:#fb7f4a;
            text-shadow:2px 2px 4px #5fa2fb;
        }
        .contenedor {
            display: flex;
            flex-direction: column;
            align-items: center; /* Centrar en el eje horizontal */
            gap: 10px; /* Espaciado entre botones */
            margin-top: 30px; 
            margin-right: 130px;
            text-align: right;
        }
        .btn-colors {
            color: white;
            cursor: pointer;
            font-size: 25px; /* Tamaño del texto */
            padding: 15px 30px; /* Espaciado interno para hacerlo grande */
            border: none;
            border-radius: 15px; /* Bordes redondeados */
            transition: transform 0.3s ease, background-color 0.3s ease; 
            height: 65px;
            width: 350px;
            text-decoration: none;
            font-family: arco;
            text-shadow: 2px 2px 4px gray;

        }
        .btn-colors:hover {
            transform: scale(1.3); /* Aumenta el tamaño en un 20% */
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">
            <img src="../images/logo.png" width="140">
        </a>
        <h3 class="title">A s i g n a c i o n e s</h3>
        <button class="navbar-toggler bg-green" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation" style="margin-right: 35px;">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end bg-green" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="menu">Menú</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <div class="contenedor">
                        <a href="../alumnos/tablaAlumnos.php" class="btn-colors"  style="background-color:#f4e786;">Alumnos</a><br>
                        <a href="../maestros/tablaMaestros.php" class="btn-colors" style="background-color:#86d4fd;">Maestros</a><br>
                        <a href="../asignacion/tablaAsignacion.php" class="btn-colors" style="background-color:#f7c5eb;">Asignaciones</a><br>
                        <a href="../alumnos/tablaAlumnos.php" class="btn-colors" style="background-color: #ffaf7e;">Horario</a><br>
                        <a href="../cerrar_sesion.php" class="btn-colors" style="background-color:rgb(250, 121, 121);">Cerrar Sesión</a>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- Select -->
<div class="container" style="margin-top:160px;">
    <form id="asignacionForm">
        <div class="row">
            <div class="col-5">
                <div class="card bg-yellow">
                    <h5 class="card-header" style="color:aliceblue">Maestro</h5>
                    <div class="card-body">
                        <select id="selectMaestro" class="form-select" aria-label="Default select example">
                            <!-- Opciones cargadas con AJAX -->
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card bg-pink">
                    <h5 class="card-header" style="color:aliceblue">Alumno</h5>
                    <div class="card-body">
                        <select id="selectAlumno" class="form-select" aria-label="Default select example">
                            <!-- Opciones cargadas con AJAX -->
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card bg-acept">
                    <h5 class="card-header" style="color:aliceblue">Confirmar</h5>
                    <div class="card-body d-flex justify-content-center">
                    <button type="button" id="btnAceptar"  class="btn btn-outline-success">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Tabla -->
    <div class="container">
        <div class="card custom-card-img flex-grow-1 transparente">
            <div class="card-body overflow-auto" style="height: 420px; margin-top:10px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nombre del Maestro</th>
                            <th scope="col">Nombre del Alumno</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="TablaUsuarios">
                        <!-- Aquí se cargarán los datos con AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- navbar -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let offcanvas = document.getElementById("offcanvasNavbar");
            offcanvas.addEventListener("hidden.bs.offcanvas", function () {
                let backdrop = document.querySelector(".offcanvas-backdrop");
                if (backdrop) {
                    backdrop.remove(); // Elimina el fondo gris
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Cargar datos al iniciar
            cargarAsignaciones();
            // Función para cargar los usuarios
            function cargarAsignaciones(){
                $.ajax({
                    url: 'load.php',
                    type: 'GET',
                    success: function(response) {
                        $('#TablaUsuarios').html(response);
                    }
                });
            }

            $(document).ready(function() {
                cargarSelectores();

                function cargarSelectores() {
                    $.ajax({
                        url: 'select.php', 
                        type: 'GET',
                        dataType: 'json', // Espera un objeto JSON
                        success: function(response) {
                            $('#selectMaestro').html(response.maestros); // Opciones de maestros
                            $('#selectAlumno').html(response.alumnos); // Opciones de alumnos
                        },
                        error: function() {
                            alert('Error al cargar los selectores.');
                        }
                    });
                }
            });


            //Guardar Asignacion
            $(document).ready(function() {
                $('#btnAceptar').click(function() {
                    let matriculaMaestro = $('#selectMaestro').val();
                    let matriculaAlumno = $('#selectAlumno').val();

                    if (matriculaMaestro === "Selecciona un maestro") {
                        toastr.warning("Por favor, selecciona un maestro.");
                        return; 
                    }
                    
                    if (matriculaAlumno === "Selecciona un alumno") {
                        toastr.warning("Por favor, selecciona un alumno.");
                        return; 
                    }

                    $.ajax({
                        url: 'save.php',
                        type: 'POST',
                        data: {
                            matricula_m: matriculaMaestro,
                            matricula_a: matriculaAlumno
                        },
                        success: function(response) {
                            //trim() elimina espacios en blanco del inicio y final de una cadena.
                            //Usarlo ayuda a prevenir errores en comparaciones de cadenas, especialmente cuando trabajas con respuestas del servidor, que pueden contener espacios no deseados.
                            if (response.trim() === "success") {
                                cargarAsignaciones(); 
                                toastr.success("Asignación guardada correctamente.");
                                $('#asignacionForm')[0].reset();
                            } else if (response.trim() === "duplicate") {
                                Swal.fire({
                                    icon: 'warning',
                                    text: 'Este maestro ya tiene asignado a este alumno.',
                                });
                            } else {
                                toastr.error("Error al guardar la asignación");
                            }
                        }
                    });
                });


            // Cargar asignaciones al iniciar
            cargarAsignaciones();

                // Función para cargar las asignaciones en la tabla
            function cargarAsignaciones() {
                $.ajax({
                    url: 'load.php',
                    type: 'GET',
                    success: function(response) {
                        $('#TablaUsuarios').html(response);
                    }
                });
            }
        });

           // Eliminar asignación usando SweetAlert2
            $(document).on('click', '.delete-btn', function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: '¿Seguro que quieres eliminar esta asignación?',
                    text: "Esta acción no se puede deshacer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'No, cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'delete.php',
                            type: 'POST',
                            data: { id: id },
                            success: function(response) {
                                if (response === "success") {
                                    cargarAsignaciones(); // Recargar la tabla de asignaciones
                                    Swal.fire(
                                        '¡Eliminado!',
                                        'La asignación ha sido eliminada correctamente.',
                                        'success'
                                    );                    
                                } else {
                                    Swal.fire(
                                        'Error',
                                        'Hubo un problema al eliminar la asignación.',
                                        'error'
                                    );
                                }
                            },
                            error: function(error) {
                                console.error("Error en la solicitud:", error);
                                Swal.fire(
                                    'Error',
                                    'Hubo un problema al eliminar la asignación.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

        });
    </script>  
</body>
</html>