<?php

session_start();
// Verificar si el usuario está autenticado
if (isset($_SESSION['username']) && isset($_SESSION['user'])) {
// Se  almacena los datos que son obtenidos por medio de un arreglo
    $user = $_SESSION['user'];
    $id_user = $user->id;
    $username = $user->username;
    $competencia = $_GET['id_comp'];
    $curso = $_GET['curso'];
    
    
// llamada header
    include 'header.php';
// llamar conexion a bases de datos
    require_once 'db_config.php';
// Obtener el id del curso para traer las competencias.
    ?>

<main>
        <h1 class="mt-4">Centro de calificaciones</h1>
  <div class="container-fluid px-4">

  <div class="container-fluid inline-flex">
      <img src="public/assets/img/icno-de-regresar.svg" alt="Ícono de regresar" id="back-button">
      <p>Regresar</p>
  </div>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">RESULTADOS DE APRENDIZAJE</li>
        </ol>
        <!-- BOTONES PARA DIRECCIONAR A OTRAS PÁGINAS -->
       
        <div class="card mb-4">
            
            <div class="card-body">
                <!-- METODO POST A TRAVES DE FORM PARA UPDATE DE LA DATA -->
                <table id="example" class="display nowrap" style="width:100%">
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
                         <tr> <?php if ($reaprendizaje == 'A') { $colorStyle = 'background-color:#BCE2A8;'; } 
                         elseif ($reaprendizaje == 'D') { $colorStyle = 'background-color: #DF5C73;'; } 
                         else { $colorStyle = 'background-color:#FCE059;'; }
                          echo"</td>
                          <td>" . $rea_a . "</td>". "<td>" . $firstname . ' ' . $lastname . "</td> 
                          <td>" . $rea_nombre . "</td> 
                          <td style='" . $colorStyle . "'>" . $reaprendizaje . "
                         </td><td>" . $observacion . "</td>"; ?>
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
                    
            </div>
        </div>
    </div>
</main>

<!-- llamada Footer -->
<?php include 'footer.php';
} else {
    // Si no hay una sesión iniciada o datos del usuario, redirigir al usuario a otra página
    header("Location: http://localhost/zajuna/");
    exit();
}
?>
