
<?php
function obtenerIniciales($nombre) {
    $nombre = trim($nombre);
    $nombre = strtr($nombre, [
        "á"=>"a", "é"=>"e", "í"=>"i",
        "ó"=>"o", "ú"=>"u",
        "Á"=>"A", "É"=>"E", "Í"=>"I",
        "Ó"=>"O", "Ú"=>"U"
    ]);
    return strtoupper(substr($nombre, 0, 3));
}

function obtenerAnio($fecha) {
    return substr($fecha, 2, 2);
}

function obtenerMesDia($fecha) {
    return substr($fecha, 5, 2) . substr($fecha, 8, 2);
}

function generarClave($nombre, $fecha) {
    $iniciales = obtenerIniciales($nombre);
    $anio = obtenerAnio($fecha);
    $mesDia = obtenerMesDia($fecha);

    return $iniciales . $anio . $mesDia;
}

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $fecha = $_POST["fecha"];

    if (strlen($nombre) >= 3 && strlen($fecha) == 10) {
        $resultado = generarClave($nombre, $fecha);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generador de claves</title>
</head>
<body>

<h2>Generador de claves de identificación</h2>

<form method="POST">
    <label>Nombre completo:</label>
    <input type="text" name="nombre" required>

    <br><br>

    <label>Fecha de nacimiento:</label>
    <input type="date" name="fecha" required>

    <br><br>

    <button type="submit">Generar clave</button>
</form>

<?php
if ($resultado != "") {
    echo "<h3>Tu clave es: $resultado</h3>";
}
?>

</body>
</html>
