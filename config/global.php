<?php
define("CONTROLADOR_DEFECTO", "Usuarios");
define("ACCION_DEFECTO", "index");

define("RUTA_BASE",$_SERVER['DOCUMENT_ROOT']."/");
define("HTTP_BASE","http://127.0.0.1/books");
define('ROOT_DIR',RUTA_BASE.'books');
define('ROOT_CORE',RUTA_BASE.'books/core');
define('ROOT_UPLOAD',RUTA_BASE.'books/uploads');
define('ROOT_VIEW',RUTA_BASE.'books/view');
define('ROOT_REPORT',RUTA_BASE.'books/reports');
define('ROOT_REPORT_DOWN',RUTA_BASE.'books/reports_download');
define("URL_RESOURCES", HTTP_BASE."/public/");
//JWT TOKEN
define('SECRET_KEY','MIEMPRESA.MBmxKMdsfsdffghY7d55sghvTlB1kytftrstews232u6575tdyhrdjyAjB3uNasdasd0g6ZDdOXpz21');  // secret key can be a random string and keep in secret from anyone
define('ALGORITHM','HS256');   // Algorithm used to sign the token

?>