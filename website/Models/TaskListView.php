<?php

/**
 * Model to interact with View TaskListView in database 
 */
class TaskListView extends Model{


  /**
   * Establish the table to use with database
   */
  public function __construct(){
    parent::__construct('tasklistview');
    
  }

}