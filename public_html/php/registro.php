<?php
//Se llama al archivo de la conexion a la base de datos
include('conexiondb.php');

//Se reciben los datos del formulario mediante las siguientes variables:
$nombre_completo = $_POST["nombre_completo"];
$grado_academico = $_POST["grado_academico"];
$ubicacion = $_POST["ubicacion"];
$institucion = $_POST["institucion"];
$linea_investigacion = $_POST["linea_investigacion"];
$correo = $_POST["correo"];


//Parte lógica del envio POST de los datos ingresados del formulario a la base de datos.
$query = "INSERT INTO registro_usuarios(nombre_completo, grado_academico, ubicacion, institucion, linea_investigacion, correo)
           VALUES('$nombre_completo', '$grado_academico', '$ubicacion', '$institucion', '$linea_investigacion', '$correo')";

//Verificar que el correo no se repita en la base de datos.
$verificar_correo = mysqli_query($conexion, "SELECT * FROM registro_usuarios WHERE correo = '$correo' ");

if(mysqli_num_rows($verificar_correo) > 0){
    echo '
    <script>
    alert("Este correo ya está registrado, intenta con otro diferente");
    window.location = "../registro.html";
    </script>
    ';
    exit();
}

$ejecutar = mysqli_query($conexion, $query);


if($ejecutar){
    echo '<script>
    alert("El registro ha sido almacenado exitosamente");
    window.location = "../registro.html";
    </script>';
}else{
    echo '<script>
    alert("El registro no ha sido almacenado exitosamente, inténtalo de nuevo");
    window.location = "../registro.html";
    </script>';
}

mysqli_close($conexion);

?>