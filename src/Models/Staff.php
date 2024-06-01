<?php

namespace Models;
require_once "../vendor/autoload.php";

use PDO;

// This class represents the pivot table, that is needed to handle data of staff/crew that worked on a film/series.

class Staff extends BaseModel
{
    private ?int $id;
    private int $entity_id;
	private string $person_id;
	private string $profession_id;

	function __construct(){
		parent::__construct();
	}

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

	public function setEntity($entity_id){
		$this->entity_id = $entity_id;
	}

	public function getEntity(){
		return $this->entity_id;
	}

    public function setPerson($person_id){
		$this->person_id = $person_id;
	}

	public function getPerson(){
		return $this->person_id;
	}

    public function setProfession($profession_id){
		$this->profession_id = $profession_id;
	}

	public function getProfession(){
		return $this->profession_id;
	}

    public function deleteStaff(){ // Delete a record.
        $sql_query = "DELETE FROM entities_people_professions WHERE 
        person_id = :person_id, profession_id = pro_id, entity_id = e_id";
        
        $stmt = $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(':person_id', $this->person_id, PDO::PARAM_INT);
        $stmt->bindParam(':pro_id', $this->profession_id, PDO::PARAM_INT);
        $stmt->bindParam(':person_id', $this->entity_id, PDO::PARAM_INT);
        $stmt->execute();
    }


    public function addStaff(){ // Insert a record.
        $sql_query = "INSERT INTO entities_people_professions 
        (entity_id, person_id, profession_id) values (:e_id, :p_id, :pro_id)";

        $stmt = $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(':e_id', $this->entity_id, PDO::PARAM_INT);
        $stmt->bindParam(':p_id', $this->person_id, PDO::PARAM_INT);
        $stmt->bindParam(':pro_id', $this->profession_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function selectByEntity($id){ // Select a record by an entity_id.
        $sql_query = "SELECT e.*, p.profession_name, 
                      pe.person_id, pe.person_name, 
                      pe.person_surname FROM entities e
                      INNER JOIN entities_people_professions staff ON
                      staff.entity_id = e.entity_id
                      INNER JOIN professions p ON
                      staff.profession_id = p.profession_id
                      INNER JOIN people pe ON 
                      staff.person_id = p.person_id
                      WHERE staff.entity_id = :e_id";
        
        $stmt = $this->getDb()->connect()->prepare($sql_query);
        
        $stmt->bindParam(':e_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectByPerson($id){ // Select a record by a person_id. 
        $sql_query = "SELECT e.*, p.profession_name, 
                      pe.person_name, pe.person_surname FROM entities e
                      INNER JOIN entities_people_professions staff ON
                      staff.entity_id = e.entity_id
                      INNER JOIN professions p ON
                      staff.profession_id = p.profession_id
                      INNER JOIN people pe ON 
                      staff.person_id = pe.person_id
                      WHERE staff.person_id = :person_id";
        
        $stmt = $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(':person_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setAll($id, $entity_id, $person_id, $profession_id){
        $this->setId($id);
        $this->setEntity($entity_id);
        $this->setPerson($person_id);
        $this->setProfession($profession_id);
    }

}

?>