<?php

/**
 * Model to interact with users table in database * 
 */
class Task extends Model{

  /**
   * Establish the table to use with database
   */
  public function __construct(){
    parent::__construct('tasks');
    
  }


  /**
   * Fetch all the rows in the tables
   * @return Object database results
   */
  public function fetchAllTasks(){
    $this->load(); // SELECT * from tasks
    return $this->query;
  }

}