<?php

namespace Models;
require_once '../vendor/autoload.php';

use PDO;

// Review class handles CRUD tasks associated with reviews, written by users.

class Review extends BaseModel
{

	private ?int $review_id;
	private int $review_entity;
	private int $review_author;
    private string $review_name;
	private string $review_text;
	private string $review_date;


	function __construct(){
		parent::__construct();
	}

	public function setId(?int $review_id){
		$this->review_id = $review_id;
	}

	public function getId(){
		return $this->review_id;
	}

	public function setEntity($review_entity){
		$this->review_entity = $review_entity;
	}

	public function getEntity(){
		return $this->review_entity;
	}

	public function setAuthor($review_author){
		$this->review_author = $review_author;
	}

	public function getAuthor(){
		return $this->review_author;
	}

    public function setName($review_name){
		$this->review_name = $review_name;
	}

	public function getName(){
		return $this->review_name;
	}
	public function setText($review_text){
		$this->review_text = $review_text;
	}

	public function getText(){
		return $this->review_text;
	}

	public function setDate(){
		$this->review_date = date("Y-m-d H:i:s");
	}

	public function getDate(){
		return $this->review_date;
	}

	public function add(){ // Insert a record.
        $sql_query = "INSERT INTO reviews 
        (review_entity, review_author, review_name, review_text, review_date) 
        values (:review_entity, :review_author, :review_name, :review_text, :review_date)";

        $stmt = $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(':review_entity', $this->review_entity, PDO::PARAM_INT);
        $stmt->bindParam(':review_author', $this->review_author, PDO::PARAM_INT);
        $stmt->bindParam(':review_name', $this->review_name, PDO::PARAM_STR);
        $stmt->bindParam(':review_text', $this->review_text, PDO::PARAM_STR);
        $stmt->bindParam(':review_date', $this->review_date, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function update(){ // Update one.
        $sql_query = "UPDATE reviews SET review_name = :review_name, 
        review_text = :review_text WHERE review_id = :review_id";
        
        $stmt = $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(':review_id', $this->review_id, PDO::PARAM_INT);
        $stmt->bindParam(':review_name', $this->review_name, PDO::PARAM_STR);
        $stmt->bindParam(':review_text', $this->review_text, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function delete(){ // Delete one.
        $sql_query = "DELETE FROM reviews WHERE review_id = :review_id";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
        
        $stmt->bindParam(':review_id', $this->review_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function selectAll(){
        $sql_query = "SELECT r.*, u.username FROM reviews r
        INNER JOIN users u ON r.review_author = u.user_id";
        
        $stmt =  $this->getDb()->connect()->query($sql_query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
 
    public function selectOne(){ // Select data of a review and a user, that has written it.
        $sql_query = "SELECT r.*, u.username FROM reviews r
        INNER JOIN users u ON r.review_author = u.user_id
        WHERE review_id = :review_id";

        $stmt =  $this->getDb()->connect()->prepare($sql_query);
        
        $stmt->bindParam(":review_id", $this->review_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function selectByEntity($entity_id){ // Select a record based on the film/series it's associated with.
        $sql_query = "SELECT r.*, e.name, u.username
                      FROM reviews r
                      INNER JOIN users u ON u.user_id = r.review_author
                      INNER JOIN entities e ON e.entity_id = r.review_entity
                      WHERE r.review_entity = :entity";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(":entity", $entity_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectLastByAuthor($author_id){ // Select the recent reviews written by a certain user.
        $sql_query = "SELECT r.*, e.name FROM reviews r
                      INNER JOIN entities e ON e.entity_id = r.review_entity
                      WHERE r.review_author = :author ORDER BY r.review_date DESC LIMIT 3";

        $stmt =  $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(":author", $author_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    
    public function selectAllByAuthor($author_id){
        $sql_query = "SELECT r.*, e.name FROM reviews r
                      INNER JOIN entities e ON e.entity_id = r.review_entity
                      WHERE review_author = :author ORDER BY r.review_date DESC";
        
        $stmt =  $this->getDb()->connect()->prepare($sql_query);
        $stmt->bindParam(":author", $author_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function setAll($id, $entity, $author, $name, $text){
        $this->setId($id);
        $this->setEntity($entity);
        $this->setAuthor($author);
        $this->setName($name);
        $this->setText($text);
        $this->setDate();
    }

}

?>
