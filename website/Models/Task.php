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

   /**
   * Fetches tasks created by user
   * @param int $user_id  Id of the user (logged in)
   * @return Object database results   * 
   */
  public function fetchAllTasksByUserId($user_id) {
    return $this->find(['user_id = ?', $user_id]);
  }


}