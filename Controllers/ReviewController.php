<?php

namespace Controllers;
require_once '../vendor/autoload.php';

use PDO;
use Models;

class ReviewController extends BaseController
{

    
    function __construct()
    {
        parent::__construct(new Models\Review());

    }

    public function add($entity_id){ // Add a record to the database table.
        $this->isSession();
        if (isset($_POST["review_text"]) && isset($_SESSION["user_id"])){
                
            $this->getModel()->setAll(NULL, $entity_id, 
            $_SESSION["user_id"], $_POST["review_name"], $_POST["review_text"]);

            return $this->getModel()->add();
        }
    }

    public function delete($id){ // Delete a record.
        session_start();
        $this->isSession();
        
        $this->getModel()->setId($id);
        $this->getModel()->delete();
    }

    public function show_one($review_id){ // Show one record.
        $this->getModel()->setId($review_id);
        return $this->getModel()->selectOne();
    }


    public function show_last($author_id){ // Show a list of the recent reviews.
        return $this->getModel()->selectLastByAuthor($author_id);
    }

    public function show_all_by_user($author_id){ // Show all the reviews, written by a certain user.
        return $this->getModel()->selectAllByAuthor($author_id);
    }

    public function show_all_by_entity($entity_id){ // Show all the reviews, associated with a certain film/series.
        return $this->getModel()->selectByEntity($entity_id);
    }

    public function edit_review($review){ // Edit a record.
        $this->isSession();

        if (isset($_POST["review_name"]) && isset($_POST["review_text"])){
            $this->getModel()->setId($review);
            $this->getModel()->setName($_POST["review_name"]);
            $this->getModel()->setText($_POST["review_text"]);

            return $this->getModel()->update();
        }      
    }
}

?>