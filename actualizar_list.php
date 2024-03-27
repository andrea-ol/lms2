<?php
require_once 'db_config.php'; 


// SE RECIBEN LOS DATOS ENVIADOS POR EL FORMULARIO
$user_list = $_POST['user_id'];  // USER ID
$observations = $_POST['edit_observacion']; // DESCRIPCION RESULTADO APRENDIZAJE - descripcionra
$califications = $_POST['edit_calificacion']; // RESULTADO APRENDIZAJE - reaprendizaje
$curso = $_POST['course_id'];
$idcurso = $curso[0];

// SE RECORRE ARREGLO DE DATOS A TRAVES DE UN FOR PARA LUEGO REALIZAR EL UPDATE EN LA BD
for ($i = 0; $i < count($user_list); $i++) {
    
    $update_query = $conn->query("UPDATE mdl_block_califica SET reaprendizaje = '$califications[$i]', descripcionra = '$observations[$i]' WHERE userid = '$user_list[$i]'");
}

// mensaje actualización exitosa
$mensaje = "LA ACTUALIZACIÓN DEL CENTRO DE CALIFICACIONES SE HA REALIZADO CON ÉXITO";
        echo "<script type='text/javascript'>
        alert('$mensaje');
        window.location.href = `resultadoap.php?id_curso=${idcurso}`;
        </script>";

?>