NUEVO BLOQUE CENTRO DE CALIFICACIONES

ESTA GUIA SE REALIZA PARA MOSTRAR PASO A PASO DE CONEXION A BASE DE DATOS LMS

PREREQUISITOS
BASE DE DATOS LMS CON POSTGRES VER 16.
SERVIDOR WEB CON PHP INSTALADO (VER 8.2.1.3) Y EXTENSIÓN PDO

Para conectarse a la base de datos del LMS usando PHP y PDO, deberás usar la clase PDO. Esta clase toma la siguiente forma:

$dbconn = new PDO("pgsql:host=hostname dbname=database", "username", "password");

Reemplaza los marcadores de posición con los valores reales de tu base de datos de LMS. Por ejemplo:

$dbconn = new PDO("pgsql:host=lms.example.com dbname=lmsdb", "lmsuser", "lmspassword");

Esto conectará a la base de datos del LMS en el host lms.example.com, usando la base de datos lmsdb, el nombre de usuario lmsuser y la contraseña lmspassword.

CONSULTAS A BASE DE DATOS --->

Una vez que estés conectado a la base de datos, puedes usar el método query() de la clase PDO para ejecutar consultas SQL contra la base de datos. Por ejemplo:

$result = $dbconn->query("SELECT * FROM mdl_user");

Esto ejecutará una consulta SELECT contra la tabla mdl_user en la base de datos del LMS.

------------------------------------------------------------------------------------
RECUPERACIÓN DE RESULTADOS (FETCH)

Después de ejecutar una consulta, puedes usar el método fetch() de la clase PDOStatement para recuperar los resultados. 

$courses = $sentencia->fetchAll(PDO::FETCH_OBJ);


-------------------------------------------------------------------------------------

UPDATE REGISTROS EN TABLA MDL_BLOCK_CALIFICA

AQUI SE ALIMENTARÁ LA DOCUMENTACIÓN PARA EL POST DE INFORMACIÓN DENTRO DE LA TABLA PERSONALIZADA EN EL LMS, EN ESTE CASO LLAMADA MLD_BLOCK_CALIFICA