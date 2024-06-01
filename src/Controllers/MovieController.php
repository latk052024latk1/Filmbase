<?php

namespace Controllers;
require_once '../vendor/autoload.php';

use PDO;
use Models;

class MovieController extends BaseController
{

    
    function __construct()
    {
        parent::__construct(new Models\Movie());
    }

    public function add($entity_id){ // Add a record.
        if (isset($_POST["duration"])){
                
                $this->getModel()->setAll($entity_id, $_POST["duration"]);
                $this->getModel()->add();
        }
    }
    public function update($id){ // Update a record.
        if (isset($_POST["duration"])){
                
            $this->getModel()->setAll($id, $_POST["duration"]);
            return $this->getModel()->update();
        }
    }
    public function delete($id){ // Delete a record.
        $this->getModel()->setId($id);
        $this->getModel()->delete();
        
    }

}

?>