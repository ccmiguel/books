<?php
// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Definir la operación para el controlador
    $ope = 'register';
    // Obtener los datos del formulario
    $p_email = $_POST['email'];
    $p_username = $_POST['username'];
    $p_user_password = $_POST['user_password'];
    $p_user_password1 = $_POST['user_password_retype'];

    // Validar
    try {
        // Datos a enviar al controlador en formato JSON
        $data = [
            'ope' => $ope,
            'email' => $p_email,
            'username' => $p_username,
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

        // URL del controlador para el registro
        $url = HTTP_BASE . '/controller/LoginController.php';
        // Realizar la solicitud POST al controlador y obtener la respuesta
        $response = file_get_contents($url, false, $context);

        // Verificar si hubo un error al obtener la respuesta
        if ($response === FALSE) {
            throw new Exception('Error fetching the response');
        }

        // Decodificar la respuesta JSON obtenida
        $result = json_decode($response, true);

        // Verificar el resultado del registro
        if ($result['ESTADO']) {
            echo "<script>alert('Operación realizada exitosamente.');</script>";
        } else {
            echo "<script>alert('Hubo un problema, contacte al administrador.');</script>";
        }
    } catch (Exception $e) {
        // Capturar y manejar cualquier excepción que pueda ocurrir
        echo "<script>alert('Hubo un problema, contacte al administrador. " . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library management system | Registration Page</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="public/css/estilo2.css" type="text/css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>dist/css/adminlte.min.css?v=3.2.0">
</head>
<body class="register-page" style="min-height: 569.6px;">
    <div class="register-box">
        <div class="register-logo">
            <a class="titulo"><b>Library management system</b></a>
        </div>
        <div class="card">
            <div class="card-body">
                <p class="login-box-msg">Sign Up System</p>
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
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
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
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Retype password" name="user_password_retype" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-warning btn-block">Register</button>
                        </div>
                    </div>
                </form>
                <a href="<?php echo HTTP_BASE . '/login'; ?>" class="text-center">I already have an account, log in</a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>dist/js/adminlte.min.js?v=3.2.0"></script>
</body>
</html>
