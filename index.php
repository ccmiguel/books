<?php
    session_start();
    require_once './config/global.php';

    $request = $_SERVER['REQUEST_URI'];
    $request = parse_url($request, PHP_URL_PATH);
    $segments = explode('/', trim($request,'/'));

    function error404()
    {
        http_response_code(404);
        require ROOT_DIR . '/view/home.php';
        exit;
    }
    function home()
    {
        require ROOT_DIR.'/view/home.php';
    }

    function verificarlogin()
    {
        if(!isset($_SESSION['login']['username'])){
            echo '<script>window.location.href="'.HTTP_BASE.'/login"</script>';

        }
    }


    
    if ($segments[0] === 'books') {
        switch ($segments[1] ?? '') {
            case 'login':
                require ROOT_VIEW . '/seguridad/login.php';
                break;
            case 'register':
                require ROOT_VIEW . '/seguridad/register.php';
                break;
            case 'logout':
                session_destroy();
                echo '<script>window.location.href="'.HTTP_BASE.'/login"</script>';
                break;
            case 'web':
                verificarlogin();
                switch ($segments[2] ?? '') {
                    case 'bok':
                        switch ($segments[3] ?? '') {
                            case 'list':
                                require ROOT_VIEW . '/web/bok/list.php';
                                break;
                            case 'create':
                                require ROOT_VIEW . '/web/bok/create.php';
                                break;
                            case 'edit':
                                if (isset($segments[4])) {
                                    $_GET['id'] = $segments[4];
                                    require ROOT_VIEW . '/web/bok/edit.php';
                                } else {
                                    error404();
                                }
                                break;
                            case 'delete':
                                if (isset($segments[4])) {
                                    $_GET['id'] = $segments[4];
                                    require ROOT_VIEW . '/web/bok/delete.php';
                                } else {
                                    error404();
                                }
                                break;
                            case 'view':
                                if (isset($segments[4])) {
                                    $_GET['id'] = $segments[4];
                                    require ROOT_VIEW . '/web/bok/view.php';
                                } else {
                                    error404();
                                }
                                break;
                
                        }
                        break;
                }
                break;
            default:
                verificarlogin();
                home();
                break;
        }

    }