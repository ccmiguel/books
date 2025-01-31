<?php
// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Definir la operación para el controlador
    $ope = 'login';
    // Obtener los datos del formulario
    $p_email = $_POST['email'];
    $p_user_password = $_POST['user_password'];

    // Intentar realizar la validación y autenticación
    try {
        // Datos a enviar al controlador en formato JSON
        $data = [
            'ope' => $ope,
            'email' => $p_email,
            'user_password' => $p_user_password,
        ];

        // Crear contexto de flujo para la solicitud POST
        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/json",
                'content' => json_encode($data),
            ]
        ]);

        // URL del controlador para la autenticación
        $url = HTTP_BASE . '/controller/LoginController.php';
        // Realizar la solicitud POST al controlador y obtener la respuesta
        $response = file_get_contents($url, false, $context);

        // Decodificar la respuesta JSON obtenida
        $result = json_decode($response, true);

        // Verificar el resultado de la autenticación
        if ($result['ESTADO'] && isset($result['DATA']) && !empty($result['DATA'])) {
            // Iniciar sesión y almacenar los datos del usuario
            $_SESSION['login'] = $result['DATA'][0];
            // Redirigir a la página de inicio si se ha iniciado sesión correctamente
            if (isset($_SESSION['login']['username'])) {
                echo "<script>alert('Acceso autorizado.');</script>";
                // Redirigir al usuario a la página de inicio
                echo '<script>window.location.href="' . HTTP_BASE . '/home";</script>';
            } else {
                echo "<script>alert('Acceso no autorizado.');</script>";
            }
        } else {
            // Mostrar mensaje de error si hubo un problema durante la autenticación
            echo "<script>alert('Hubo un problema, contacte al administrador.');</script>";
        }
    } catch (Exception $e) {
        // Capturar y manejar cualquier excepción que pueda ocurrir
        echo "<script>alert('Hubo un problema, contacte al administrador.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library management system | Log in</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="public/css/estilo1.css" type="text/css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>dist/css/adminlte.min.css?v=3.2.0">
</head>
<body class="login-page" style="min-height: 495.6px;">
    <div class="login-box">
        <div class="login-logo">
            <a class="titulo"><b>Library management system</b></a>
        </div>

        <div class="card">
            <div class="card-body">
                <p class="login-box-msg">Log In</p>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="user_password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <!-- Espacio para contenido adicional, si es necesario -->
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-warning btn-block">Log In</button>
                        </div>
                    </div>
                </form>
                <p class="mb-0">
                    <!-- Enlace para registrarse -->
                    <a href="<?php echo HTTP_BASE . '/register'; ?>" class="text-center">Sign Up</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>dist/js/adminlte.min.js?v=3.2.0"></script>
</body>
</html>
