<?php

namespace Models;
require_once "../vendor/autoload.php";

use Models\Traits\FileTrait;
use PDO;

// The Country class represents the 'countries' table. It uses the FileTrait to manage the pictures of flags.

class Country extends BaseModel
{
    use FileTrait;
    private ?int $country_id;
	private string $country_name;


	function __construct(){
		parent::__construct();
        $this->mid_doc_path = "countries";
	}

    public function setId($country_id){
        $this->country_id = $country_id;
    }

    public function getId(){
        return $this->country_id;
    }

	public function setName($name){
		$this->country_name = $name;
	}

	public function getName(){
		return $this->country_name;
	}

    public function selectAll(){
        $sql_query = "SELECT * FROM countries ORDER BY country_name ASC";
        $stmt =  $this->getDb()->connect()->query($sql_query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }    

    public function selectOne(){
        $sql_query = "SELECT * FROM countries WHERE country_id = :country_id";
        $stmt =  $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(":country_id", $this->country_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }   

    public function addByEntity($entity_id){
        $sql_query = "INSERT INTO entities_countries (entity_id, country_id)
        values (:e_id, :c_id)";
        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':e_id', $entity_id, PDO::PARAM_INT);
        $stmt->bindParam(':c_id', $this->country_id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function selectByEntity($entity_id){
        $sql_query = "SELECT c.* FROM countries c
        INNER JOIN entities_countries e_c ON e_c.country_id = c.country_id
        WHERE e_c.entity_id = :e_id";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':e_id', $entity_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addByPerson($person_id){ // Insert into a pivot table.
        $sql_query = "INSERT INTO people_countries (person_id, country_id)
        values (:p_id, :c_id)";
        
        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':p_id', $person_id, PDO::PARAM_INT);
        $stmt->bindParam(':c_id', $this->country_id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function selectByPerson($person_id){ // Select the countries a person represents.
        $sql_query = "SELECT * FROM countries c
        INNER JOIN people_countries p ON p.country_id = c.country_id
        WHERE p.person_id = :p_id";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':p_id', $person_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

	public function add(){ // Insert a record into the table and get the last inserted id.
        $sql_query = "INSERT INTO countries (country_name) values (:country_name)";
        $db = $this->getDb()->connect();
        $stmt = $db->prepare($sql_query);
      
        $stmt->bindParam(':country_name', $this->country_name, PDO::PARAM_STR);
        
        try {
            $stmt->execute();
            $lastInsertId = $db->lastInsertId();
            return $lastInsertId;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

    }

	public function update(){
        $sql_query = "UPDATE countries SET country_name = :country_name WHERE country_id = :country_id";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':country_id', $this->country_id, PDO::PARAM_INT);
        $stmt->bindParam(':country_name', $this->country_name, PDO::PARAM_STR);
        
        $stmt->execute();
        echo "The data was changed!";    
    }

    public function updateWithImage($newFileName){

        // If a filename is received by the server, the picture path will be updated in the db.

        if ($newFileName !== null) {
            $this->all_doc_path = $newFileName;
        }
        
        $sql = "UPDATE countries SET flag = :flag WHERE country_id = :country_id";
        $stmt = $this->getDB()->connect()->prepare($sql);
        
        $stmt->bindParam(':flag', $this->all_doc_path, PDO::PARAM_STR);
        $stmt->bindParam(':country_id', $this->country_id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $this->all_doc_path;
    }

}

?>