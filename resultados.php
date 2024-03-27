<?php

session_start();
// Verificar si el usuario está autenticado
if (isset($_SESSION['username']) && isset($_SESSION['user'])) {
// Se  almacena los datos que son obtenidos por medio de un arreglo
    $user = $_SESSION['user'];
    $id_user = $user->id;
    $username = $user->username;
    $competencia = $_GET['id_comp'];

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
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                              
                                <th>USUARIO</th>
                                <th>RESULTADO APRENDIZAJE</th>
                                <th>DESCRIPCIÓN</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php

                            // Consulta para unificacion de tablas y muestra de usuarios
                            $sentencia = $conn->query("SELECT distinct u.id as id_user,u.firstname, u.lastname, mc.id, mbc.reaprendizaje, mbc.descripcionra, mbc.categoryid, e.courseid
                            FROM mdl_block_califica mbc
                            JOIN mdl_user u on u.id = mbc.userid
                            JOIN mdl_user_enrolments ue ON ue.userid = u.id
                            JOIN mdl_enrol e ON e.id = ue.enrolid
                            JOIN mdl_course mc ON mc.id = e.courseid
                            WHERE mbc.enrolid = 1 AND mbc.categoryid =  $competencia
                            ORDER BY id ASC");
                            $courses = $sentencia->fetchAll(PDO::FETCH_OBJ);

                            // Recorrido de los datos obtenidos
                            foreach ($courses as $course) {
                   
                                $id_user = $course->id_user;
                                $firstname = $course->firstname;
                                $lastname = $course->lastname;
                                $reaprendizaje = $course->reaprendizaje;
                                $observacion = $course->descripcionra;
                            ?>

                                <tr>
                                    <td><?= $firstname . ' ' . $lastname; ?></td>
                                    <td> <!-- HABILITAR CAMPO RESULTADO DE APRENDIZAJE -->
                                        <input type="text" name="edit_calificacion[]" id="edit_calificacion" value="<?= $reaprendizaje; ?>">
                                        <input type="hidden" name="user_id[]" value="<?= $id_user; ?>">
                                    </td>
                                    <td>
                                        <!-- HABILITAR CAMPO OBSERVACIÓN -->
                                        <input type="text" name="edit_observacion[]" id="edit_observacion" value="<?= $observacion; ?>">

                                    </td>
                                </tr>
                            <?php }  ?>

                        </tbody>
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
