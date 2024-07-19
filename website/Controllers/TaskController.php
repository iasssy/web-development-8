<?php
// handle 'tasks' table in database

class TaskController extends Controller{

  private $taskModel; // table "contact_us" from database

  public function __construct($f3){
    // execute parent constructor
    parent::__construct($f3);
    
    $this->taskModel = new Task(); // establish database connection 
  }

  public function addTask(){
    $this->taskModel->addItem();
  }
}