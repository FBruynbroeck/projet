<?php
session_start();
// Constante permettant de récupérer le chemin complet de la racine du projet afin de garantir la portabilité.
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
require ROOT.'app/controller.php';
require ROOT.'app/model.php';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');
$segments = array_filter(explode('/', $uri));
// Structure URL: http://monprojet.be/{REQ_TYPE}/{REQ_TYPE_ID}/{REQ_ACTION}
// Exemple d'url: http://monprojet.be/user/admin/edit
define('REQ_TYPE', $segments[0] ?? 'welcome');
define('REQ_TYPE_ID', $segments[1] ?? Null);
define('REQ_ACTION', $segments[2] ?? 'index');

function get_controller($name) {
    $file = ROOT.'controllers/'.$name.'.php';
    if(file_exists($file)){
        require $file;
        $controller = '\Projet\Controller\\'.ucfirst($name);
        $controller = new $controller();
        return $controller;
    }
}

$controller = get_controller(REQ_TYPE);
if($controller){
    $method = REQ_ACTION;
    if (method_exists($controller, $method)){
        $controller->$method(REQ_TYPE_ID);
        exit();
    }
}
$notfound = get_controller('notfound');
$notfound->index();
