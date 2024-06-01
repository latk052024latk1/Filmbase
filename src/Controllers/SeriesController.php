<?php

namespace Controllers;
require_once '../vendor/autoload.php';

use PDO;
use Models;

class SeriesController extends BaseController
{

    
    function __construct()
    {
        parent::__construct(new Models\Series());
    }

    public function add($entity_id){
        if (isset($_POST["num_seasons"]) 
            && isset($_POST["num_episodes"]) && isset($_POST["year_end"]) ){
                
                $this->getModel()->setAll($entity_id, $_POST["num_seasons"], 
                                $_POST["num_episodes"], $_POST["year_end"]);

                $this->getModel()->add();
            }
    }
    public function update($id){
        if ( isset($_POST["num_seasons"], $_POST["num_episodes"], $_POST["year_end"]) ){
                
                $this->getModel()->setAll($id, $_POST["num_seasons"], 
                        $_POST["num_episodes"], $_POST["year_end"]);

                $this->getModel()->update();
            }
    }
    public function delete($id){
        $this->getModel()->setId($id);
        $this->getModel()->delete();
            
    }

}


?>