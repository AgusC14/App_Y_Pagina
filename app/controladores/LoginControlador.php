<?php
// app/controladores/LoginControlador.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Requerimos la conexión que está en la carpeta core
require_once __DIR__ . '/../core/Conexion.php';

$accion = $_GET['accion'] ?? '';

switch ($accion) {
    case 'registrar':
        procesarRegistro();
        break;
    case 'login':
        procesarLogin();
        break;
    default:
        header("Location: ../../publico/index.php");
        exit();
}

function procesarRegistro() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: ../../publico/index.php");
        exit();
    }

    $pdo = Conexion::conectar();

    // Captura y saneamiento básico de datos comunes
    $nombre    = trim($_POST['nombre']);
    $apellido  = trim($_POST['apellido']);
    $correo    = trim($_POST['correo']);
    $telefono  = trim($_POST['telefono']);
    $localidad = trim($_POST['localidad']);
    $contrasena= $_POST['contrasena'];
    $rol       = $_POST['rol']; // 'paciente' o 'enfermero'

    // 1. Validar que el correo no exista previamente
    $stmtCheck = $pdo->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $stmtCheck->execute([$correo]);
    if ($stmtCheck->fetch()) {
        die("Error: El correo electrónico ya se encuentra registrado.");
    }

    // 2. Encriptar la contraseña (Seguridad Obligatoria)
    $contrasenaHash = password_hash($contrasena, PASSWORD_BCRYPT);

    try {
        // Iniciamos una transacción para asegurarnos de que si algo falla con el enfermero, no se cree el usuario a medias
        $pdo->beginTransaction();

        // 3. Insertar en la tabla 'usuarios'
        $sqlUser = "INSERT INTO usuarios (nombre, apellido, correo, contrasena, telefono, localidad, rol) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtUser = $pdo->prepare($sqlUser);
        $stmtUser->execute([$nombre, $apellido, $correo, $contrasenaHash, $telefono, $localidad, $rol]);
        
        // Obtenemos el ID asignado automáticamente por el AUTO_INCREMENT
        $idUsuarioNuevo = $pdo->lastInsertId();

        // 4. Si el rol es enfermero, procesamos sus campos específicos y el archivo
        if ($rol === 'enfermero') {
            $matricula    = trim($_POST['matricula']);
            $tarifa       = floatval($_POST['tarifa']);
            $especialidad = trim($_POST['especialidad']);
            $zona_cobertura = trim($_POST['zona_cobertura']);
            
            // Manejo de la subida del documento
            $rutaDestinoDb = "";
            if (isset($_FILES['documento']) && $_FILES['documento']['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = $_FILES['documento']['name'];
                $tipoArchivo   = $_FILES['documento']['type'];
                $temporal      = $_FILES['documento']['tmp_name'];
                
                // Extraer extensión del archivo
                $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                // Generar un nombre único para evitar colisiones
                $nuevoNombreDoc = "titulo_" . $idUsuarioNuevo . "_" . time() . "." . $ext;
                
                // Carpeta física donde se guardan (asegurate de crearla en tu servidor: 'publico/uploads/')
                $carpetaDestino = __DIR__ . '/../../publico/uploads/';
                if (!is_dir($carpetaDestino)) {
                    mkdir($carpetaDestino, 0777, true);
                }

                if (move_uploaded_file($temporal, $carpetaDestino . $nuevoNombreDoc)) {
                    $rutaDestinoDb = 'uploads/' . $nuevoNombreDoc;
                } else {
                    throw new Exception("Error al mover el archivo adjunto al servidor.");
                }
            } else {
                throw new Exception("El título profesional es obligatorio para los enfermeros.");
            }

            // Insertar en 'enfermeros_detalles'
            $sqlEnf = "INSERT INTO enfermeros_detalles (id_enfermero, matricula, especialidad, tarifa, zona_cobertura, ruta_documento, estado_validacion) 
                       VALUES (?, ?, ?, ?, ?, ?, 0)";
            $stmtEnf = $pdo->prepare($sqlEnf);
            $stmtEnf->execute([$idUsuarioNuevo, $matricula, $especialidad, $tarifa, $zona_cobertura, $rutaDestinoDb]);
        }

        // Si todo salió bien, consolidamos los cambios en la base de datos
        $pdo->commit();

        // Autologin e inicio de sesión automática tras registrarse
        $_SESSION['usuario'] = $nombre;
        $_SESSION['usuario_id'] = $idUsuarioNuevo;
        $_SESSION['usuario_rol'] = $rol;

        header("Location: ../../publico/index.php");
        exit();

    } catch (Exception $e) {
        // Si algo se rompió, volvemos atrás el estado de la DB
        $pdo->rollBack();
        die("Error crítico durante el registro: " . $e->getMessage());
    }
}

function procesarLogin() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: ../../publico/index.php");
        exit();
    }

    $pdo = Conexion::conectar();
    $correo     = trim($_POST['correo']);
    $contrasena = $_POST['contrasena'];

    // Buscar el usuario por correo
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch();

    // Verificar si existe y si la contraseña coincide con el Hash seguro
    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        // Guardamos las variables de sesión que tu index.php ya sabe leer
        $_SESSION['usuario'] = $usuario['nombre'];
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_rol'] = $usuario['rol'];

        header("Location: ../../publico/index.php");
        exit();
    } else {
        die("Error: Credenciales incorrectas o el usuario no existe.");
    }
}