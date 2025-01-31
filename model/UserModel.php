<?php
include_once "../core/ModelBasePDO.php"; // Incluir el archivo base del modelo PDO.

class UserModel extends ModeloBasePDO
{
    /**
     * Constructor de la clase UserModel.
     * Llama al constructor de la clase base ModeloBasePDO.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Obtiene todos los usuarios.
     * @return array Lista de usuarios.
     */
    public function findall()
    {
        $sql = "SELECT email, username, user_password FROM users;"; // Consulta SQL para seleccionar todos los usuarios.
        $param = array(); // Arreglo de parámetros vacío.
        return parent::gselect($sql, $param); // Ejecutar la consulta y devolver los resultados.
    }

    /**
     * Obtiene un usuario por su ID (email).
     * @param string $p_email Email del usuario.
     * @return array Datos del usuario.
     */
    public function findid($p_email)
    {
        $sql = "SELECT email, username, user_password FROM users WHERE email = :p_email;"; // Consulta SQL para seleccionar un usuario por su email.
        $param = array();
        array_push($param, [':p_email', $p_email, PDO::PARAM_STR]); // Arreglo de parámetros con el email del usuario.
        return parent::gselect($sql, $param); // Ejecutar la consulta y devolver los resultados.
    }

    /**
     * Pagina y filtra usuarios.
     * @param string $p_filtro Filtro de búsqueda.
     * @param int $p_limit Número máximo de resultados.
     * @param int $p_offset Desplazamiento para paginación.
     * @return array Lista de usuarios filtrados y paginados.
     */
    public function findpaginateall($p_filtro, $p_limit, $p_offset)
    {
        $sql = "SELECT email, username, user_password FROM users
                WHERE upper(concat(IFNULL(email,''),IFNULL(username,''),IFNULL(user_password,''))) 
                like concat('%', upper(IFNULL(:p_filtro, '')), '%') 
                limit :p_limit OFFSET :p_offset"; // Consulta SQL para seleccionar usuarios con paginación y filtrado.
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        array_push($param, [':p_limit', $p_limit, PDO::PARAM_INT]);
        array_push($param, [':p_offset', $p_offset, PDO::PARAM_INT]);
        $var = parent::gselect($sql, $param); // Ejecutar la consulta y almacenar los resultados.

        $sqlCount = "SELECT concat(1) as cant FROM users
                     WHERE upper(concat(IFNULL(email,''),IFNULL(username,''),IFNULL(user_password,''))) 
                     like concat('%', upper(IFNULL(:p_filtro, '')), '%')"; // Consulta SQL para contar el total de usuarios que coinciden con el filtro.
        $param = array();
        array_push($param, [':p_filtro', $p_filtro, PDO::PARAM_STR]);
        $var1 = parent::gselect($sqlCount, $param); // Ejecutar la consulta y almacenar el resultado.
        $var['LENGTH'] = $var1['DATA'][0]['cant']; // Agregar el conteo total de registros al resultado anterior.
        return $var; // Devolver el resultado.
    }

    /**
     * Verifica el login de un usuario.
     * @param string $p_email Email del usuario.
     * @param string $p_user_password Contraseña del usuario.
     * @return array Datos del usuario si las credenciales son correctas.
     */
    public function verificarlogin($p_email, $p_user_password)
    {
        $sql = "SELECT email, username FROM users
                WHERE email = :p_email AND user_password = :p_user_password"; // Consulta SQL para verificar las credenciales de login.
        $param = array();
        array_push($param, [':p_email', $p_email, PDO::PARAM_STR]);
        array_push($param, [':p_user_password', $p_user_password, PDO::PARAM_STR]);
        return parent::gselect($sql, $param); // Ejecutar la consulta y devolver los resultados.
    }

    /**
     * Registra un nuevo usuario.
     * @param string $p_email Email del nuevo usuario.
     * @param string $p_username Nombre de usuario del nuevo usuario.
     * @param string $p_user_password Contraseña del nuevo usuario.
     * @return mixed Resultado de la inserción.
     */
    public function register($p_email, $p_username, $p_user_password)
    {
        $sql = "INSERT INTO users (email, username, user_password) 
                VALUES (:p_email, :p_username, :p_user_password);"; // Consulta SQL para insertar un nuevo usuario.
        $param = array();
        array_push($param, [':p_email', $p_email, PDO::PARAM_STR]);
        array_push($param, [':p_username', $p_username, PDO::PARAM_STR]);
        array_push($param, [':p_user_password', $p_user_password, PDO::PARAM_STR]);
        return parent::ginsert($sql, $param); // Ejecutar la consulta y devolver el resultado.
    }

    /**
     * Actualiza un usuario existente.
     * @param string $p_email Email del usuario.
     * @param string $p_username Nuevo nombre de usuario.
     * @param string $p_user_password Nueva contraseña.
     * @return mixed Resultado de la actualización.
     */
    public function update($p_email, $p_username, $p_user_password)
    {
        $sql = "UPDATE users SET 
                username = :p_username, 
                user_password = :p_user_password        
                WHERE email = :p_email"; // Consulta SQL para actualizar los datos de un usuario.
        $param = array();
        array_push($param, [':p_email', $p_email, PDO::PARAM_STR]);
        array_push($param, [':p_username', $p_username, PDO::PARAM_STR]);
        array_push($param, [':p_user_password', $p_user_password, PDO::PARAM_STR]);
        return parent::gupdate($sql, $param); // Ejecutar la consulta y devolver el resultado.
    }

    /**
     * Elimina un usuario.
     * @param string $p_email Email del usuario a eliminar.
     * @return mixed Resultado de la eliminación.
     */
    public function delete($p_email)
    {
        $sql = "DELETE FROM users WHERE email = :p_email"; // Consulta SQL para eliminar un usuario por su email.
        $param = array();
        array_push($param, [':p_email', $p_email, PDO::PARAM_STR]);
        return parent::gdelete($sql, $param); // Ejecutar la consulta y devolver el resultado.
    }
}
?>
