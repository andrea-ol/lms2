<?php 

session_start(); 
// Verificar si el usuario está autenticado 

if (isset($_SESSION['username']) && isset($_SESSION['user'])) { 
    // Incluir archivos necesarios 
    include 'header.php'; 
    require_once 'db_config.php'; 
    // Obtener datos del usuario de la sesión 

    $user = $_SESSION['user']; 
    $rol_user = $user->shortname; 
    $id_user = $user->id; 
    $username = $user->username; 

    // Función para obtener las competencias 
    function obtenerCompetencias($curso, $conn) 
    { 
        $sql = "SELECT * FROM mdl_block_califica WHERE courseid = ?"; 
        $stmt = $conn->prepare($sql); 
        $stmt->execute([$curso]); 
        return $stmt->fetchAll(PDO::FETCH_OBJ); 
    } 

    // Función para mostrar las competencias 
    function mostrarCompetencias($competencias, $rol_user) 
    { 
        foreach ($competencias as $competencia) { 
            $id_curso = $competencia->courseid; 
            $nombre_competencia = $competencia->rea_nombre; 
    ?> 

            <div class="card-group" style="margin: 10px;"> 
                <div class="card"> 
                    <div class="card-body"> 
                        <br> 
                        <p class="card-text"> 
                            <?= 'ID CURSO: ' . $id_curso . '</br></br>' . 'COMPETENCIA: ' . '</br>' . $nombre_competencia; ?> 
                        </p> 

                        <?php if ($rol_user == 'editingteacher') { ?> 
                            <form method="POST" action="resultadoap.php"> 
                                <input type="hidden" name="id_curso" value="<?= $id_curso ?>"> 
                                <button type="submit" class="btn btn-success">CALIFICAR RESULTADO APRENDIZAJE</button> 
                                <button type="button" class="btn btn-success" onclick="redirectToVistaap('<?= $id_curso; ?>')">VER RESULTADO APRENDIZAJE</button> 
                            </form> 

                        <?php } elseif ($rol_user == 'student') { ?> 
                            <form method="POST" action="resultadoap.php"> 
                                <input type="hidden" name="id_curso" value="<?= $id_curso ?>"> 
                                <button type="submit" class="btn btn-success">Ver Calificaciones</button> 
                            </form> 
                        <?php } ?> 
                    </div> 
                </div> 
            </div> 
        <?php 
        } 
    } 

?> 
    <main> 
        <h1 class="mt-4">Centro de calificaciones Competencias</h1> 
        <div class="container-fluid px-4"> 
            <div class="container-fluid inline-flex"> 
                <img src="public/assets/img/icno-de-regresar.svg" alt="Ícono de regresar" id="back-button"> 
                <a href="index.php">Regresar</a> 
            </div> 

            <div class="card m-4"> 
                <h1 class="m-4">Competencias SofiaQA</h1> 
                <ol class="breadcrumb mb-4"> 
                    <li class="breadcrumb-item active">Bienvenido <?= $user->firstname . ' ' . $user->lastname; ?></li> 
                </ol> 
                <div class="card-body"> 
                    <?php 
                    if ($rol_user == 'editingteacher') { 
                        $curso = $_GET['id_curso']; 
                        mostrarCompetencias(obtenerCompetencias($curso, $conn), $rol_user); 

                    } elseif ($rol_user == 'student') { 
                        if (isset($_POST['id_curso'])) { 
                            $curso = $_POST['id_curso']; 
                            mostrarCompetencias(obtenerCompetencias($curso, $conn), $rol_user); 
                        } else { 
                            echo "No se proporcionó un ID de curso."; 
                        } 

                    } 

                    ?> 
                </div> 
            </div> 
        </div>
    </main> 
    <script> 

        function redirectToVistaap(idCurso) { 
            window.location.href = `vistaap.php?id_curso=${idCurso}`; 
        } 

    </script> 
<?php 
    include 'footer.php'; 
} else { 
    // Si no hay una sesión iniciada o datos del usuario, redirigir al usuario a otra página 
    header("Location: http://localhost/zajuna/"); 
    exit(); 
} 

?> 