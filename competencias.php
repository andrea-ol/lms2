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
?>
<main>
<h1 class="mt-4">Centro de calificaciones Competencias</h1>
    <div class="container-fluid px-4">

        <div class="container-fluid inline-flex">
            <img src="public/assets/img/icno-de-regresar.svg" alt="Ícono de regresar" onclick="redirectToIndex('')">
            <a href="index.php"></a>
            <p>Regresar</p>
            
            <script>function redirectToIndex() {window.location.href = `index.php`;}</script>
        </div>
        
    
        <div class="card m-4"> 
            <h1 class="m-4">Competencias SofiaQA</h1>
            <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">  Bienvenido <?php echo $user->firstname . ' ' . $user->lastname; // Se accede al arreglo y se imprime el dato requerido, en este caso hacemos el llamado del campo apellido  ?></li>
            </ol>
            <div class="card-body">
                <!-- METODO POST A TRAVES DE FORM PARA UPDATE DE LA DATA -->

                <?php 
                $rol_user = $user->shortname;

                if ($rol_user == 'editingteacher') {?>
                <form class="col" method="POST" name="edit_id" id="edit_id"
                >
                    <?php
                    
                  
                    // Consulta para unificacion de tablas y muestra de usuarios
                    $sql= ("SELECT * FROM mdl_block_califica where courseid = ". $curso);
                    $sentencia = $conn->query($sql);
                    $competencias = $sentencia->fetchAll(PDO::FETCH_OBJ);
                    // Recorrido de los datos obtenidos
                    foreach ($competencias as $competencia) {
                        $id_usuario = $competencia->userid;
                        $nombre_competencia = $competencia->rea_nombre;
                        $idcurso = $competencia ->courseid;

                        ?>
                        <div class="card-group" style="margin: 10px;">
                                    <div class="card" id="competencias-card">
                                        <div class="card-body">
                                            <br>
                                            <p class="card-text">

                                        <?= 'COMPETENCIA: ' . $nombre_competencia; ?>
                                        <input type="hidden" name="id_curso" value="<?php $idcurso; ?>">
                                    </p>
                                    <!-- <button type="submit" style="display:flexbox;" class="btn btn-success">CALIFICAR RESULTADO APRENDIZAJE</button> -->
                                    <button type="button" style="display:flexbox;" class="btn btn-success" onclick="redirectToResultado('<?= $idcurso; ?>')">CALIFICAR RESULTADO APRENDIZAJE</button>
                                    <button type="button" style="display:flexbox;" class="btn btn-success" onclick="redirectToVistaap('<?= $idcurso; ?>')">VER RESULTADO APRENDIZAJE</button>
                                </div>
                            </div>
                        </div>
                    <?php }  ?>
                </form>



                <?php } 

                    if ($rol_user == 'student') {?>
                        <form class="col" method="POST" name="edit_id" id="edit_id">
                            <?php
                            // Consulta para unificacion de tablas y muestra de usuarios
                            $sql= ("SELECT * FROM mdl_block_califica where courseid = ". $curso);
                            $sentencia = $conn->query($sql);
                            $competencias = $sentencia->fetchAll(PDO::FETCH_OBJ);
                            
                            // Recorrido de los datos obtenidos
                            foreach ($competencias as $competencia) {
                                $id_usuario = $competencia->userid;
                                $nombre_competencia = $competencia->rea_nombre;
                                $idcurso = $competencia ->courseid;

                                ?>
                                <div class="card-group" style="margin: 10px;">
                                    <div class="card" id="competencias-card">
                                        <div class="card-body">
                                            <br>
                                            <p class="card-text">

                                                <?= 'ID CURSO: '.$idcurso.'</br>'.'COMPETENCIA: '.'</br>' . $nombre_competencia; ?>
                                                <input type="hidden" name="id_curso" value="<?php $idcurso; ?>">
                                            </p>
                                            <!-- <button type="submit" style="display:flexbox;" class="btn btn-success">CALIFICAR RESULTADO APRENDIZAJE</button> -->                                            

                                            <button type="button" style="display:flexbox;" class="btn btn-success" onclick="redirectToVistaap('<?= $idcurso; ?>')">VER RESULTADO APRENDIZAJE</button>
                                        </div>
                                    </div>
                                </div>
                            <?php }  ?>
                        </form>



                        <?php }  ?>
            </div>
        </div>
    </div>
</main>

<script>function redirectToVistaap(idcurso) {window.location.href = `vistaap.php?id_curso=${idcurso}`;}</script>
<script>function redirectToResultado(idcurso) {window.location.href = `resultadoap.php?id_curso=${idcurso}`;}</script>

<!-- llamada Footer -->
<?php include 'footer.php';
} else {
    // Si no hay una sesión iniciada o datos del usuario, redirigir al usuario a otra página
    header("Location: http://localhost/zajuna/");
    exit();
}
?>