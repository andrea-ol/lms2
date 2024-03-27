<?php

session_start();
// Verificar si el usuario está autenticado
if (isset($_SESSION['username']) && isset($_SESSION['user'])) {
// Se  almacena los datos que son obtenidos por medio de un arreglo
    $user = $_SESSION['user'];
    $id_user = $user->id;
    $username = $user->username;
    $curso = $_GET['id_curso'];

// llamada header
    include 'header.php';
// llamar conexion a bases de datos
    require_once 'db_config.php';
// Obtener el id del curso para traer las competencias.
   

    ?>

<main>
 
        <h1 class="mt-4">Centro Calificaciones Zajuna V.1</h1>
        <div class="container-fluid px-4">

        <div class="container-fluid inline-flex" onclick="miFuncion()">
            <img src="public/assets/img/icno-de-regresar.svg" alt="Ícono de regresar" id="back-button">
            <a   href="resultadoap.php" ></a>
            <p>Regresar</p>
        </div>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Bienvenido <?php echo $user->firstname . ' ' . $user->lastname; // Se accede al arreglo y se imprime el dato requerido, en este caso hacemos el llamado del campo apellido  ?></li>
        </ol>

        <div class="card mb-4">
            <div class="card-body">
            <?php
                if ($username == 'admin') {?>
                    <?php
                    // Consulta para unificacion de tablas y muestra de usuarios
                        $sentencia = $conn->query("SELECT * FROM mdl_block_califica where courseid = $curso ORDER BY categoryid ASC");
                        $courses = $sentencia->fetchAll(PDO::FETCH_OBJ);

                        // Recorrido de los datos obtenidos
                        foreach ($courses as $course) {
                            
                            $idcurso = $course->id;
                            $name_course = $course->fullname;
                            $nombre_comp = $course->cpr_nombre_competencia;
                            ?>
                        <div class="card-group" style="margin: 10px;">
                                    <div class="card" id="competencias-card">
                                        <div class="card-body">
                                            <br>
                                            <p class="card-text">
                                             <?php echo $name_course; ?></p>
                                            <p class="card-text"> <?php echo $nombre_comp; ?></p>
                                    <br>
                                    <button type="button" style="display:flexbox;" class="btn btn-success" onclick="redirectToResultados('<?= $idcurso; ?>')">VER RESULTADOS DE APRENDIZAJE</button>

                                </div>
                            </div>
                        </div>
                        <?php }}?>
            </div>
        </div>
    </div>
</main>
<script>function redirectToResultados(idcurso) {window.location.href = `resultados.php?id_comp=${idcurso}`;}</script>

<!-- llamada Footer -->
<?php include 'footer.php';
} else {
    // Si no hay una sesión iniciada o datos del usuario, redirigir al usuario a otra página
    header("Location: login.php");
    exit();
}
?>


