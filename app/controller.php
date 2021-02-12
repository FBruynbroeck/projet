<?php
namespace Projet\App;

abstract class Controller {

    public function __construct(){
        if(isset($_SESSION['login_id'])){
            $this->loadModel('User');
            $this->current_user = $this->User::getByPk($_SESSION['login_id']);
        }
    }

    public function render($data=[]){
        extract($data);
        ob_start();
        if (!isset($view)){
            $reflection = new \ReflectionClass($this);
            $view = $reflection->getShortName();
        }
        require ROOT."views/".strtolower($view).".php";
        $content = ob_get_clean();
        ob_start();
        if(isset($_SESSION['role_id'])){
            if($_SESSION['role_id'] == ADMIN){
                require ROOT."views/menu_admin.php";
            }
            if($_SESSION['role_id'] == CLIENT){
                require ROOT."views/menu_client.php";
            }
        }
        $menu = ob_get_clean();
        require ROOT."views/template.php";
    }

    public function loadModel($model){
        require_once ROOT."models/".strtolower($model).".php";
        #$this->User = new User();
        $class = "\Projet\Model\\".$model;
        #$this->User = new \Projet\Model\User();
        $this->$model = new $class();
    }

}

abstract class ControllerClient extends Controller {

    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['role_id'])){
            $_SESSION['error'] = 'Oups, il y a eu un problème...';
            header('Location: /');
            exit();
        }
    }

}

abstract class ControllerAdmin extends ControllerClient {

    public function __construct(){
        parent::__construct();
        if($_SESSION['role_id'] != ADMIN){
            $_SESSION['error'] = 'Vous n\'êtes pas administrateur.';
            header('Location: /');
            exit();
        }
    }

}
