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
    
  }


  /**
   * Fetch all the rows in the tables
   * @return Object database results
   */
  public function fetchAllList(){
    $this->load(); // SELECT * from lists
    return $this->query;
  }

}