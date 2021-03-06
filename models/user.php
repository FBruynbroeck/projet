<?php
namespace Projet\Model;
require_once 'role.php';


class User extends \Projet\App\Model {
    public $role_id;
    protected $columns = ['id', 'login', 'password', 'role_id', 'email', 'valid'];

    public function __construct() {
        parent::__construct();
        if($this->role_id){
            $this->role = $this->getRole();
        }
    }

    public function getRole(){
        return Role::getByPk($this->role_id);
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    public static function getByLogin($login){
        $instance = new static();
        $query = $instance->_pdo->prepare("select * from ".$instance->table." where login = :login");
        $query->execute([':login' => $login]);
        $query->setFetchMode(\PDO::FETCH_CLASS, get_class($instance));
        return $query->fetch();
    }

}
