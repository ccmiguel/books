<?php
// Incluir el archivo base del modelo PDO.
include_once('../core/ModelBasePDO.php');

class Ven_booksModel extends ModeloBasePDO {

    /**
     * Constructor de la clase.
     * Inicializa el modelo base PDO.
     */
    public function __construct() 
    {
        // Llamar al constructor de la clase padre.
        parent::__construct();
    }

    // Método para obtener todos los libros.
    /**
     * Obtiene todos los registros de libros.
     * @return array Lista de libros.
     */
    public function findall() {
        // Definir la consulta SQL para seleccionar todos los libros.
        $sql = "SELECT book_id, title, author, genre, publication_date, 
                page_count, publisher, isbn, original_language_book, bestseller, 
                book_edition, translated_book_language, legal_deposit_number 
                FROM books;";
        // Definir el arreglo de parámetros (vacío en este caso).
        $params = array();
        // Ejecutar la consulta y devolver los resultados.
        return parent::gselect($sql, $params);
    }

    // Método para paginar y filtrar libros.
        /**
     * Obtiene libros paginados y filtrados por búsqueda.
     * @param int $p_limit Número de registros por página.
     * @param int $p_offset Desplazamiento para la paginación.
     * @param string $p_busqueda Término de búsqueda.
     * @return array Lista de libros con la cantidad total.
     */
    public function findPaginationAll($p_limit, $p_offset, $p_busqueda) {
        // Definir la consulta SQL para seleccionar libros con paginación y filtrado.
        $sql = "SELECT book_id, title, author, genre, publication_date, 
                page_count, publisher, isbn, original_language_book, bestseller, 
                book_edition, translated_book_language, legal_deposit_number 
                FROM books
                WHERE UPPER(CONCAT(IFNULL(book_id,''),IFNULL(title,''),IFNULL(author,''),
                      IFNULL(genre,''),IFNULL(publication_date,''),IFNULL(page_count,''),
                      IFNULL(publisher,''),IFNULL(isbn,''),IFNULL(original_language_book,''),
                      IFNULL(bestseller,''),IFNULL(book_edition,''),IFNULL(translated_book_language,''),
                      IFNULL(legal_deposit_number,''))) 
                LIKE CONCAT('%', UPPER(IFNULL(:p_busqueda,'')), '%')
                LIMIT :p_limit OFFSET :p_offset;";
        // Definir el arreglo de parámetros con los valores de límite, offset y búsqueda.
        $params = array();
        array_push($params, [':p_limit', $p_limit, PDO::PARAM_INT]);
        array_push($params, [':p_offset', $p_offset, PDO::PARAM_INT]);
        array_push($params, [':p_busqueda', $p_busqueda, PDO::PARAM_STR]);
        // Ejecutar la consulta y almacenar los resultados.
        $var = parent::gselect($sql, $params);

        // Imprimir los resultados para depuración.
        //echo '<pre>'; print_r($var); echo '</pre>';

        // Definir la consulta SQL para contar el total de libros que coinciden con el filtro.
        $sqlCount = "SELECT COUNT(1) as cant 
                     FROM books
                     WHERE UPPER(CONCAT(IFNULL(book_id,''),IFNULL(title,''),IFNULL(author,''),
                           IFNULL(genre,''),IFNULL(publication_date,''),IFNULL(page_count,''),
                           IFNULL(publisher,''),IFNULL(isbn,''),IFNULL(original_language_book,''),
                           IFNULL(bestseller,''),IFNULL(book_edition,''),IFNULL(translated_book_language,''),
                           IFNULL(legal_deposit_number,''))) 
                     LIKE CONCAT('%', UPPER(IFNULL(:p_busqueda,'')), '%');";
        // Definir el arreglo de parámetros con el valor de búsqueda.
        $params = array();
        array_push($params, [':p_busqueda', $p_busqueda, PDO::PARAM_STR]);
        // Ejecutar la consulta y almacenar el resultado.
        $var1 = parent::gselect($sqlCount, $params);
        // Imprimir el resultado del conteo para depuración.
        //echo '<pre>'; print_r($var1); echo '</pre>';
        // Agregar el conteo total de registros al resultado anterior.
        if (!empty($var1['DATA'])) {
            $var['LENGTH'] = $var1['DATA'][0]['cant'];
        } else {
            $var['LENGTH'] = 0;
        }
        // Imprimir el resultado final para depuración.
        //echo '<pre>'; print_r($var); echo '</pre>';
        // Devolver el resultado.
        return $var;
    }

    // Método para obtener un libro por su ID.
        /**
     * Obtiene un libro por su ID.
     * @param int $p_book_id ID del libro.
     * @return array Datos del libro.
     */
    public function findID($p_book_id) {
        // Definir la consulta SQL para seleccionar un libro por su ID.
        $sql = "SELECT book_id, title, author, genre, publication_date, 
                page_count, publisher, isbn, original_language_book, bestseller, 
                book_edition, translated_book_language, legal_deposit_number 
                FROM books 
                WHERE book_id = :p_book_id;";
        // Definir el arreglo de parámetros con el ID del libro.
        $params = array();
        array_push($params, [':p_book_id', $p_book_id, PDO::PARAM_INT]);
        // Ejecutar la consulta y devolver los resultados.
        return parent::gselect($sql, $params);
    }

    // Método para insertar un nuevo libro.
        /**
     * Inserta un nuevo libro en la base de datos.
     * @param string $p_title Título del libro.
     * @param string $p_author Autor del libro.
     * @param string $p_genre Género del libro.
     * @param string $p_publication_date Fecha de publicación.
     * @param int $p_page_count Número de páginas.
     * @param string $p_publisher Editorial.
     * @param string $p_isbn ISBN del libro.
     * @param string $p_original_language_book Idioma original del libro.
     * @param string $p_bestseller Indica si el libro es un bestseller.
     * @param string $p_book_edition Edición del libro.
     * @param string $p_translated_book_language Idioma de traducción.
     * @param string $p_legal_deposit_number Número de depósito legal.
     * @return string Resultado de la inserción.
     */
    public function insert($p_title, $p_author, $p_genre, $p_publication_date, $p_page_count, $p_publisher, $p_isbn, $p_original_language_book, $p_bestseller, $p_book_edition, $p_translated_book_language, $p_legal_deposit_number) {
        // Definir la consulta SQL para insertar un nuevo libro.
        $sql = "INSERT INTO books(title, author, genre, publication_date, page_count, publisher, isbn, original_language_book, bestseller, book_edition, translated_book_language, legal_deposit_number) 
                VALUES (:p_title, :p_author, :p_genre, :p_publication_date, :p_page_count, :p_publisher, :p_isbn, :p_original_language_book, :p_bestseller, :p_book_edition, :p_translated_book_language, :p_legal_deposit_number);";
        // Definir el arreglo de parámetros con los datos del nuevo libro.
        $params = array();
        array_push($params, [':p_title', $p_title, PDO::PARAM_STR]);
        array_push($params, [':p_author', $p_author, PDO::PARAM_STR]);
        array_push($params, [':p_genre', $p_genre, PDO::PARAM_STR]);
        array_push($params, [':p_publication_date', $p_publication_date, PDO::PARAM_STR]);
        array_push($params, [':p_page_count', $p_page_count, PDO::PARAM_INT]);
        array_push($params, [':p_publisher', $p_publisher, PDO::PARAM_STR]);
        array_push($params, [':p_isbn', $p_isbn, PDO::PARAM_STR]);
        array_push($params, [':p_original_language_book', $p_original_language_book, PDO::PARAM_STR]);
        array_push($params, [':p_bestseller', $p_bestseller, PDO::PARAM_STR]);
        array_push($params, [':p_book_edition', $p_book_edition, PDO::PARAM_STR]);
        array_push($params, [':p_translated_book_language', $p_translated_book_language, PDO::PARAM_STR]);
        array_push($params, [':p_legal_deposit_number', $p_legal_deposit_number, PDO::PARAM_STR]);
        // Ejecutar la consulta y devolver el resultado.
        return parent::ginsert($sql, $params);
    }

    // Método para actualizar un libro existente.
        /**
     * Actualiza un libro existente en la base de datos.
     * @param int $p_book_id ID del libro.
     * @param string $p_title Título del libro.
     * @param string $p_author Autor del libro.
     * @param string $p_genre Género del libro.
     * @param string $p_publication_date Fecha de publicación.
     * @param int $p_page_count Número de páginas.
     * @param string $p_publisher Editorial.
     * @param string $p_isbn ISBN del libro.
     * @param string $p_original_language_book Idioma original del libro.
     * @param string $p_bestseller Indica si el libro es un bestseller.
     * @param string $p_book_edition Edición del libro.
     * @param string $p_translated_book_language Idioma de traducción.
     * @param string $p_legal_deposit_number Número de depósito legal.
     * @return string Resultado de la actualización.
     */
    public function update($p_book_id, $p_title, $p_author, $p_genre, $p_publication_date, $p_page_count, $p_publisher, $p_isbn, $p_original_language_book, $p_bestseller, $p_book_edition, $p_translated_book_language, $p_legal_deposit_number) {
        // Definir la consulta SQL para actualizar los datos de un libro.
        $sql = "UPDATE books SET 
                title = :p_title,
                author = :p_author,
                genre = :p_genre,
                publication_date = :p_publication_date,
                page_count = :p_page_count,
                publisher = :p_publisher,
                isbn = :p_isbn,
                original_language_book = :p_original_language_book,
                bestseller = :p_bestseller,
                book_edition = :p_book_edition,
                translated_book_language = :p_translated_book_language,
                legal_deposit_number = :p_legal_deposit_number
                WHERE book_id = :p_book_id;";
        // Definir el arreglo de parámetros con los datos actualizados del libro.
        $params = array();
        array_push($params, [':p_book_id', $p_book_id, PDO::PARAM_INT]);
        array_push($params, [':p_title', $p_title, PDO::PARAM_STR]);
        array_push($params, [':p_author', $p_author, PDO::PARAM_STR]);
        array_push($params, [':p_genre', $p_genre, PDO::PARAM_STR]);
        array_push($params, [':p_publication_date', $p_publication_date, PDO::PARAM_STR]);
        array_push($params, [':p_page_count', $p_page_count, PDO::PARAM_INT]);
        array_push($params, [':p_publisher', $p_publisher, PDO::PARAM_STR]);
        array_push($params, [':p_isbn', $p_isbn, PDO::PARAM_STR]);
        array_push($params, [':p_original_language_book', $p_original_language_book, PDO::PARAM_STR]);
        array_push($params, [':p_bestseller', $p_bestseller, PDO::PARAM_STR]);
        array_push($params, [':p_book_edition', $p_book_edition, PDO::PARAM_STR]);
        array_push($params, [':p_translated_book_language', $p_translated_book_language, PDO::PARAM_STR]);
        array_push($params, [':p_legal_deposit_number', $p_legal_deposit_number, PDO::PARAM_STR]);
        // Ejecutar la consulta y devolver el resultado.
        return parent::gupdate($sql, $params);
    }

    // Método para eliminar un libro.
        /**
     * Elimina un libro de la base de datos.
     * @param int $p_book_id ID del libro a eliminar.
     * @return string Resultado de la eliminación.
     */
    public function delete($p_book_id) {
        // Definir la consulta SQL para eliminar un libro por su ID.
        $sql = "DELETE FROM books WHERE book_id = :p_book_id;";
        // Definir el arreglo de parámetros con el ID del libro a eliminar.
        $params = array();
        array_push($params, [':p_book_id', $p_book_id, PDO::PARAM_INT]);
        // Ejecutar la consulta y devolver el resultado.
        return parent::gdelete($sql, $params);
    }

    // Método para buscar libros filtrados.
        /**
     * Busca libros que coincidan con el filtro proporcionado.
     * @param string $filter Término de búsqueda.
     * @return array Lista de libros que coinciden con el filtro.
     */
    public function findFiltered($filter)
    {
        // Definir la consulta SQL para buscar libros que coincidan con el filtro.
        $sql = "SELECT * FROM books 
                WHERE title LIKE :filter 
                OR author LIKE :filter 
                OR genre LIKE :filter 
                OR publication_date LIKE :filter 
                OR page_count LIKE :filter 
                OR publisher LIKE :filter 
                OR isbn LIKE :filter 
                OR original_language_book LIKE :filter 
                OR bestseller LIKE :filter 
                OR book_edition LIKE :filter 
                OR translated_book_language LIKE :filter 
                OR legal_deposit_number LIKE :filter";
        // Definir el arreglo de parámetros con el filtro.
        $params = array([':filter', '%' . $filter . '%', PDO::PARAM_STR]);
        // Ejecutar la consulta y devolver los resultados.
        return parent::gselect($sql, $params);
    }
}
?>
