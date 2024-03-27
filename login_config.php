<?php
require_once 'db_config.php';
// Se declara una variable donde almacenara el dato que se ingresa en el login y luego se envia  con el metodo POST
$user_id = base64_decode($_GET['user']);

// Con el el dato almacenado se realiza la consulta que permite obtener solo los datos del ususario logueado
$query = $conn->query("SELECT DISTINCT  u.id,u.username,u.firstname,u.lastname,u.email,r.shortname
                            FROM mdl_user u
                            JOIN mdl_role_assignments ra ON ra.userid = u.id 
                            JOIN mdl_role r ON r.id = ra.roleid 
                            WHERE u.id ='$user_id'");
        $user = $query->fetch(PDO::FETCH_OBJ);
  
 if ($user->id != 2) {
              // Se valida que el dato exista en la BD
        session_start();
        $_SESSION['username'] = $user->username;
        $_SESSION['user'] = $user;
        header("Location: index.php");
        
 }else {
    $query = $conn->query("SELECT * FROM mdl_user WHERE id ='$user_id'");
                           
        $user = $query->fetch(PDO::FETCH_OBJ);
         // Se valida que el dato exista en la BD
            // Se inicia la sesión y se envia la data que sera manipulada.
            session_start();
            $_SESSION['username'] = $user->username;
            $_SESSION['user'] = $user;
            header("Location: indexadmin.php");
        
 }
?>