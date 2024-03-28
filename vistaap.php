<?php
session_start();


if (!isset($_SESSION['username']) && isset($_SESSION['user'])) {
    header("Location: resultados.php");
}
$user = $_SESSION['user'];
$id_user = $user->id;
$username = $user->username;
$curso = $_GET['id_curso'];


// llamada header
include 'header.php';
// llamar conexion a bases de datos
require_once 'db_config.php';


?>
<main>
    <h1 class="mt-4">Centro de calificaciones Competencias</h1>
    <div class="container-fluid px-4">
        <h1 class="m-4">Resultados de Aprendizajes </h1>
        <!-- boton regresar  -->
        <div href="competencias.php" class="container-fluid inline-flex">
            <img src="public/assets/img/icno-de-regresar.svg" alt="Ícono de regresar" id="back-button">
            <p>Regresar</p>
        </div>
        <div class="container-icono-con-texto d-flex">
        <button type="submit" class="icono-con-texto" name ="id_curso" onclick="redirectToActivity('<?= $curso; ?>')">
                    <img src="public/assets/img/evaluaciones.svg" alt="Ícono de evaluación" id="icono-evaluacion">
                    <p>Actividades</p>
        </button>

        <script>function redirectToActivity(curso) {window.location.href = `actividades.php?id_curso=${curso}`;}</script>

        </div>
        <div class="card m-4">
            <div class="card-body" id="vistaap-card">
                <!-- METODO POST A TRAVES DE FORM PARA UPDATE DE LA DATA -->
                <?php
                $rol_user = $user->shortname;
                if ($rol_user == 'editingteacher' && $id_user != 2) { ?>
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr id="vistaap-thead">
                                    <th>Codigo </th>
                                    <th>Aprendiz</th>
                                    <th>Resultado de Aprendizaje</th>
                                    <th>Calificación</th>
                                    <th>Observación</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                // Consulta para unificacion de tablas y muestra de usuarios
                                $sentencia = $conn->query("SELECT distinct u.id, u.firstname, u.lastname, u.email,e.courseid, mc.fullname, r.shortname, bc.reaprendizaje, bc.descripcionra, bc.rea_nombre, bc.rea_id
                                FROM mdl_block_califica bc
                                JOIN mdl_user u ON u.id = bc.userid
                                JOIN mdl_user_enrolments ue ON ue.userid = u.id
                                JOIN mdl_enrol e ON e.id = ue.enrolid
                                JOIN mdl_role_assignments ra ON ra.userid = u.id 
                                JOIN mdl_course mc ON mc.id = e.courseid
                                JOIN mdl_role r ON r.id = ra.roleid
                                WHERE mc.id = ".$curso." AND r.shortname = 'student'");
                                $courses = $sentencia->fetchAll(PDO::FETCH_OBJ);

                                // Recorrido de los datos obtenidos
                                foreach ($courses as $course) {
                                    $firstname = $course->firstname;
                                    $lastname = $course->lastname;
                                    $reaprendizaje = $course->reaprendizaje;
                                    $observacion = $course->descripcionra;
                                    $rea_nombre = $course->rea_nombre;
                                    $rea_a=$course->rea_id;

                                ?>
                                    <!-- SEMAFORIZACION PARA VISTA RESULTADO APRENDIZAJE -->
                        <tr> <?php if ($reaprendizaje == 'A') { $colorStyle = 'background-color:#BCE2A8;'; } elseif ($reaprendizaje == 'D') { $colorStyle = 'background-color: #DF5C73;'; } else { $colorStyle = 'background-color:#FCE059;'; }
                        echo"</td>"; echo "<td>" . $rea_a . "</td>". "<td>" . $firstname . ' ' . $lastname . "</td>"; echo "<td>" . $rea_nombre . "</td>"; echo "<td style='" . $colorStyle . "'>" . $reaprendizaje . 
                        "</td>"; echo "<td>" . $observacion . "</td>"; ?>

                                <?php } ?>
                            </tbody>
                            
                            <tfoot>
                                <tr>

                                    <th>Aprendiz</th>
                                    <th>Resultado aprendizaje</th>
                                    <th>Resultado aprendizaje</th>
                                    <th>Resultado aprendizaje</th>
                                </tr>
                            </tfoot>
                        </table>

                <?php
                } else { ?>
                <?php
                    $rol_user = $user->shortname;
                    ($rol_user == 'student' && $id_user != 2);
                    // FUNCION PARA ESTUDIANTE PARA QUE SOLO VEA SUS RESULTADOS DE APRENDIZAJE
                    ?>
                    <form method="POST" name="edit_id" id="edit_id" action="actualizar_list.php">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr id="vistaap-thead">
                                    <th>Codigo </th>
                                    <th>Aprendiz</th>
                                    <th>Resultado de Aprendizaje</th>
                                    <th>Calificación</th>
                                    <th>Observación</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                // Consulta para unificacion de tablas y muestra de usuarios
                                $sentencia = $conn->query("SELECT distinct u.id, u.firstname, u.lastname, u.email,e.courseid, mc.fullname, r.shortname, bc.reaprendizaje,bc.rea_id, bc.descripcionra, bc.rea_nombre
                                FROM mdl_block_califica bc
                                JOIN mdl_user u ON u.id = bc.userid
                                JOIN mdl_user_enrolments ue ON ue.userid = u.id
                                JOIN mdl_enrol e ON e.id = ue.enrolid
                                JOIN mdl_role_assignments ra ON ra.userid = u.id 
                                JOIN mdl_course mc ON mc.id = e.courseid
                                JOIN mdl_role r ON r.id = ra.roleid
                                WHERE mc.id = ".$curso." AND r.shortname = 'student' AND u.id = $user->id");
                                $courses = $sentencia->fetchAll(PDO::FETCH_OBJ);


                                // Recorrido de los datos obtenidos
                                foreach ($courses as $course) {
                                    $firstname = $course->firstname;
                                    $lastname = $course->lastname;
                                    $reaprendizaje = $course->reaprendizaje;
                                    $observacion = $course->descripcionra;
                                    $rea_nombre = $course->rea_nombre;
                                    $rea_a=$course->rea_id;

                                ?>
                                    <!-- SEMAFORIZACION PARA VISTA RESULTADO APRENDIZAJE -->
                        <tr> <?php if ($reaprendizaje == 'A') { $colorStyle = 'background-color:#BCE2A8;'; } elseif ($reaprendizaje == 'D') { $colorStyle = 'background-color: #DF5C73;'; } else { $colorStyle = 'background-color:#FCE059;'; }
                        echo "<td>" . $rea_a . "</td>"."<td>" . $firstname . ' ' . $lastname . "</td>"; echo "<td>" . $rea_nombre . "</td>"; echo "<td style='" . $colorStyle . "'>" . $reaprendizaje . "</td>"; echo "<td>" . $observacion . "</td>"; ?>

                                <?php } ?>
                            </tbody>


                            <tfoot>
                                <tr>
                                    <th>Aprendiz</th>
                                    <th>Resultado aprendizaje</th>
                                </tr>
                            </tfoot>
                        </table>

                <?php } ?>
            </div>
        </div>
    </div>
</main>
<!-- llamada Footer -->
<?php include 'footer.php'; ?>