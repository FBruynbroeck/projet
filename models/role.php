<?php
namespace Projet\Model;


class Role extends \Projet\App\Model {

    protected $columns = ['id', 'name'];

    public static function getByName($name){
        $instance = new static();
        $query = $instance->_pdo->prepare("select * from ".$instance->table." where name = :name");
        $query->execute([':name' => $name]);
        $query->setFetchMode(\PDO::FETCH_CLASS, get_class($instance));
        return $query->fetch();
    }

}
