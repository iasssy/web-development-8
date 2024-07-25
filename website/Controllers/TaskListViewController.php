<?php

/**
 * Controller to handle View TaskListView from database 
 */
class TaskListViewController extends Controller {

  private $taskListViewModel;
  private $listsModel;
  private $taskModel;
  /**
   * setting the table to use with database
   */
  public function __construct($f3){
    parent::__construct($f3);
    $this->taskListViewModel = new TaskListView(); 
    $this->listsModel = new Lists(); 
    $this->taskModel = new Task(); 
  }

  /**
   * TODO description
   */
  public function showListByIdWithTasks($f3, $params) {

    $errors = []; 

    if (!isset($params['id'])) {
        // error_log("Error: 'id' parameter is missing");
        $errors = ["List ID parameter is missing"];
        $f3->set('errors', $errors);
        echo $this->template->render("tasks/task-list-view.html");
        return;
    }

    $list_id = $params['id'];
    // error_log("List ID: $list_id");

    $item_task_list = $this->taskListViewModel->fetchTableByColumnValue('tasklistview', 'list_id', $list_id);

    // fetching lists table by list ID
    $listInfo = $this->listsModel->fetchById($list_id);
    if (!$listInfo) {
      array_push($errors, "List not found");
      $f3->set('errors', $errors);
      echo $this->template->render("tasks/task-list-view.html");
      return;
    }

    $title=$listInfo['title'];
    // Debugging output
    // error_log("Fetched Data: " . print_r($item_task_list, true));


    if (empty($item_task_list)) {
        array_push($errors, "{$title} list is empty");
        $f3->set('errors', $errors);
    } else {
        $f3->set('item_task_list', $item_task_list);
    }

    echo $this->template->render("tasks/task-list-view.html");
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
  public function addList(){
    // TODO: getting error message ?
    
    // setting POST data for populating the form
    $this->f3->set('item', $this->f3->get('POST'));
    // rendering add list form
    echo $this->template->render('tasks/new-list.html');
  }

  /**
   * Saves the data from the form for creating a new List
   */
  public function addListSave(){  
    
    // array of errors
    $errors = [];
    
    // getting user_id from session
    $user_id = $this->f3->get('SESSION.user_id');

    $title=trim($this->f3->get('POST.title'));

    // check if the list already exists in database for the given user? 
    $listAlreadyExist = $this->listsModel->fetchTableByColumnValueForUser($user_id,'lists','title', $title);
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

        // fetch the updated lists for rendering
        $resultsLists = $this->listsModel->fetchAllListsByUserId($user_id); 
        $this->f3->set('resultsLists', $resultsLists);

        // rendering the updated HTML for the lists container
        $html = $this->template->render('tasks/lists.html');
        // returning as JSON with status success
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'html' => $html]);

    }
  }



  /**
   * Rendering form for editing the list
   */
  public function editList(){    
    // fetching the list ID from URL parameters
    $list_id = $this->f3->get('PARAMS.id');
    // error_log("list_id = " . $list_id);

    $itemList = $this->listsModel->fetchById($list_id);

    // error_log($itemList['title']);
    // checking if itemList is an array
    if ($itemList) {
      $this->f3->set('itemList', $itemList);
      
      // rendering the form for editing the list
      echo Template::instance()->render('tasks/edit-list.html');
    } else {
        // Handle error, item not found
        echo 'List item not found';
    }
  }
  /**
   * Submitting form for editing the list
   */
  public function editListSave(){
    $errors = [];

    // checking if any fields are empty
    if ($this->inputTrimAndCheckIfEmpty()) {
        array_push($errors, "Field is required.");

    } else {
      $title = trim($this->f3->get('POST.title'));
      // Validating title length        
      if (!$this->validateLength($title, 3, 50)) {
          array_push($errors, "List title must be between 3 and 50 characters.");
      }
        
    }

    // Checking if there are errors
    if (!empty($errors)) {
      // to prevent the browser from interpreting the response as HTML
      header('Content-Type: application/json');
      // returning as JSON with status error
      echo json_encode(['status' => 'error', 'errors' => $errors]);
    } else {
        $list_id = $this->f3->get('POST.list_id');

        // Ensure list_id is valid
        if (is_numeric($list_id) && $list_id > 0) {
          // updating the list
          $this->listsModel->updateById($list_id, ['title' => $title]);

          // fetching the updated lists for rendering
          $user_id = $this->f3->get('SESSION.user_id');
          $resultsLists = $this->listsModel->fetchAllList($user_id);
          $this->f3->set('resultsLists', $resultsLists);

          // capturing HTML output
          ob_start();
          echo Template::instance()->render('tasks/lists.html');
          $html = ob_get_clean();

          // returning as JSON with status success
          header('Content-Type: application/json');
          echo json_encode(['status' => 'success', 'html' => $html]);
        } else {
            // Handle error for invalid list ID
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'errors' => ["Invalid list ID"]]);
        }
    }
  }

  /**
   * Rendering form for editing the list
   */
  public function deleteList(){    
    // fetching the list ID from URL parameters
    $list_id = $this->f3->get('PARAMS.id');
    error_log("list_id = " . $list_id);

    
    // Ensure list_id is valid
    if (is_numeric($list_id) && $list_id > 0) {
      $this->listsModel->deleteById($list_id);
      
      // fetching the updated lists for rendering
      $user_id = $this->f3->get('SESSION.user_id');
      $resultsLists = $this->listsModel->fetchAllList($user_id);
      $this->f3->set('resultsLists', $resultsLists);
      // capturing HTML output
      ob_start();
      echo Template::instance()->render('tasks/lists.html');
      $html = ob_get_clean();

      // returning as JSON with status success
      header('Content-Type: application/json');
      echo json_encode(['status' => 'success', 'html' => $html]);
    } else {
      // error for invalid list ID
      header('Content-Type: application/json');
      echo json_encode(['status' => 'error', 'errors' => ["Invalid list ID"]]);
    }

  }


  /**
   * Renders a form for creating a new task (for the rendered list)
   */
  function addTask($f3, $params){
    $list_id = $this->f3->get('PARAMS.id');
    error_log("addTask list_id = " . $list_id);
    $this->f3->set('item', $this->f3->get('POST'));
    echo $this->template->render('tasks/new-task.html');
  }


  /**
   * Saves the data from the form for creating a new task
   */
  function addTaskSave(){
    $list_id = $this->f3->get('PARAMS.id');
    error_log("addTaskSave list_id = " . $list_id);
    // array of errors
    $errors = [];

    // getting user_id from session
    $user_id = $this->f3->get('SESSION.user_id');

    $title=trim($this->f3->get('POST.title'));
    // error_log("title: ".$title);
    // check if the task already exists in database for the logged-in user
    $taskAlreadyExist = $this->taskListViewModel->fetchTableByColumnValueForUser($user_id,'tasklistview','task_title', $title);
    // error_log("Fetched Data: " . print_r($taskAlreadyExist, true));

    if ($taskAlreadyExist ){
      array_push($errors, 'Task "{$title}" already exists.');

    } else {   
      // validating length        
      if (!$this->validateLength($title, 3, 50)) {
        array_push($errors, "Your task title must be between 3 and 50 characters.");
      } 
    }

    // checking if there are errors
    if (!empty($errors)) {
      // added headers to prevent the browser from interpreting the response as HTML
      header('Content-Type: application/json');
      // returning as JSON with status error
      echo json_encode(['status' => 'error', 'errors' => $errors]);

    } else {
        $description=$this->f3->get('POST.description');

        $newTask = ['title' => $title,'description' => $description, 'user_id' => $user_id, 'list_id'=> $list_id ];
        // error_log("Fetched Data: " . print_r($newTask, true));
        // saving the new task
        $this->taskModel->addItemWithData($newTask);

        // fetch the updated lists for rendering
        $resultsTask = $this->taskModel->fetchAllTasksByUserId($user_id); 
        $this->f3->set('resultsTask', $resultsTask);
        
        ob_start();
        $html = $this->showListByIdWithTasks($this->f3, ['id' => $list_id]);
        $html = ob_get_clean();

        // returning as JSON with status success
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'html' => $html]);
    }

  }



}