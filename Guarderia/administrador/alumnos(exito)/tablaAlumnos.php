<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla Maestros</title>
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
            background-color: rgb(238, 137, 87); /* Color negro para la barra */
            border-radius: 5px; /* Bordes redondeados */
            border: 2px solid #f1f1f1; /* Espacio entre la pista y la barra */
        }
        .bg-green{
            background-color: #8cccc6;
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
            padding-left: 80px; 
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
        <a class="navbar-brand" href="../menu.php">
            <img src="../images/logo.png" width="140">
        </a>
        <h3 class="title">A l u m n o s</h3>
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
                        <a href="../alumnos/tablaAlumnos.php" class="btn-colors"  style="background-color: #f4e786;">Alumnos</a><br>
                        <a href="../maestros/tablaMaestros.php" class="btn-colors" style="background-color: #86d4fd;">Maestros</a><br>
                        <a href="../asignacion/tablaAsignacion.php" class="btn-colors" style="background-color: #f7c5eb;">Asignaciones</a><br>
                        <a href="../alumnos/tablaAlumnos.php" class="btn-colors" style="background-color: #ffaf7e;">Horario</a><br>
                        <a href="../cerrar_sesion.php" class="btn-colors" style="background-color:rgb(250, 121, 121);">Cerrar Sesión</a>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="container" style="margin-top:120px;">
    <div class="row justify-content-end">
        <div class="col-2">
            <!-- Botón para abrir modal de agregar -->
            <button type="button" id="agregar-btn" class="btn btn-success me-3" data-bs-toggle="modal" data-bs-target="#ModalUsuarios">
                Agregar Alumno
            </button>
        </div>
        <div class="col-3">
            <!-- Formulario de búsqueda -->
            <form id="buscarMatricula" class="d-flex" role="search">
                <input id="matriculaInput" class="form-control me-2" type="search" placeholder="Introduce la Matricula" aria-label="Search">
                <button id="buscarCursoBtn" class="btn btn-info" type="submit">Buscar</button>
            </form>
        </div>
    </div>
<!-- Tabla -->
    <div class="container">
        <div class="card custom-card-img flex-grow-1 transparente">
            <div class="card-body overflow-auto" style="height: 530px; margin-top:10px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Matricula</th>
                            <th scope="col">Nombre del Alumno</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Tutor</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Tipo de Sangre</th>
                            <th scope="col">Mensualidad</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="TablaUsuarios">
                        <!-- Aquí se cargarán los datos con AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Agregar-->
    <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-green">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size: 20px;">Agregar Nuevo Maestro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="FormAgregar" enctype="multipart/form-data">
                        <div class="form-group">
                            Matricula
                            <input type="text" class="form-control" id="matricula" name="matricula" required>
                        </div><br>
                        <div class="form-group">
                            Nombre del Alumno
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div><br>
                        <div class="form-group">
                            Edad
                            <input type="text" class="form-control" id="edad" name="edad" required>
                        </div><br>
                        <div class="form-group">
                            Dirección
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div><br>
                        <div class="form-group">
                            Tutor
                            <input type="text" class="form-control" id="tutor" name="tutor" required>
                        </div><br>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    Celular
                                    <input type="text" class="form-control" id="celular" name="celular" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                Tipo Sangre
                                <input type="text" class="form-control" id="tipo_sangre" name="tipo_sangre" required>
                            </div><br>
                        </div>
                        Foto del Alumno
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="guardarNvo" class="btn btn-info">Guardar Nuevo</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Editar-->
    <div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-green">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size: 20px;">Editar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="FormEditar" enctype="multipart/form-data">
                        <div class="form-group">
                            Matricula
                            <input type="text" class="form-control" id="matriculaEditar" name="matricula" required readonly>
                        </div><br>
                        <div class="form-group">
                            Nombre del Alumno
                            <input type="text" class="form-control" id="nombreEditar" name="nombre" required>
                        </div><br>
                        <div class="form-group">
                            Edad
                            <input type="text" class="form-control" id="edadEditar" name="edad" required>
                        </div><br>
                        <div class="form-group">
                            Dirección
                            <input type="text" class="form-control" id="direccionEditar" name="direccion" required>
                        </div><br>
                        <div class="form-group">
                            Tutor
                            <input type="text" class="form-control" id="tutorEditar" name="tutor" required>
                        </div><br>
                        <div class="form-group">
                            Tipo Sangre
                            <input type="text" class="form-control" id="tipo_sangreEditar" name="tipo_sangre" required>
                        </div><br>
                        <div class="form-group">
                            Celular
                            <input type="text" class="form-control" id="celularEditar" name="celular" required>
                        </div>
                        Foto del Alumno
                        <input type="file" class="form-control" id="fotoEditar" name="foto" accept="image/*" required>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="guardarEdi" class="btn btn-info">Guardar edición</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function() {
            // Cargar datos al iniciar
            GuardarUsuarios();
            // Función para cargar los usuarios
            function GuardarUsuarios() {
                $.ajax({
                    url: 'load.php',
                    type: 'GET',
                    success: function(response) {
                        $('#TablaUsuarios').html(response);
                    }
                });
            }

            $(document).ready(function() {
                // Evento para abrir el modal de agregar y resetear el formulario
                $(document).on('click', '#agregar-btn', function() {
                    $('#FormAgregar')[0].reset(); // Reinicia el formulario de agregar
                    $('#ModalAgregar').modal('show'); // Muestra el modal de agregar
                });

                // Evento para guardar o agregar
                $('#guardarNvo').on('click', function(e) {
                    e.preventDefault();
                    var matricula = $('#matricula').val();
                    var nombre = $('#nombre').val();
                    var edad = $('#edad').val();
                    var direccion = $('#direccion').val();
                    var tutor = $('#tutor').val();
                    var celular = $('#celular').val();
                    var tipo_sangre = $('#tipo_sangre').val();
                    var formData = new FormData($('#FormAgregar')[0]); 

                    if (matricula === "") {
                        toastr.warning('Campo de matricula obligatorio');
                        return;
                    }
                    if (nombre === "") {
                        toastr.warning('Campo de nombre del Alumno obligatorio');
                        return;
                    }
                    if (edad === "") {
                        toastr.warning('Campo de edad obligatorio');
                        return;
                    }
                    if (direccion === "") {
                        toastr.warning('Campo de direccion obligatorio');
                        return;
                    }
                    if (tutor === "") {
                        toastr.warning('Campo de tutor obligatorio');
                        return;
                    }
                    if (celular === "") {
                        toastr.warning('Campo de celular obligatorio');
                        return;
                    }
                    if (tipo_sangre === "") {
                        toastr.warning('Campo de tipo de sangre obligatorio');
                        return;
                    }
                    if (formData === "") {
                        toastr.warning('Campo de foto obligatorio');
                        return;
                    }

                    let userData = $('#FormAgregar').serialize();
                    $.ajax({
                        url: 'save.php',
                        type: 'POST',
                        data: formData,
                        contentType: false, // Necesario para enviar archivos
                        processData: false,
                        success: function(response) {
                            console.log("Respuesta del servidor:", response); // Para depuración
                            if (response.trim() === "Registro exitoso") {
                                $('#ModalAgregar').modal('hide');
                                GuardarUsuarios(); // Recargar la tabla
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Bien',
                                    text: '¡Alumno guardado correctamente!',
                                });
                                $('#FormAgregar')[0].reset(); // Resetear formulario
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Error',
                                    text: response, // Mostrar el mensaje del servidor
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error en AJAX:", error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudo guardar el alumno.',
                            });
                        }
                    });
                });;
            });    

            // Evento para buscar curso 
            $('#buscarMatricula').on('submit', function(event) {
                event.preventDefault(); // Evita que se recargue la página al enviar el formulario
                let id = $('#matriculaInput').val();
                if (id) {
                    $.ajax({
                        url: 'getUser.php',
                        type: 'POST',
                        data: { matricula: id },
                        success: function(response) {
                            let user = JSON.parse(response);
                            if (user) {
                                $('#matriculaEditar').val(user.matricula);
                                $('#nombreEditar').val(user.nombre);
                                $('#edadEditar').val(user.edad);
                                $('#direccionEditar').val(user.direccion);
                                $('#tutorEditar').val(user.tutor);
                                $('#celularEditar').val(user.celular);
                                $('#tipo_sangreEditar').val(user.tipo_sangre);
                                $('#TituloModal').text('Editar');
                                $('#ModalEditar').modal('show');
                            } else {
                                toastr.warning('No se encontro el Alumno', 'Error');
                            }
                        }
                    });
                }
            });

            // Abre el modal con los datos de edición
            // Abre el modal con los datos de edición
            $(document).on('click', '#edit-btn', function() {
                // Verifica si el botón tiene el atributo 'data-matricula'
                if (!$(this).data('matricula')) {
                    console.error('Error: El botón no tiene el atributo data-matricula.');
                    toastr.error('Error: No se pudo obtener la matrícula del alumno.');
                    return; // Salir si no hay matrícula
                }

                let id = $(this).data('matricula'); // Obtiene la matrícula
                console.log('Matrícula obtenida:', id); // Log de la matrícula

                $.ajax({
                    url: 'getUser.php', // Asegúrate de que esta ruta sea correcta
                    type: 'POST',
                    data: { matricula: id }, // Enviar matrícula como dato para buscar
                    success: function(response) {
                        console.log('Respuesta del servidor:', response); // Log de la respuesta

                        try {
                            let user = JSON.parse(response);
                            if (user) {
                                // Llenar el formulario de edición con los datos recibidos
                                $('#matriculaEditar').val(user.matricula);
                                $('#nombreEditar').val(user.nombre);
                                $('#edadEditar').val(user.edad);
                                $('#direccionEditar').val(user.direccion);
                                $('#tutorEditar').val(user.tutor);
                                $('#celularEditar').val(user.celular);
                                $('#tipo_sangreEditar').val(user.tipo_sangre);
                                $('#ModalEditar').modal('show'); // Mostrar el modal de edición
                            } else {
                                console.warn('No se encontró el Alumno en la respuesta.');
                                toastr.warning('No se encontró el Alumno', 'Error');
                            }
                        } catch (e) {
                            console.error('Error al parsear la respuesta JSON:', e);
                            toastr.error('Error al procesar la respuesta del servidor.');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Pintar el error en la consola
                        console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                        console.error('Detalles del error:', jqXHR.responseText); // Muestra el texto de respuesta del servidor
                        toastr.error('Error al obtener los datos del Alumno. Código de error: ' + jqXHR.status);
                    }
                });
            });

            // Evento para guardar los cambios en el modal de edición
            $('#guardarEdi').on('click', function(e) {
                e.preventDefault();
                var formData = new FormData($('#FormEditar')[0]);

                $.ajax({
                    url: 'edit.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#ModalEditar').modal('hide');
                        GuardarUsuarios(); // Recargar los datos de la tabla
                        Swal.fire({
                            icon: 'success',
                            title: 'Actualización exitosa',
                            text: '¡El Alumno fue actualizado correctamente!',
                        });
                        $('#FormEditar')[0].reset(); // Reinicia el formulario de edición
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo actualizar el Alumno',
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error en AJAX:", error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo actualizar el Alumno.',
                        });
                    }
                });
            });


            // Eliminar maestro usando SweetAlert2
            $(document).on('click', '#delete-btn', function() {
                let id = $(this).data('matricula');

                Swal.fire({
                    title: '¿Seguro que quieres eliminar este alumno?',
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
                            data: { matricula: id },
                            success: function(response) {
                                GuardarUsuarios(); // Función para recargar la tabla de usuarios
                                Swal.fire(
                                    '¡Eliminado!',
                                    'El alumno ha sido eliminado.',
                                    'success'
                                );                    
                            },
                            error: function(error) {
                                console.error("Error al eliminar alumno:", error);
                                Swal.fire(
                                    'Error',
                                    'Hubo un problema al eliminar el alumno.',
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