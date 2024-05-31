<?php

namespace Models;
require_once '../vendor/autoload.php';

use PDO;

// The Profession class represents the 'professions' table.

class Profession extends BaseModel
{

	private ?int $profession_id;
	private string $profession_name;
	private ?string $profession_desc;

	function __construct(){
		parent::__construct();
	}

	public function setId($profession_id){
		$this->profession_id = $profession_id;
	}

	public function getId(){

		return $this->profession_id;
	}

	public function setName($profession_name){
		$this->profession_name = $profession_name;
	}

	public function getName(){

		return $this->profession_name;
	}

	public function setDesc($profession_desc){
		$this->profession_desc = $profession_desc;
	}

	public function getDesc(){
		return $this->profession_desc;
	}

    public function selectAll(){
        $sql = "SELECT * FROM professions ORDER BY profession_name ASC";
        
        $stmt = $this->getDb()->connect()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectOne(){ // Select a record.
        $sql = "SELECT * FROM professions WHERE profession_id = :id";
        
        $stmt = $this->getDb()->connect()->prepare($sql);
        $stmt->bindParam(":id", $this->profession_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


	public function add(){ // Insert a new record.
        $sql_query = "INSERT INTO professions (profession_name, profession_desc) values (:p_name, :p_desc)";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':p_name', $this->profession_name, PDO::PARAM_STR);
        $stmt->bindParam(':p_desc', $this->profession_desc, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function update(){ // Update a record.
        $sql_query = "UPDATE professions SET profession_name = :p_name, 
        profession_desc = :p_desc WHERE profession_id = :id";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':id', $this->profession_id, PDO::PARAM_INT);
        $stmt->bindParam(':p_name', $this->profession_name, PDO::PARAM_STR);
        $stmt->bindParam(':p_desc', $this->profession_desc, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function delete(){ // Delete a record.
        $sql_query = "DELETE FROM professions WHERE profession_id = :id";
        
        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':id', $this->profession_id, PDO::PARAM_INT);
        $stmt->execute();
        echo "The data was deleted!";
    }

    public function countPeople(){ // Count the people of a certain profession.
        $sql_query = "SELECT p.profession_name,
                      COUNT(DISTINCT pp.person_id) AS count
                      FROM professions p
                      JOIN entities_people_professions pp ON p.profession_id = pp.profession_id
                      WHERE p.profession_id = :id GROUP BY p.profession_name";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':id', $this->profession_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();        
    }

    public function setAll($id, $name, $desc){
        $this->setId($id);
        $this->setName($name);
        $this->setDesc($desc);
    }

}

?>
