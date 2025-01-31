<?php

header("Access-Control-Allow-Origin: *"); // Permite que cualquier origen acceda a este recurso.

header("Access-Control-Allow-Methods: PUT, GET, POST"); // Permite los métodos PUT, GET y POST.

header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); // Permite ciertos encabezados en las solicitudes.

header("Content-Type: application/json; charset=UTF-8"); // Define el tipo de contenido como JSON y el conjunto de caracteres como UTF-8.


session_start(); // Inicia una sesión en PHP.


require_once($_SERVER['DOCUMENT_ROOT'] . "/books/config/global.php"); // Incluye el archivo de configuración global.


require_once(ROOT_DIR . "/model/UserModel.php"); // Incluye el modelo de usuario.


$method = $_SERVER['REQUEST_METHOD']; // Obtiene el método de la solicitud HTTP.

$input = json_decode(file_get_contents('php://input'), true); // Decodifica la entrada JSON de la solicitud.

try {
    // Intenta obtener la información de la ruta de la solicitud.
    $Path_Info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
    
    $request = explode('/', trim($Path_Info, '/')); // Divide la ruta en segmentos.
} catch (Exception $e) {
    
    echo $e->getMessage(); // Muestra un mensaje de error en caso de excepción.
}

// Maneja las solicitudes según el método HTTP.
switch ($method) {
    case 'POST':
        // Obtiene la operación a realizar ('login', 'register', 'logout').
        $p_ope = !empty($input['ope']) ? $input['ope'] : $_POST['ope'];
        if ($p_ope == 'login') {
            
            login($input); // Llama a la función de inicio de sesión.
        } else if ($p_ope == 'register') {
            
            register($input); // Llama a la función de registro.
        } else if ($p_ope == 'logout') {
            
            session_destroy(); // Destruye la sesión para cerrar sesión.
        }
        break;
}

// Función para manejar el inicio de sesión.
/**
 * Maneja el proceso de inicio de sesión.
 * @param array $input Datos de entrada de la solicitud.
 * @return void
 */
function login($input)
{
    // Obtiene el email y la contraseña de la solicitud.
    $p_email = !empty($input['email']) ? $input['email'] : $_POST['email'];
    $p_password = !empty($input['user_password']) ? $input['user_password'] : $_POST['user_password'];

    // Verifica que la contraseña no sea nula.
    if (is_null($p_password)) {
        echo json_encode(["ESTADO" => false, "ERROR" => "user_password no puede ser nulo."]);
        exit();
    }

    // Hashea la contraseña utilizando SHA-512 y MD5.
    $p_password = hash('sha512', md5($p_password));
    // Crea una instancia del modelo de usuario.
    $su = new UserModel();
    // Verifica el inicio de sesión del usuario.
    $var = $su->verificarlogin($p_email, $p_password);

    // Si se encuentran datos, se inicia la sesión.
    if (count($var['DATA']) > 0) {
        $_SESSION['login'] = $var['DATA'][0];
        echo json_encode($var);
        exit();
    } else {
        // Si los datos no son válidos, se devuelve un error.
        $array = array();
        $array['ESTADO'] = false;
        $array['ERROR'] = "Usuario o Contraseña no valida, verifique sus datos, demasiados intentos bloqueara al usuario el acceso al sistema.";
        echo json_encode($var);
        exit();
    }
}

// Función para manejar el registro de usuario.
/**
 * Maneja el proceso de registro de usuario.
 * @param array $input Datos de entrada de la solicitud.
 * @return void
 */
function register($input)
{
    // Obtiene el email, nombre de usuario y contraseña de la solicitud.
    $p_email = !empty($input['email']) ? $input['email'] : $_POST['email'];
    $p_username = !empty($input['username']) ? $input['username'] : $_POST['username'];
    $p_user_password = !empty($input['user_password']) ? $input['user_password'] : $_POST['user_password'];

    // Verifica que la contraseña no sea nula.
    if (is_null($p_user_password)) {
        echo json_encode(["ESTADO" => false, "ERROR" => "user_password no puede ser nulo."]);
        exit();
    }

    
    $p_user_password = hash('sha512', md5($p_user_password)); // Hashea la contraseña utilizando SHA-512 y MD5.
    
    $tseg_usuario = new UserModel(); // Crea una instancia del modelo de usuario.
    
    $var = $tseg_usuario->register($p_email, $p_username, $p_user_password); // Registra al nuevo usuario.

    
    echo json_encode($var); // Devuelve la respuesta del registro.
}
?>
