<?php
namespace Projet\App;

abstract class Model {
    private $host = "localhost";
    private $db_name = "cours";
    private $db_user = "root";
    private $db_pass = "password";

    protected $_pdo;
    protected $table;
    protected $columns = [];
    protected $pk = 'id';

    public function __construct() {
        $reflection = new \ReflectionClass($this);
        $this->table = strtolower($reflection->getShortName());
        $this->_pdo = $this->getConnection();
    }

    protected function getConnection(){
        try{
            return new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->db_user, $this->db_pass, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        }catch(\PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public static function getAll(){
        $instance = new static();
        $query = $instance->_pdo->prepare("select * from ".$instance->table);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, get_class($instance));
        return $query->fetchAll();
    }

    public static function getByPk($pk) {
        $instance = new static();
        $query = $instance->_pdo->prepare("select * from ".$instance->table." where ".$instance->pk." = :pk");
        $query->execute([':pk' => $pk]);
        $query->setFetchMode(\PDO::FETCH_CLASS, get_class($instance));
        return $query->fetch();
    }

    public function update()
    {
        $champs = [];
        $valeurs = [];
        $valeurs[':pk'] = $this->{$this->pk};
        foreach($this->columns as $column){
            if($column != $this->pk){
                $champ = $column;
                $valeur = $this->$column;
                #champs[0] = "login = :login"
                $champs[] = $champ.' = :'.$champ;
                #valeur[':login'] = 'toto'
                $valeurs[':'.$champ] = $valeur;
            }
        }
        # "login = :login, password = :password"
        $liste_champs = implode(', ', $champs);
        $query = $this->_pdo->prepare("update ".$this->table." set ".$liste_champs." where ".$this->pk." = :pk");
        return $query->execute($valeurs);
    }

    public function save()
    {
        $champs = [];
        $valeurs = [];
        foreach($this->columns as $column){
            if($column != $this->pk){
                $champ = $column;
                $valeur = $this->$column;
                #champs[0] = "login = :login"
                $champs[] = $champ.' = :'.$champ;
                #valeur[':login'] = 'toto'
                $valeurs[':'.$champ] = $valeur;
            }
        }
        # "login = :login, password = :password"
        $liste_champs = implode(', ', $champs);
        $query = $this->_pdo->prepare("insert into ".$this->table." set ".$liste_champs);
        $query->execute($valeurs);
        $this->{$this->pk} = $this->_pdo->lastInsertId();
    }

}
