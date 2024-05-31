<?php

namespace Controllers;
require_once '../vendor/autoload.php';

use PDO;
use Models;

class CountryController extends BaseController
{

    
    function __construct()
    {
        parent::__construct(new Models\Country());
    }

    public function showAll(){ // Show a list of records.
        session_start();
        $this->isSession();
        $this->isAdmin();
        
        $countries = $this->getModel()->selectAll();
        include_once "../src/Views/ListCountry.html";
    }

    public function showOne($id){ // Show one record.
        session_start();
        $this->isSession();
        $this->isAdmin();
        
        $this->getModel()->setId($id);
        $country_data = $this->getModel()->selectOne();
        
        include_once "../src/Views/PageCountry.html";

    }

    public function add(){ // Add a record to the database table and then update the file path.
        session_start();
        $this->isSession();
        $this->isAdmin();

        if (isset($_POST["name"])){

            $this->getModel()->setName($_POST["name"]);

            $id = $this->getModel()->add();
            $this->getModel()->setId($id);

            $file = $this->getModel()->file_handling($this->getModel()->getId());
            $this->getModel()->updateWithImage($file);
        }   
        
        include_once "../src/Views/AddCountry.html";
    }

    public function update($id){ // Edit a record.
        session_start();
        $this->isSession();
        $this->isAdmin();
        
        if (isset($_POST["name"])){
                
            $this->getModel()->setAll($_POST["name"]);
            $this->getModel()->update();
        }
    }
    public function delete($id){ // Delete a record.
        session_start();
        $this->isSession();
        $this->isAdmin();

        $this->getModel()->setId($id);
        $result = $this->getModel()->selectOne();

        unlink($result["flag"]);
        $this->getModel()->delete();
    }

    public function addByEntity($id){ // Add a record to a pivot table.

        if (isset($_POST["countryId"])){
            $this->getModel()->setId($_POST["countryId"]);
            $this->getModel()->addByEntity($id);
        }
    }

    public function selectByEntity($id){ // Select records associated with a certain film/series.
        return $this->getModel()->selectByEntity($id);
    }

    public function addByPerson($id){ // Add a record to a pivot table.

        if (isset($_POST["countryId"])){
            $this->getModel()->setId($_POST["countryId"]);
            $this->getModel()->addByPerson($id);
        }
    }

    public function selectByPerson($id){ // Select records associated with a certain person.
        return $this->getModel()->selectByPerson($id);
    }
    
}


?>