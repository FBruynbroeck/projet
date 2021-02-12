<?php
namespace Projet\Controller;

class Notfound extends \Projet\App\Controller {

    public function index(){
        $title = "404";
        $this->render(compact('title'));
    }

}
