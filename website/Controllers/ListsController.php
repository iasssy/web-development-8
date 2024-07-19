<?php
// handle lists table in database

class ListsController extends Controller{

  private $model; // database object

  public function __construct($f3){
    // execute parent constructor
    parent::__construct($f3);
    
    $this->model = new Lists(); // establish database connection    
}

/**
 * Listing all the portfolio items
 */
public function allList(){
    
    // fetch all the rows
    $items = $this->model->fetchAllList();

    $this->f3->set('results', $items); 
    echo '<pre>';
     var_dump($this->f3->get('results')); // Debugging statement
    echo $this->template->render("tasks/lists.html");
}

}