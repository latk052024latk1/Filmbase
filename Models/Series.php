<?php

namespace Models;
require_once '../vendor/autoload.php';

use PDO;

// The Series class represents the 'series' table, that contains additional data for entities.

class Series extends BaseModel
{

	#private int $series_id;
	private int $entity;
	private int $num_seasons;
	private int $num_episodes;
	private ?int $year_end;

	public function __construct(){
		parent::__construct();
	}

	public function setEntity($entity){
		$this->entity = $entity;
	}

	public function getEntity(){
		return $this->entity;
	}

	public function setSeasons($num_seasons){
		$this->num_seasons = $num_seasons;
	}

	public function getSeasons(){
		return $this->num_seasons;
	}

	public function setEpisodes($num_episodes){
		$this->num_episodes = $num_episodes;
	}

	public function getEpisodes(){
		return $this->num_episodes;
	}

	public function setYear($year_end){
		$this->year_end = $year_end;
	}

	public function getYear(){
		return $this->year_end;
	}	

	public function add(){ // Insert a record.
        $sql_query = "INSERT INTO series (entity, num_seasons, num_episodes, year_end) 
					  values (:entity, :num_seasons, :num_episodes, :year_end)";

        $stmt = $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(':entity', $this->entity, PDO::PARAM_INT);
        $stmt->bindParam(':num_seasons', $this->num_seasons, PDO::PARAM_INT);
		$stmt->bindParam(':num_episodes', $this->num_episodes, PDO::PARAM_INT);
        $stmt->bindParam(':year_end', $this->year_end, PDO::PARAM_INT);        
        $stmt->execute();
    }

    public function update(){ // Update a record.
        $sql_query = "UPDATE series SET num_seasons = :num_seasons,
		num_episodes = :num_episodes, year_end = :year_end WHERE entity = :entity";
        
        $stmt = $this->getDb()->connect()->prepare($sql_query);

        $stmt->bindParam(':entity', $this->entity, PDO::PARAM_INT);
        $stmt->bindParam(':num_seasons', $this->num_seasons, PDO::PARAM_INT);
        $stmt->bindParam(':num_episodes', $this->num_episodes, PDO::PARAM_INT);
        $stmt->bindParam(':year_end', $this->year_end, PDO::PARAM_INT);
        $stmt->execute();
        echo "The data was changed!";
    }

    public function delete(){ // Delete a record.
        $sql_query = "DELETE FROM series WHERE entity = :entity";

        $stmt = $this->getDb()->connect()->prepare($sql_query);
		
        $stmt->bindParam(':entity', $this->entity, PDO::PARAM_INT);
        $stmt->execute();
        echo "The data was deleted!";
    }

    public function setAll($entity, $num_seasons, $num_episodes, $year_end){
        $this->setEntity($entity);
        $this->setSeasons($num_seasons);
        $this->setEpisodes($num_episodes);
        $this->setYear($year_end);
    }

}

?>