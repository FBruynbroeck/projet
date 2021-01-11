<?php
namespace Projet\App;

abstract class Model {
    private $host = "localhost";
    private $db_name = "cours";
    private $db_user = "root";
    private $db_pass = "password";

    protected $_pdo;
    protected $table;
    protected $pk = 'id';
    public $id;

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

    public function getAll(){
        $query = $this->_pdo->prepare("select * from ".$this->table);
        $query->execute();
        return $query->fetchAll();
    }

    public function getOne(){
        $query = $this->_pdo->prepare("select * from ".$this->table." where ".$this->pk." = :id");
        $query->execute([':id' => $this->id]);
        $query->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, get_class($this));
        return $query->fetch();
    }

    public function update($model)
    {
        $champs = [];
        $valeurs = [];
        $valeurs[':id'] = $this->id;
        foreach($model as $champ => $valeur){
            #champs[0] = "login = :login"
            $champs[] = $champ.' = :'.$champ;
            #valeur[':login'] = 'toto'
            $valeurs[':'.$champ] = $valeur;
        }
        # "login = :login, password = :password"
        $liste_champs = implode(', ', $champs);
        $query = $this->_pdo->prepare("update ".$this->table." set ".$liste_champs." where ".$this->pk." = :id");
        return $query->execute($valeurs);
    }

}
