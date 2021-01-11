<?php
namespace Projet\App;

abstract class Controller {

    public function render($data=[]){
        extract($data);
        ob_start();
        if (!isset($view)){
            $reflection = new \ReflectionClass($this);
            $view = $reflection->getShortName();
        }
        require ROOT."views/".strtolower($view).".php";
        $content = ob_get_clean();
        require ROOT."views/template.php";
    }

    public function loadModel($model){
        require_once ROOT."models/".$model.".php";
        #$this->User = new User();
        $class = "\Projet\Model\\".$model;
        #$this->User = new \Projet\Model\User();
        $this->$model = new $class();
    }

}

abstract class ControllerAdmin extends Controller {

    public function __construct(){
        if(!isset($_SESSION['login'])){
            $_SESSION['error'] = 'Oups, il y a eu un problème...';
            header('Location: /');
            exit();
        }
    }

}
