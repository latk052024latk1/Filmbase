<?php

namespace Models;
require_once '../../vendor/autoload.php';

use PDO;

// This class represents the 'characters' table.

class Character extends BaseModel
{

	private ?int $character_id;
	private int $entity;
	private ?string $character_name;
    private int $actor;

	public function __construct(){
		parent::__construct();
	}

	public function setId($character_id){
		$this->character_id = $character_id;
	}

	public function getId(){

		return $this->character_id;
	}

	public function setEntity($entity){
		$this->entity = $entity;
	}

	public function getEntity(){

		return $this->entity;
	}

	public function setName($character_name){
		$this->character_name = $character_name;
	}

	public function getName(){

		return $this->character_name;
	}

    public function setActor($actor){
        $this->actor = $actor;
    }

    public function getActor(){

        return $this->actor;
    }


	public function add(){
        $sql_query = "INSERT INTO characters (entity, character_name, actor) 
        values (:entity, :character_name, :actor)";
        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':entity', $this->entity, PDO::PARAM_INT);
        $stmt->bindParam(':character_name', $this->character_name, PDO::PARAM_STR);
        $stmt->bindParam(':actor', $this->actor, PDO::PARAM_INT);

        $stmt->execute();
        echo "Everything' alright!";
    }

    public function update(){
        $sql_query = "UPDATE characters SET character_name = :character_name, 
        actor = :actor WHERE character_id = :id";
        $stmt = $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(':id', $this->character_id, PDO::PARAM_INT);
        $stmt->bindParam(':character_name', $this->character_name, PDO::PARAM_STR);
        $stmt->bindParam(':actor', $this->actor, PDO::PARAM_INT);
        
        $stmt->execute();
        echo "The data was changed!";
    }

    public function delete(){
        $sql_query = "DELETE FROM characters WHERE character_id = :character_id";
        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':character_id', $this->character_id, PDO::PARAM_INT);
        $stmt->execute();
        echo "The data was deleted!";
    }

    public function selectByEntity($id){ // Select characters from a film/series based on the provided id.
        $sql = "SELECT c.*, p.person_id, p.person_name, p.person_surname, p.photo 
        FROM characters c INNER JOIN people p ON p.person_id = c.actor
                        WHERE c.entity = :id";
        $stmt = $this->getDb()->connect()->prepare($sql);
        $stmt->bindParam("id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setAll($id, $entity, $name, $actor){
        $this->setId($id);
        $this->setEntity($entity);
        $this->setName($name);
        $this->setActor($actor);
    }

}

?>