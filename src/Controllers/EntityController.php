<?php

namespace Controllers;
require_once '../vendor/autoload.php';

use PDO;
use Models;

class EntityController extends BaseController
{

    
    function __construct()
    {
        parent::__construct(new Models\Entity());
    }

    public function showAll(){ // Show a list of records.
        session_start();
        $this->isSession();

        $genres = $this->getModel()->selectAll();
        include_once "../src/Views/ListEntity.html";
    }

    public function showLast(){ // Show the last records.
        $entities = $this->getModel()->selectLast();
        return $entities;
    }

    public function showOneAdmin($id){ // Prepare data for an admin page.
        session_start();
        $this->isSessionFromAdmin();
        $this->isAdmin();
        
        $this->isSession();
        $this->getModel()->setId($id);
        
        $entity = $this->getModel()->selectOne();
        var_dump($entity);
        $tag = new TagController();
        $tags_by = $tag->selectByEntity($id);

        $country = new CountryController();
        $countries_by = $country->selectByEntity($id);

        $countries_list = $country->getModel()->selectAll();
        $country->addByEntity($id);

        $profession = new ProfessionController();
        $profession_list = $profession->getModel()->selectAll();
            
        $staff = new StaffController();
        $staff_by = $staff->getModel()->selectByEntity($id);
        $staff->add($id);

        $tag->addByEntity($id);

        $character = new CharacterController();
        $character->add($id);
        $chars = $character->selectByEntity($id);

        $review = new ReviewController();
        $review->add($id);

        include_once "../src/Views/PageEntity.php";

    }

    public function showOne($id){ // Prepare data for a film/series page.
        session_start();
        
        $this->isSession();
        $this->getModel()->setId($id);
        
        $entity = $this->getModel()->selectOne();
        $tag = new TagController();
        $tags_by = $tag->selectByEntity($id);

        $country = new CountryController();
        $countries_by = $country->selectByEntity($id);
            
        $staff = new StaffController();
        $staff_by = $staff->getModel()->selectByEntity($id);

        $character = new CharacterController();
        $chars = $character->selectByEntity($id);

        include_once "../src/Views/PageEntityShow.php";

    }

    public function createReview($id){ // Add a record to the 'reviews' table.
        session_start();
        $this->isSession();
        $review = new ReviewController();
        $review->add($id);
        
        include_once "../src/Views/AddReview.php";
    }

    public function showReviews($id){ // Show all the reviews associated with a certain film/series.
        session_start();

        $this->getModel()->setId($id);
        $name = $this->getModel()->selectOne();

        $review = new ReviewController();
        $reviews_all = $review->show_all_by_entity($id);

        include_once "../src/Views/ListReviewEntity.php";
    }


    public function add(){ // Add a record to the 'entities' table and one of the additional tables.
        session_start();
        $this->isSessionFromAdmin();
        $this->isAdmin();

        $genre = new GenreController();
        $genres = $genre->getModel()->selectAll();

        $year = new Models\Year();
        $years = $year->selectAll();

        if (isset($_POST["name"], $_POST["year"], $_POST["type"], $_POST["genre"])){
                
                $a = $this->getModel()->setAll(NULL, $_POST["name"], 
                intval($_POST["year"]), intval($_POST["type"]), 
                intval($_POST["genre"]), $_POST["desc"]);

                $id = $this->getModel()->add();

                if ( $_POST["type"] == 1 ) {
                    $movie = new MovieController();
                    $movie->add($id);
                }
                else if ( $_POST["type"] == 2 ){
                    $series = new SeriesController();
                    $series->add($id);
                }

                $this->getModel()->setId($id);
                $file = $this->getModel()->file_handling($this->getModel()->getId());                
                $this->getModel()->updateWithImage($file);

            }
            include_once "../src/Views/AddEntity.html";
    }
    public function update($id){ // Update a record in the 'entities' table and in one of the additional tables.
        session_start();
        $this->isSessionFromAdmin();
        $this->isAdmin();

        $this->getModel()->setId($id);
        $entity_old = $this->getModel()->selectOne();
        
        $genre = new GenreController();
        $genres = $genre->getModel()->selectAll();

        $year = new Models\Year();
        $years = $year->selectAll();

        if (isset($_POST["name"], $_POST["genre"])){
                
            $this->getModel()->setAll($id, $_POST["name"], 
            $_POST["year"], $entity_old[0]["type"], $_POST["genre"], $_POST["desc"]);

            $result = $this->getModel()->update();

            if ( $entity_old[0]["type"] == 1 ) {
                $movie = new MovieController();
                $movie->update($id);
            }
            else if ( $entity_old[0]["type"] == 2 ){
                $series = new SeriesController();
                $series->update($id);
            }
        }
        include_once "../src/Views/EditEntity.php";

    }
    
    public function delete($id){ // Delete a record.
        session_start();
        $this->isSessionFromAdmin();
        $this->isAdmin();

        
        $this->getModel()->setId($id);
        $result = $this->getModel()->selectOne();
        $type = $result["type_name"];
        
        if ($type == "Movie") {
            $movie = new MovieController();
            $movie->delete($id);
        }
        else {
            $series = new SeriesController();
            $series->delete($id);
        }

        unlink($result["poster"]);
        $this->getModel()->delete();
    }

}


?>