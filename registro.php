<?php
// Configuración de la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$db = "registro_usuarios";

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validar datos básicos
if ($nombre && $email && $password) {
    // Encriptar contraseña
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insertar en la base de datos
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $password_hash);

    if ($stmt->execute()) {
        echo "<h2>Muchas gracias por registrarte en mi pagina web!!</h2>";
    } else {
        echo "<h2>Error al registrar: " . $stmt->error . "</h2>";
    }
    $stmt->close();
} else {
    echo "<h2>Por favor, completa todos los campos.</h2>";
}

$conn->close();
?>
