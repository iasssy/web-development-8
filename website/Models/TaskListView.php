<?php

/**
 * Model to interact with View TaskListView in database 
 */
class TaskListView extends Model{


  /**
   * Establish the table to use with database
   */
  public function __construct(){
    parent::__construct('TaskListView');
    
  }


   /**
   * Fetch tasks by list name
   * @param string $listName
   * @return Object database results
   */
  public function fetchTasksByListName($listName){
    $this->load(array('list_name = ?', $listName)); // SELECT * FROM TaskListView WHERE list_name = ?
    return $this->query;
  }


}