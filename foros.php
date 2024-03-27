<?php
// llamada header
session_start();

if (!isset($_SESSION['username']) && isset($_SESSION['user'])) {

    header("Location: resultados.php");
}
$user = $_SESSION['user'];
$id_user = $user->id;
$username = $user->username;
$id_curso = $_GET['id_curso'];

include 'header.php';
require_once 'db_config.php'; // llamar conexion base de datos
?>
<main>
    <h1 class="mt-4">Centro de calificaciones Competencias</h1>
    <div class="container-fluid px-4">

        <div class="container-fluid inline-flex">
            <img src="public/assets/img/icno-de-regresar.svg" alt="Ícono de regresar" id="back-button">
            <a href="index.php"></a>
            <p>Regresar</p>
        </div>
        <div class="container-icono-con-texto d-flex">
                <button type="submit" class="icono-con-texto" name ="id_curso" onclick="redirectToActivity('<?= $id_curso; ?>')">
                    <img src="public/assets/img/evaluaciones.svg" alt="Ícono de evaluación" id="icono-evaluacion">
                    <p>Actividades</p>
                </button>
            <button class="icono-con-texto" onclick="miFuncion()">
                <img src="public/assets/img/foros.svg" alt="Ícono de foros" id="icono-foros">
                <p>Blogs</p>
            </button>
            <button class="icono-con-texto" onclick="miFuncion()">
                <img src="public/assets/img/evidencias.svg" alt="Ícono de evidencias" id="icono-evidencias">
                <p>Evidencias</p>
            </button>
            <button class="icono-con-texto" onclick="miFuncion()">
                <img src="public/assets/img/wikis.svg" alt="Ícono de wikis" id="icono-wikis">
                <p>Wikis</p>
            </button>

            <script>function redirectToActivity(id_curso) {window.location.href = `actividades.php?id_curso=${id_curso}`;}</script>

        </div>
        <div class="card m-4">

            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">FOROS</li>
            </ol>

            <div class="card-body" id="actividades-card">
                <!-- METODO POST A TRAVES DE FORM PARA UPDATE DE LA DATA -->
                <form method="POST" name="edit_id" id="edit_id" action="actualizar_acti.php">
                    <div class="table-responsive">

                        <?php
                        $rol_user = $user->shortname;
                        if ($rol_user == 'editingteacher') {
                            $curso = $id_curso;
                            $titulos = $conn->query("SELECT name, id FROM mdl_forum WHERE course= " . $curso);
                            $actividades = $titulos->fetchAll(PDO::FETCH_OBJ);
                        ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr id="actividades-thead">
                                        <th>APRENDIZ</th>
                                        <?php
                                        foreach ($actividades as $actividad) :
                                        ?>
                                            <th>
                                                <div class="text-center"><?= $actividad->name; ?></div>
                                            </th>
                                        <?php endforeach ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $user_query = $conn->query("SELECT distinct u.id, u.firstname, u.lastname, u.email,e.courseid, mc.fullname, r.shortname
                                    FROM mdl_block_califica bc
                                    JOIN mdl_user u ON u.id = bc.userid
                                    JOIN mdl_user_enrolments ue ON ue.userid = u.id
                                    JOIN mdl_enrol e ON e.id = ue.enrolid
                                    JOIN mdl_role_assignments ra ON ra.userid = u.id 
                                    JOIN mdl_course mc ON mc.id = e.courseid
                                    JOIN mdl_role r ON r.id = ra.roleid
                                    WHERE mc.id = " . $curso . " AND r.shortname = 'student'");
                                    $users = $user_query->fetchAll(PDO::FETCH_OBJ);

                                    foreach ($users as $user) {
                                        $id_user = $user->id;
                                        $firstname = $user->firstname;
                                        $lastname = $user->lastname;
                                    ?>

                                        <tr>
                                            <td><?= $firstname . ' ' . $lastname; ?></td>

                                            <?php
                                            foreach ($actividades as $actividad) : ?>
                                                <td>
                                                    <?php
                                                    $q_gradess = $conn->query("SELECT DISTINCT userid, forum, grade FROM mdl_forum_grades WHERE userid = $user->id AND forum = $actividad->id");
                                                    $q_grades = $q_gradess->fetchAll(PDO::FETCH_OBJ);

                                                    if (!empty($q_grades)) {
                                                        foreach ($q_grades as $q_grade) {
                                                            $grad = $q_grade->grade;
                                                            if ($grad == 10.00000) {
                                                    ?>
                                                                <div class="d-gitd gap-2 col-8 mx-auto">
                                                                    <input disabled type="text" name="edit_calificacion[]" id="edit_calificacion" class="text-center" style="background-color:#BCE2A8" value="A"></input>
                                                                </div>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <div class="d-gitd gap-2 col-8 mx-auto">
                                                                    <input type="text" name="edit_calificacion2[]" id="edit_calificacion2" class="text-center" style="background-color:#DF5C73" value="<?php echo $grad; ?>"></input>

                                                                    <input type="hidden" name="curso_id[]" value="<?= $curso; ?>">
                                                                    <input type="hidden" name="user_id[]" value="<?= $user->id; ?>">
                                                                    <input type="hidden" name="actividad[]" value="<?= $actividad->id; ?>">

                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                    } else {
                                                        ?>
                                                        <div class="d-gitd gap-2 col-8 mx-auto">
                                                            <input type="text" name="edit_calificacion3[]" id="edit_calificacion3" class="text-center" style="background-color:#FCE059" value="-"></input>




                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                            <div style="text-align:left;">
                                <button type="submit" style="display:flexbox;" class="btn btn-success">Actualizar</button>
                            </div>
                    </div>
                </form>

            <?php } else {
                            $rol_user = $user->shortname;
                            ($rol_user == 'student');
                            $curso = $id_curso;
                            $titulos = $conn->query("SELECT name, id FROM mdl_forum WHERE course= " . $curso);
                            $actividades = $titulos->fetchAll(PDO::FETCH_OBJ);
            ?>
                <table class="table table-striped">
                    <thead>
                        <tr id="actividades-thead">
                            <th>APRENDIZ</th>
                            <?php
                            foreach ($actividades as $actividad) :
                            ?>
                                <th>
                                    <div class="text-center"><?= $actividad->name; ?></div>
                                </th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $user_query = $conn->query("SELECT distinct u.id, u.firstname, u.lastname, u.email,e.courseid, mc.fullname, r.shortname
                                 FROM mdl_block_califica bc
                                 JOIN mdl_user u ON u.id = bc.userid
                                 JOIN mdl_user_enrolments ue ON ue.userid = u.id
                                 JOIN mdl_enrol e ON e.id = ue.enrolid
                                 JOIN mdl_role_assignments ra ON ra.userid = u.id 
                                 JOIN mdl_course mc ON mc.id = e.courseid
                                 JOIN mdl_role r ON r.id = ra.roleid
                                 WHERE mc.id = " . $curso . " AND r.shortname = 'student' AND u.id = " . $user->id);
                            $users = $user_query->fetchAll(PDO::FETCH_OBJ);

                            foreach ($users as $user) {
                                $id_user = $user->id;
                                $firstname = $user->firstname;
                                $lastname = $user->lastname;
                        ?>
                            <tr>
                                <td><?= $firstname . ' ' . $lastname; ?></td>

                                <?php
                                foreach ($actividades as $actividad) : ?>
                                    <td>
                                        <?php
                                        $q_gradess = $conn->query("SELECT DISTINCT userid, forum, grade FROM mdl_forum_grades WHERE userid = $user->id AND forum = $actividad->id");
                                        $q_grades = $q_gradess->fetchAll(PDO::FETCH_OBJ);

                                        if (!empty($q_grades)) {
                                            foreach ($q_grades as $q_grade) {
                                                $grad = $q_grade->grade;
                                                if ($grad == 10.00000) {
                                        ?>
                                                    <div class="d-gitd gap-2 col-8 mx-auto">
                                                        <input disabled type="text" name="edit_calificacion[]" id="edit_calificacion" class="text-center" style="background-color:#BCE2A8" value="A"></input>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="d-gitd gap-2 col-8 mx-auto">
                                                        <input disabled type="text" name="edit_calificacion2[]" id="edit_calificacion2" class="text-center" style="background-color:#DF5C73" value="D"></input>
                                                    </div>
                                            <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <div class="d-gitd gap-2 col-8 mx-auto">
                                                <input disabled type="text" name="edit_calificacion3[]" id="edit_calificacion3" class="text-center" style="background-color:#FCE059" value="-"></input>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            </form>
        <?php } ?>
        </div>
    </div>
    </div>
</main>
<!-- llamada Footer -->
<?php include 'footer.php'; ?>