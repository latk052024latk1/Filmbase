<?php

namespace Models;
require_once '../vendor/autoload.php';

use PDO;

// The Movie class represents the 'movies' table, that contains additional data for entities.

class Movie extends BaseModel
{

	#private int $movie_id;
	private int $entity;
	private string $duration_min;

	public function __construct(){
		parent::__construct();
	}

	public function setEntity($entity){
		$this->entity = $entity;
	}

	public function getEntity(){

		return $this->entity;
	}

	public function setDuration($duration_min){
		$this->duration_min = $duration_min;
	}

	public function getDuration(){
		return $this->duration_min;
	}

	public function add(){ // Insert a record into the database.
        $sql_query = "INSERT INTO movies (entity, duration_min) values (:entity, :duration_min)";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':entity', $this->entity, PDO::PARAM_INT);
        $stmt->bindParam(':duration_min', $this->duration_min, PDO::PARAM_STR);
        
        $stmt->execute();
    }

    public function update(){ // Update a record.
        $sql_query = "UPDATE movies SET duration_min = :duration_min WHERE entity = :entity";
        
        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':entity', $this->entity, PDO::PARAM_INT);
        $stmt->bindParam(':duration_min', $this->duration_min, PDO::PARAM_STR);
        
        $stmt->execute();
    }

    public function delete(){ // Delete a record.
        $sql_query = "DELETE FROM movies WHERE entity = :entity";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':entity', $this->entity, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function selectAll(){
        $sql_query = "SELECT * FROM movies ORDER BY entity ASC";

        $stmt =  $this->getDb()->connect()->query($sql_query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setAll($entity, $duration){
        $this->setEntity($entity);
        $this->setDuration($duration);
    }
}

?>