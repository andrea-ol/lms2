<?php
// Iniciar sesión si no está iniciada (puedes implementar tu propio sistema de sesión)
session_start();
// Verificar si el usuario está autenticado
if (isset($_SESSION['username']) && isset($_SESSION['user'])) {
// Se  almacena los datos que son obtenidos por medio de un arreglo
    $user = $_SESSION['user'];
    $id_user = $user->id;
    $username = $user->username;
// llamada header
    include 'header.php';
// llamar conexion a bases de datos
    require_once 'db_config.php';
    ?>
<main>
<h1 class="mt-4">Centro de calificaciones</h1>
    <div class="container-fluid px-4">
        <div class="container-fluid inline-flex" onclick="miFuncion()">
            <img src="public/assets/img/icno-de-regresar.svg" alt="Ícono de regresar" id="back-button">
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
                        $sentencia = $conn->query("SELECT * FROM mdl_course ORDER BY id ASC");
                        $courses = $sentencia->fetchAll(PDO::FETCH_OBJ);

                        // Recorrido de los datos obtenidos
                        foreach ($courses as $course) {
                            
                            $idcurso = $course->id;
                            $name_course = $course->fullname;
                            $short_name = $course->shortname;
                            ?>
                        <div class="card-group" style="margin: 10px;">
                                    <div class="card" id="competencias-card">
                                        <div class="card-body">
                                            <br>
                                            <input type="hidden" name="course_id" id="course_id" value="<?= $idcurso; ?>">
                                            <p class="card-text"><?php echo $name_course; ?></p>
                                            <br>
                                    <button type="button" style="display:flexbox;" class="btn btn-success" onclick="redirectToAdmincomp('<?= $idcurso; ?>')">Ver más sobre el curso</button>
                                    </div>
                            </div>
                        </div>
                    <?php }?>paa
                <?php }?>       
            </div>
        </div>
    </div>
</main>
<script>function redirectToAdmincomp(idcurso) {window.location.href = `admin_comp.php?id_curso=${idcurso}`;}</script>

<!-- llamada Footer -->
<?php include 'footer.php';
} else {
    // Si no hay una sesión iniciada o datos del usuario, redirigir al usuario a otra página
    header("Location: http://localhost/zajuna/");
    exit();
}
?>