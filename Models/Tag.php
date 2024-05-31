<?php

namespace Models;
require_once "../vendor/autoload.php";

use PDO;

// The Tag class represents the 'tags' table.

class Tag extends BaseModel
{
    private ?int $tag_id;
	private string $tag_name;


	function __construct(){
		parent::__construct();
	}

    public function setId($tag_id){
        $this->tag_id = $tag_id;
    }

    public function getId(){
        return $this->tag_id;
    }

	public function setName($tag_name){
		$this->tag_name = $tag_name;
	}

	public function getName(){
		return $this->tag_name;
	}

	public function add(){ // Add a record.
        $sql_query = "INSERT INTO tags (tag_name) values (:tag_name)";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
        
        $stmt->bindParam(':tag_name', $this->tag_name, PDO::PARAM_STR);
        $stmt->execute();
    }

	public function update(){ // Update a record.
        $sql_query = "UPDATE tags SET tag_name = :tag_name WHERE tag_id = :tag_id";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
        
        $stmt->bindParam(':tag_id', $this->tag_id, PDO::PARAM_INT);        
        $stmt->bindParam(':tag_name', $this->tag_name, PDO::PARAM_STR);
        $stmt->execute();    
    }

    public function delete(){ // Delete a record.
        $sql_query = "DELETE FROM tags WHERE tag_id = :tag_id";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(':tag_id', $this->tag_id, PDO::PARAM_INT);
        $stmt->execute();
    }


    public function select(){ // Select all the records.
        $sql_query = "SELECT * FROM tags ORDER BY tag_name ASC";

        $stmt =  $this->getDb()->connect()->query($sql_query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }    
    public function addByEntity($entity_id){ // Add primary keys to a pivot table.
        $sql_query = "INSERT INTO entities_tags (entity_id, tag_id)
        values (:e_id, :t_id)";

        $stmt = $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(':e_id', $entity_id, PDO::PARAM_INT);
        $stmt->bindParam(':t_id', $this->tag_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function selectByName(){ // Select records by name.
        $sql_query = "SELECT * FROM tags WHERE tag_name = :t_name";

        $stmt = $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(':t_name', $this->tag_name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function selectByEntity($entity_id){ // Select records by a film/series they are associated with.
        $sql_query = "SELECT * FROM tags t
                      INNER JOIN entities_tags e ON e.tag_id = t.tag_id
                      WHERE e.entity_id = :e_id";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
        
        $stmt->bindParam(':e_id', $entity_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setAll($tag_id, $tag_name){
        $this->setId($tag_id);
        $this->setName($tag_name);
    }

}

?>