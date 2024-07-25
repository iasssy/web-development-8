<?php

/**
 * Model to interact with lists table in database 
 */
class Lists extends Model{

  /**
   * Establish the table to use with database
   */
  public function __construct(){
    parent::__construct('lists');      
    session_start();       
  }


  /**
   * Fetch all the rows in the tables
   * @return Object database results
   */
  public function fetchAllList($user_id){
    $this->load(); // SELECT * from lists
    return $this->query;
  }

  /**
   * Fetches list created by user
   * @param int $user_id  Id of the user (logged in)
   * @return Object database results   * 
   */
  public function fetchAllListsByUserId($user_id) {
    return $this->find(['user_id = ?', $user_id]);
  }


  /*
  TODO: something with order List if I have time - maybe draggable div    
   */


}