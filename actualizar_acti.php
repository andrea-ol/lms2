<?php
require_once 'db_config.php'; 
//$idcurso=$_GET['id'];

// SE RECIBEN LOS DATOS ENVIADOS POR EL FORMULARIO
$user = $_POST['user'];  
$cali_depro = $_POST['edit_calificacion2']; // CALIFICACION DEPROBADA
$cali_pend = $_POST['edit_calificacion3']; // CALIFICACION PENDIENTESS
$acti= $_POST['actividad']; // ACTIVIDAD A CALIFICAR
 // EdDITAR NOTA APROBADA

// SE RECORRE ARREGLO DE DATOS A TRAVES DE UN FOR PARA LUEGO REALIZAR EL UPDATE EN LA BD
for ($i = 0; $i < count($user); $i++) {
    $update_query = $conn->query("UPDATE mdl_quiz_grades SET grade = '$cali_depro[$i]' WHERE userid = '$user[$i]' AND quiz = '$acti[$i]'");
}



// mensaje actualización exitosa
$mensaje = "LA ACTUALIZACIÓN DEL CENTRO DE CALIFICACIONES SE HA REALIZADO CON ÉXITO";
        echo "<script type='text/javascript'>
        alert('$mensaje');
        window.location.href = 'resultados.php';
        </script>";

