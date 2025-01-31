<?php

header("Access-Control-Allow-Origin: *"); // Permitir que cualquier origen acceda a este recurso.

header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE"); // Permitir los métodos HTTP PUT, GET, POST, DELETE.

header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); // Permitir ciertos encabezados en las solicitudes.

header("Content-Type: application/json; charset=UTF-8"); // Definir el tipo de contenido como JSON y el conjunto de caracteres como UTF-8.


session_start(); // Iniciar una sesión en PHP.


require_once($_SERVER['DOCUMENT_ROOT'] . "/books/config/global.php"); // Incluir el archivo de configuración global.


require_once(ROOT_DIR . "/model/Ven_booksModel.php"); // Incluir el modelo Ven_booksModel.


$method = $_SERVER['REQUEST_METHOD']; // Obtener el método de la solicitud HTTP.

$input = json_decode(file_get_contents('php://input'), true); // Decodificar la entrada JSON de la solicitud.

try {
    // Intentar obtener la información de la ruta de la solicitud.
    $Path_Info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
    
    $request = explode('/', trim($Path_Info, '/')); // Dividir la ruta en segmentos.
} catch (Exception $e) {
    
    echo $e->getMessage(); // Mostrar un mensaje de error en caso de excepción.
}

// Manejar las solicitudes según el método HTTP.
switch ($method) {
    case 'GET': // Consulta
        // Obtener la operación a realizar ('filterId', 'filterSearch', 'filterall').
        $p_ope = !empty($input['ope']) ? $input['ope'] : $_GET['ope'];
        if (!empty($p_ope)) {
            if ($p_ope == 'filterId') {
                
                filterId($input); // Llamar a la función para filtrar por ID.
            } elseif ($p_ope == 'filterSearch') {
                
                filterPaginateAll($input); // Llamar a la función para paginar y filtrar todos los registros.
            } elseif ($p_ope == 'filterall') {
                
                filterAll($input); // Llamar a la función para filtrar todos los registros.
            }
        }
        break;
    case 'POST': // Inserción
        
        insert($input); // Llamar a la función para insertar un nuevo registro.
        break;
    case 'PUT': // Actualización
        
        update($input); // Llamar a la función para actualizar un registro existente.
        break;
    case 'DELETE': // Eliminación
        
        deleteBook($input); // Llamar a la función para eliminar un registro.
        break;
    default: // Método no soportado
        echo "METODO NO SOPORTADO";
        break;
}

// Función para filtrar y obtener todos los registros de libros.
/**
 * Obtiene todos los registros de libros.
 * @param array $input Datos de entrada de la solicitud (no utilizados en esta función).
 * @return void
 */
function filterAll($input){
    // Crear una instancia del modelo Ven_booksModel.
    $tobj = new Ven_booksModel();
    // Llamar al método findall para obtener todos los registros.
    $var = $tobj->findall();
    // Devolver los registros en formato JSON.
    echo json_encode($var);
}

// Función para filtrar y obtener un libro por su ID.
/**
 * Obtiene un libro por su ID.
 * @param array $input Datos de entrada de la solicitud, debe contener 'book_id'.
 * @return void
 */
function filterId($input)
{
    // Obtener el ID del libro de la solicitud.
    $p_book_id = !empty($input['book_id']) ? $input['book_id'] : $_GET['book_id'];
    // Crear una instancia del modelo Ven_booksModel.
    $tobj = new Ven_booksModel();
    // Llamar al método findID para obtener el registro del libro por su ID.
    $var = $tobj->findID($p_book_id);
    // Devolver el registro en formato JSON.
    echo json_encode($var);
}

// Función para paginar y buscar libros.
/**
 * Obtiene libros paginados y filtrados por búsqueda.
 * @param array $input Datos de entrada de la solicitud, debe contener 'page' y 'busqueda'.
 * @return void
 */
function filterPaginateAll($input)
{
    // Definir el número de registros por página.
    $nro_record_page = 10;
    // Obtener la página actual de la solicitud.
    $page = !empty($input['page']) ? $input['page'] : $_GET['page'];
    // Obtener el término de búsqueda de la solicitud.
    $p_busqueda = !empty($input['busqueda']) ? $input['busqueda'] : $_GET['busqueda'];
    // Definir el límite de registros por página.
    $p_limit = 10;
    // Definir el desplazamiento inicial.
    $p_offset = 0;
    // Calcular el desplazamiento basado en la página actual.
    $p_offset = abs(($page - 1) * $nro_record_page);
    // Crear una instancia del modelo Ven_booksModel.
    $tobj = new Ven_booksModel();
    // Llamar al método findpaginationall para obtener los registros paginados y filtrados.
    $var = $tobj->findPaginationAll($p_limit, $p_offset, $p_busqueda);
    // Devolver los registros en formato JSON.
    echo json_encode($var);
}

// Función para insertar un nuevo libro.
/**
 * Inserta un nuevo libro en la base de datos.
 * @param array $input Datos de entrada de la solicitud, debe contener todos los datos del libro.
 * @return void
 */
function insert($input){
    // Obtener los datos del libro de la solicitud.
    $p_title = !empty($input['title']) ? $input['title'] : $_POST['title'];
    $p_author = !empty($input['author']) ? $input['author'] : $_POST['author'];
    $p_genre = !empty($input['genre']) ? $input['genre'] : $_POST['genre'];
    $p_publication_date = !empty($input['publication_date']) ? $input['publication_date'] : $_POST['publication_date'];
    $p_page_count = !empty($input['page_count']) ? $input['page_count'] : $_POST['page_count'];
    $p_publisher = !empty($input['publisher']) ? $input['publisher'] : $_POST['publisher'];
    $p_isbn = !empty($input['isbn']) ? $input['isbn'] : $_POST['isbn'];
    $p_original_language_book = !empty($input['original_language_book']) ? $input['original_language_book'] : $_POST['original_language_book'];
    $p_bestseller = !empty($input['bestseller']) ? $input['bestseller'] : $_POST['bestseller'];
    $p_book_edition = !empty($input['book_edition']) ? $input['book_edition'] : $_POST['book_edition'];
    $p_translated_book_language = !empty($input['translated_book_language']) ? $input['translated_book_language'] : $_POST['translated_book_language'];
    $p_legal_deposit_number = !empty($input['legal_deposit_number']) ? $input['legal_deposit_number'] : $_POST['legal_deposit_number'];
    
    // Crear una instancia del modelo Ven_booksModel.
    $tobj = new Ven_booksModel();
    // Llamar al método insert para insertar un nuevo registro de libro.
    $var = $tobj->insert($p_title, $p_author, $p_genre, $p_publication_date, $p_page_count, $p_publisher, $p_isbn, $p_original_language_book, $p_bestseller, $p_book_edition, $p_translated_book_language, $p_legal_deposit_number);
    // Devolver el resultado de la inserción en formato JSON.
    echo json_encode($var);
}

// Función para actualizar un libro existente.
/**
 * Actualiza un libro existente en la base de datos.
 * @param array $input Datos de entrada de la solicitud, debe contener 'book_id' y todos los datos del libro a actualizar.
 * @return void
 */
function update($input){
    // Obtener los datos del libro de la solicitud.
    $p_book_id = !empty($input['book_id']) ? $input['book_id'] : $_POST['book_id'];
    $p_title = !empty($input['title']) ? $input['title'] : $_POST['title'];
    $p_author = !empty($input['author']) ? $input['author'] : $_POST['author'];
    $p_genre = !empty($input['genre']) ? $input['genre'] : $_POST['genre'];
    $p_publication_date = !empty($input['publication_date']) ? $input['publication_date'] : $_POST['publication_date'];
    $p_page_count = !empty($input['page_count']) ? $input['page_count'] : $_POST['page_count'];
    $p_publisher = !empty($input['publisher']) ? $input['publisher'] : $_POST['publisher'];
    $p_isbn = !empty($input['isbn']) ? $input['isbn'] : $_POST['isbn'];
    $p_original_language_book = !empty($input['original_language_book']) ? $input['original_language_book'] : $_POST['original_language_book'];
    $p_bestseller = !empty($input['bestseller']) ? $input['bestseller'] : $_POST['bestseller'];
    $p_book_edition = !empty($input['book_edition']) ? $input['book_edition'] : $_POST['book_edition'];
    $p_translated_book_language = !empty($input['translated_book_language']) ? $input['translated_book_language'] : $_POST['translated_book_language'];
    $p_legal_deposit_number = !empty($input['legal_deposit_number']) ? $input['legal_deposit_number'] : $_POST['legal_deposit_number'];
    
    // Crear una instancia del modelo Ven_booksModel.
    $tobj = new Ven_booksModel();
    // Llamar al método update para actualizar el registro del libro.
    $var = $tobj->update($p_book_id, $p_title, $p_author, $p_genre, $p_publication_date, $p_page_count, $p_publisher, $p_isbn, $p_original_language_book, $p_bestseller, $p_book_edition, $p_translated_book_language, $p_legal_deposit_number);
    // Devolver el resultado de la actualización en formato JSON.
    echo json_encode($var);
}

// Función para eliminar un libro.
/**
 * Elimina un libro de la base de datos.
 * @param array $input Datos de entrada de la solicitud, debe contener 'book_id'.
 * @return void
 */
function deleteBook($input){
    // Obtener el ID del libro de la solicitud.
    $p_book_id = !empty($input['book_id']) ? $input['book_id'] : $_POST['book_id'];
    // Crear una instancia del modelo Ven_booksModel.
    $tobj = new Ven_booksModel();
    // Llamar al método delete para eliminar el registro del libro.
    $var = $tobj->delete($p_book_id);
    // Devolver el resultado de la eliminación en formato JSON.
    echo json_encode($var);
}
?>
