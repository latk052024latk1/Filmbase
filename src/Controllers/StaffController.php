<?php

namespace Controllers;
require_once '../vendor/autoload.php';

use PDO;
use Models;

class StaffController extends BaseController
{

    
    function __construct()
    {
        parent::__construct(new Models\Staff());
    }

    public function add($id){ // Add a record.
        $person = new Models\Person();

        if (isset($_POST["person_full"]) && isset($_POST["professionId"])){
            
            $person_id = $person->selectByName($_POST["person_full"])["person_id"];
            
            $this->getModel()->setAll(NULL, $id, $person_id, $_POST["professionId"]);
            $this->getModel()->addStaff();
        }
    }    

    public function selectByEntity($id){ // Select records by a film/series.
        return $this->getModel()->selectByEntity($id);
    }
    
    public function selectByPerson($id){ // Select records by a person.
        return $this->getModel()->selectByPerson($id);
    }
    
}

?>