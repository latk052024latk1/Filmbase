<?php

namespace Models;
require_once '../vendor/autoload.php';

use Models\Traits\FileTrait;
use PDO;

// The Entity class represents 'entities' table and provides some other functions that should handle some stuff,
// associated with this table and pivot tables. It handles films/series stuff. It uses a trait to work with pictures.

class Entity extends BaseModel
{
    use FileTrait;
	protected ?int $entity_id;
	protected string $name;
	protected int $year;
	protected int $type;
	protected int $genre;
	protected ?string $entity_desc;


	function __construct(){
		parent::__construct();
        $this->mid_doc_path = "entities";
	}

	public function setId($entity_id){
		$this->entity_id = $entity_id;
	}

	public function getId(){

		return $this->entity_id;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getName(){

		return $this->name;
	}

	public function setYear($year){
		$this->year = $year;
	}

	public function getYear(){

		return $this->year;
	}

	public function setType($type){
		$this->type = $type;
	}

	public function getType(){

		return $this->type;
	}

	public function setGenre($genre){
		$this->genre = $genre;
	}

	public function getGenre(){

		return $this->genre;
	}

	public function setDesc($entity_desc){
		$this->entity_desc = $entity_desc;
	}

	public function getDesc(){

		return $this->entity_desc;
	}	

    public function selectOne(){ 
        // This function selects an entity and joins a series or a film record that shares the same primary key.
        // Which one is joined depends on the 'type' chosen by a user.

        $sql_query = "SELECT e.entity_id, e.name,
                      e.genre, e.year as yearID, e.type, e.entity_desc, 
                      y.year, g.genre_name, t.type_name,

                    CASE 
                        WHEN e.type = 1 THEN m.duration_min
                        ELSE NULL
                    END AS duration_min,

                    CASE 
                        WHEN e.type = 2 THEN s.num_seasons 
                        ELSE NULL
                    END AS num_seasons, 
    
                    CASE 
                        WHEN e.type = 2 THEN s.num_episodes 
                        ELSE NULL
                    END AS num_episodes,

                    CASE 
                        WHEN e.type = 2 THEN s.year_end 
                        ELSE NULL
                    END AS year_end

                    FROM entities e
                    INNER JOIN years y ON e.year = y.year_id
                    INNER JOIN genres g ON e.genre = g.genre_id
                    INNER JOIN types t ON e.type = t.type_id

                    LEFT JOIN movies m ON e.type = 1 AND m.entity = e.entity_id
                    LEFT JOIN series s ON e.type = 2 AND s.entity = e.entity_id
    
                    WHERE e.entity_id = :entity_id";

        $stmt =  $this->getDb()->connect()->prepare($sql_query);
        
        $stmt->bindParam("entity_id", $this->entity_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectAll(){
        $sql_query = "SELECT * FROM entities ORDER BY name ASC";

        $stmt =  $this->getDb()->connect()->query($sql_query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectLast(){ // Select 3 records that were inserted recetly.
        $sql_query = "SELECT name, poster, entity_desc, entity_id 
        FROM entities ORDER BY entity_id DESC LIMIT 3";
        
        $stmt = $this->getDb()->connect()->query($sql_query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countByGenre(){ // Count the number of films/series that are associated with a certain genre.
        $sql_query = "SELECT COUNT(entity_id) as count 
                      FROM entities WHERE genre = :genre";

        $db = $this->getDb()->connect();
        $stmt = $db->prepare($sql_query);
        
        $stmt->bindParam(':genre', $this->genre, PDO::PARAM_INT);
        $stmt->execute();        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

	public function add(){ // Insert a record and get the last inserted id.
        $sql_query = "INSERT INTO entities (name, year, type, genre, entity_desc) 
                      values (:e_name, :e_year, :e_type, :e_genre, :e_desc);";

        $db = $this->getDb()->connect();
        $stmt = $db->prepare($sql_query);
        
        $stmt->bindParam(':e_name', $this->name, PDO::PARAM_STR);
        $stmt->bindParam(':e_year', $this->year, PDO::PARAM_INT);
        $stmt->bindParam(':e_type', $this->type, PDO::PARAM_INT);
        $stmt->bindParam(':e_genre', $this->genre, PDO::PARAM_INT);
        $stmt->bindParam(':e_desc', $this->entity_desc, PDO::PARAM_STR);

        try {
            $stmt->execute();
            $lastInsertId = $db->lastInsertId();
            return $lastInsertId;
        
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
    }
    }

    public function update(){ // Update a record.
        $sql_query = "UPDATE entities SET name = :e_name, year = :e_year, 
        genre = :e_genre, entity_desc = :e_desc WHERE entity_id = :e_id";

        $stmt = $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(':e_id', $this->entity_id, PDO::PARAM_INT);
        $stmt->bindParam(':e_name', $this->name, PDO::PARAM_STR);
        $stmt->bindParam(':e_year', $this->year, PDO::PARAM_INT);
        $stmt->bindParam(':e_genre', $this->genre, PDO::PARAM_INT);
        $stmt->bindParam(':e_desc', $this->entity_desc, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function delete(){ // Delete a record based on the provided id.
        $sql_query = "DELETE FROM entities WHERE entity_id = :e_id";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
    
        $stmt->bindParam(':e_id', $this->entity_id, PDO::PARAM_INT);
        $stmt->execute();
    }


    public function updateWithImage($newFileName){

        // If a filename is received by the server, the image path will be updated in the db.

        if ($newFileName !== null) {
            $this->all_doc_path = $newFileName;
        }
        
        $sql = "UPDATE entities SET poster = :poster WHERE entity_id = :entity_id";

        $stmt = $this->getDB()->connect()->prepare($sql);

        $stmt->bindParam(':poster', $this->all_doc_path, PDO::PARAM_STR);
        $stmt->bindParam(':entity_id', $this->entity_id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->all_doc_path;
    }
    
    public function searchEntity($query){ // This function is used to implement a very simple search stuff.
        $sql_query = "SELECT e.name, e.entity_id, y.year FROM entities e
        INNER JOIN years y ON e.year = y.year_id WHERE e.name = :query";

        $stmt = $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(":query", $query, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setAll($id, $name, $year, $type, $genre, $desc){
        $this->setId($id);
        $this->setName($name);
        $this->setYear($year);
        $this->setType($type);
        $this->setGenre($genre);
        $this->setDesc($desc);
    }

}

?>
