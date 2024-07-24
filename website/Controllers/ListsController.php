<?php
// handle lists table in database

class ListsController extends Controller{

  private $listsModel; // database object

  public function __construct($f3){
    // execute parent constructor
    parent::__construct($f3);    
    $this->listsModel = new Lists(); // establish database connection      
    session_start();   
  }

  /**
   * Fetching all the rows
   */
  public function allList(){      
    
    // getting user_id from session
    $user_id = $this->f3->get('SESSION.user_id');

    // fetch all the rows
    $itemsList = $this->listsModel->fetchAllListsByUserId($user_id);
    $this->f3->set('resultsLists', $itemsList); 
    /* echo '<pre>';
    var_dump($this->f3->get('results')); // debugging
    */
    echo $this->template->render("tasks/lists.html");
  }

  /**
   * Rendering form for creating a new List
   */
  function addList(){
    // TODO: getting error message ?
    
    // setting POST data for populating the form
    $this->f3->set('item', $this->f3->get('POST'));
    // rendering add list form
    echo $this->template->render('tasks/newList.html');
  }

  /**
   * Saves the data from the form for creating a new List
   */
  function addListSave(){  
    
    // array of errors
    $errors = [];
    
    // getting user_id from session
    $user_id = $this->f3->get('SESSION.user_id');

    $title=trim($this->f3->get('POST.title'));

    // check if the list already exists in database for the given user? 
    $listAlreadyExist = $this->listsModel->fetchByName('lists','title', $title);
    if ($listAlreadyExist ){
      array_push($errors, "List {$title} already exists.");

    } else {   
      // validating length        
      if (!$this->validateLength(trim($this->f3->get('POST.title')), 3, 50)) {
        array_push($errors, "Your list title must be between 3 and 50 characters.");
      } 
    }

    // checking if there are errors
    if (!empty($errors)) {
      // added headers to prevent the browser from interpreting the response as HTML
      header('Content-Type: application/json');
      // returning as JSON with status error
      echo json_encode(['status' => 'error', 'errors' => $errors]);

    } else {
        $newList = ['title' => $title, 'user_id' => $user_id];
        // saving the new list
        $this->listsModel->addItemWithData($newList);

        // Fetch the updated lists for rendering
        $resultsLists = $this->listsModel->fetchAllListsByUserId($user_id); // Example fetch method
        $this->f3->set('resultsLists', $resultsLists);

        // rendering the updated HTML for the lists container
        $html = $this->template->render('tasks/lists.html');
        // returning as JSON with status success
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'html' => $html]);

    }
  }


  
 

}

