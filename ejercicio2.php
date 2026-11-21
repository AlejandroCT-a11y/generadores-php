<?php
function limpiarNombre($nombre) {
    $nombre = trim($nombre);
    return str_replace(" ", "", $nombre);
}
function convertirMinusculas($texto) {
    $texto = strtr($texto, [
        "á"=>"a", "é"=>"e", "í"=>"i",
        "ó"=>"o", "ú"=>"u", "ñ"=>"n",
        "Á"=>"A", "É"=>"E", "Í"=>"I",
        "Ó"=>"O", "Ú"=>"U", "Ñ"=>"N"
    ]);
    return strtolower($texto);
}
function obtenerInstitucion($institucion) {
    $institucion = convertirMinusculas(trim($institucion));
    return substr($institucion, 0, 2);
}
function obtenerAnio($anio) {
    return substr($anio, -2);
}

function generarUsuario($nombre, $institucion, $anio) {
    $nombre = limpiarNombre($nombre);
    $nombre = convertirMinusculas($nombre);
    $escuela = obtenerInstitucion($institucion);
    $anioCorto = obtenerAnio($anio);
    return $nombre . $escuela . $anioCorto;
}
$resultado = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $institucion = $_POST["institucion"];
    $anio = trim($_POST["anio"]);
    if (strlen(trim($nombre)) > 0 &&
        strlen(trim($institucion)) >= 2 &&
        strlen($anio) == 4 &&
        ctype_digit($anio)) {

        $resultado = generarUsuario(
            $nombre, $institucion, $anio
        );
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generador de usuarios</title>
</head>
<body>
<h2>Generador de nombres de usuario</h2>
<form method="POST">
    <label>Nombre completo:</label>
    <input type="text" name="nombre" required>
    <br><br>
    <label>Institución educativa:</label>
    <input type="text" name="institucion" required>
    <br><br>
    <label>Año de ingreso:</label>
    <input type="number" name="anio" required>
    <br><br>
    <button type="submit">Generar usuario</button>
</form>
<?php
if ($resultado != "") {
    echo "<h3>Tu usuario es: " .
         htmlspecialchars($resultado, ENT_QUOTES, "UTF-8") .
         "</h3>";
}
?>
</body>
</html>
