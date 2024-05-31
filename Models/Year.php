<?php

namespace Models;
require_once '../vendor/autoload.php';

use PDO;

// The Year class handles stuff related to years. It may make it easier to work with dates.

class Year extends BaseModel
{

	private ?int $year_id;
	private string $year;

	function __construct(){
		parent::__construct();
	}

	public function setId($year_id){
		$this->year_id = $year_id;
	}

	public function getId(){

		return $this->year_id;
	}

	public function setYear($year){
		$this->year = $year;
	}

	public function getYear(){

		return $this->year;
	}

    public function selectAll(){ // Select all the records.
        $sql = "SELECT * FROM years ORDER BY year DESC";

        $stmt = $this->getDb()->connect()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setAll($id, $year){
        $this->setId($id);
        $this->setYear($year);
    }

}

?>
