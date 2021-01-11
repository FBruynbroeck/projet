<?php
namespace Projet\Model;


class User extends \Projet\App\Model {
    protected $pk = 'login';

    public function __construct($login=null, $password=null) {
        parent::__construct();
        $this->login = $login;
        $this->setPassword($password);
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    public static function getById($id){
        $instance = new static();
        $query = $instance->_pdo->prepare("select * from ".$instance->table." where ".$instance->pk." = :pk");
        $query->execute([':pk' => $pk]);
        $query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, get_class($instance));
        return $query->fetch();
    }

}
