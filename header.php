<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="public/css/style.min.css" rel="stylesheet" />
    <link href="public/css/styles.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/2.0.0/css/colReorder.dataTables.css">
    <script src="public/js/all.js" crossorigin="anonymous"></script>


    <title>Calificaciones</title>
</head>


<body class="sb-nav-fixed">
    <!-- logo gov.co -->
    <!-- <nav class="banner1">
        <img src="public/assets/img/govco.svg" alt="Ícono de logo gov.co" id="#">
    </nav> -->
    <!-- logo colombia viva y sena -->
    <!-- <nav class="banner2">
        <img src="public/assets/img/logo-potencia.svg" alt="Ícono de logo colombia viva" id="#">
        <img src="public/assets/img/head-sena.svg" alt="Ícono de sena" id="#">
    </nav> -->


    <nav class="sticky-top p-4 navbar navbar-expand navbar-dark bg-dark">


        <!-- Navbar Brand-->
        <a id="zajuna-link" class="navbar-brand ps-5" href="http://localhost/zajuna/">ZAJUNA</a>
        <div class="navbar-brand d-inline-flex">
            <a class="navbar-brand ps-4" href="http://localhost/zajuna/my/">Área personal</a>
            <a class="navbar-brand ps-4" href="http://localhost/zajuna/my/courses.php">Mis cursos</a>
            <a class="navbar-brand ps-4" href="https://oferta.senasofiaplus.edu.co/sofia-oferta/">Accede a SOFIA</a>
        </div>
        <!-- Sidebar Toggle-->
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <nav class="logo-sena">
            <img src="public/assets/img/head-sena.svg" alt="Ícono de sena" id="logo-sena-img">
        </nav>


        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="http://localhost/zajuna/user/profile.php">Perfil</a></li>
                    <li><a class="dropdown-item" href="http://localhost/zajuna/grade/report/overview/index.php">Calificaciones</a></li>
                    <li><a class="dropdown-item" href="http://localhost/zajuna/calendar/view.php?view=month">Calendario</a></li>
                    <li><a class="dropdown-item" href="http://localhost/zajuna/user/files.php">Archivos Privados</a></li>
                    <li><a class="dropdown-item" href="http://localhost/zajuna/reportbuilder/index.php">Infomes</a></li>
                    <li><a class="dropdown-item" href="http://localhost/zajuna/user/preferences.php">Preferencias</a></li>
                    <!-- <li><a class="dropdown-item" href="#!">Cambio rol a...</a></li> -->
                    <li>
                        <hr class="dropdown-divider" />
                    </li>


                    <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav_content">
<!-- 
    <script>
        // Función para obtener la clave de sesión de Moodle
        function obtenerSesskey() {
            // Realiza una solicitud AJAX a la página de inicio de sesión de Moodle para obtener la clave de sesión
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://zajuna/login/index.php', true); // Reemplaza 'tu_sitio_moodle' con la URL de tu Moodle
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Extrae la clave de sesión del contenido de la página
                    var content = xhr.responseText;
                    var match = content.match(/name="sesskey" value="([^"]+)"/);
                    if (match && match[1]) {
                        var sesskey = match[1];
                        // Redirige al usuario a la URL de cierre de sesión con la clave de sesión
                        window.location.href = 'http://zajuna/login/logout.php?sesskey=' + sesskey;
                    } else {
                        console.error('No se pudo encontrar la clave de sesión.');
                    }
                } else {
                    console.error('Error al cargar la página de inicio de sesión.');
                }
            };
            xhr.onerror = function() {
                console.error('Error de red al cargar la página de inicio de sesión.');
            };
            xhr.send();
        }

        // Llama a la función para obtener la clave de sesión al cargar la página
        obtenerSesskey();
    </script> -->