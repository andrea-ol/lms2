<?php
session_start();

if(!isset($_SESSION['username']) && isset($_SESSION['user'])){
    header("Location: resultados.php");
}
$user = $_SESSION['user'];
$id_user = $user->id;
$username = $user->username;
$curso = $_GET['id_curso'];

include 'header.php';
// llamar conexion a bases de datos
require_once 'db_config.php';

?>
<main>
<h1 class="mt-4">Centro de calificaciones Competencias</h1>
    <!-- boton regresar  -->

        <head>
            <style>
        .hidden-div {
            display: none;
        }
            </style>
        </head>
        
        <div class="container-fluid px-4">
            <div class=" hidden-div container-fluid inline-flex">
            <img src="public/assets/img/icno-de-regresar.svg" alt="Ícono de regresar" id="back-button">
            </div>

            <div class="container-fluid inline-flex">
                <img src="public/assets/img/icno-de-regresar.svg" alt="Ícono de regresar" onclick="redirectToCompetencias('<?= $curso; ?>')">
                <a href="index.php"></a>
                <p>Regresar</p>
                <script>function redirectToCompetencias(curso) {window.location.href = `competencias.php?id_curso=${curso}`;}</script>
            </div>
        
        <div class="container-icono-con-texto d-flex">
                <button type="submit" class="icono-con-texto" name ="id_curso" onclick="redirectToActivity('<?= $curso; ?>')">
                    <img src="public/assets/img/evaluaciones.svg" alt="Ícono de evaluación" id="icono-evaluacion">
                    <p>Actividades</p>
                </button>

                <script>function redirectToActivity(curso) {window.location.href = `actividades.php?id_curso=${curso}`;}</script>
        
                <?php 
                $rol_user = $user->shortname;
                if ($rol_user == 'editingteacher') {?>

                    <button class="icono-con-texto" id="resultadosbutton" onclick="showAlert()">
                        <img src="public/assets/img/resultados.svg" alt="Ícono de resultados" id="icono-resultados">
                        <p>Enviar a SOFIA</p>
                    </button>
                <?php }?>
        </div>

        <div class="card m-4">
            <div class="card-body" id="resultadoap-card">
                <!-- METODO POST A TRAVES DE FORM PARA UPDATE DE LA DATA -->
                <?php 
                $rol_user = $user->shortname;
                if ($rol_user == 'editingteacher') {?>


                    <form method="POST" name="edit_id" id="edit_id" action="actualizar_list.php">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr id="resultados-thead">
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
                            WHERE mc.id = ".$curso." AND r.shortname = 'student'");
                            $courses = $sentencia->fetchAll(PDO::FETCH_OBJ);

                            // Recorrido de los datos obtenidos
                            foreach ($courses as $course) {
                                $id_user=$course->id;
                                $firstname = $course->firstname;
                                $lastname = $course->lastname;
                                $reaprendizaje = $course->reaprendizaje;
                                $observacion = $course->descripcionra;
                                $rea_nombre = $course->rea_nombre;
                                $rea_a=$course->rea_id;
                            ?>
                                <tr>
                                    <td><?= $rea_a?></td>
                                    <td><?= $firstname . ' ' . $lastname; ?></td>
                                    <td><?= $rea_nombre?></td>
                                    <td>
                                        <!-- HABILITAR CAMPO RESULTADO DE APRENDIZAJE -->
                                        <input type="text" name="edit_calificacion[]" id="edit_calificacion"value="<?= $reaprendizaje; ?>">
                                    
                                    </td>
                                    <td> 
                                        <input type="hidden" name="user_id[]" value="<?= $id_user; ?>">
                                        <input type="hidden" name="course_id[]" value="<?= $curso; ?>">
                                        <input type="text" name="edit_observacion[]" id="edit_observacion" value="<?= $observacion; ?>">
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Aprendiz</th>
                                    <th>Resultado aprendizaje</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div style="text-align:left;">
                                <!-- BOTON PARA MANEJO DE DATA A POSTGRES -->
                                <button type="submit" style="display:flexbox;" class="btn btn-success">Guardar Cambios</button>
                            </div>
                        </form>
                        <?php 
                } 
                        if ($rol_user == 'student'  && $id_user != 2) {
                        $rol_user = $user->shortname;
                        ($rol_user == 'student' && $id_user != 2);?>
                            <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr id="resultados-thead">
                                    <th>Codigo </th>
                                    <th>Aprendiz</th>
                                    <th>Resultado de Aprendizaje</th>
                                    <th>Calificación</th>
                                    <th>Observación</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php

                                $sentencia = $conn->query("SELECT distinct u.id, u.firstname, u.lastname, u.email,e.courseid, mc.fullname, r.shortname, bc.reaprendizaje,bc.rea_id, bc.descripcionra, bc.rea_nombre
                                FROM mdl_block_califica bc
                                JOIN mdl_user u ON u.id = bc.userid
                                JOIN mdl_user_enrolments ue ON ue.userid = u.id
                                JOIN mdl_enrol e ON e.id = ue.enrolid
                                JOIN mdl_role_assignments ra ON ra.userid = u.id 
                                JOIN mdl_course mc ON mc.id = e.courseid
                                JOIN mdl_role r ON r.id = ra.roleid
                                WHERE mc.id = ".$curso." AND r.shortname = 'student' AND u.id = ".$user->id);

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
                                            <tr> 
                                                <td><?= $rea_a?></td>                          
                                                <td><?= $firstname . ' ' . $lastname; ?></td>
                                                <td><?= $rea_nombre?></td>
                                                <td><?= $reaprendizaje; ?></td>
                                                <td><?= $observacion; ?></td>
                                                 
                                            </tr>
                                            <?php }  ?>
                            </tbody>
                        </table>
                <?php }?>
            </div>
        </div>
    </div>
</main>

<script>
function showAlert() {
    Swal.fire({
    title: "Esta seguro de querer enviar los datos a SOFIA?",
    footer: 'Nota: Una vez enviada la información, usted NO podra realizar ningun cambio, si desea relizar cambios posterior al envio, favor comunicarse al Soporte para ser atendido',
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: "Enviar",
    denyButtonText: `No enviar cambios`
    }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
        Swal.fire("Enviado!", "", "success");
    } else if (result.isDenied) {
        Swal.fire("No se realiza cambios en los resultados de aprendizaje", "", "info");
    }
    });
}
</script>
<!-- llamada Footer -->
<?php include 'footer.php';?>