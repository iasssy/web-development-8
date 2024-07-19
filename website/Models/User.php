<?php

/**
 * Model to interact with users table in database * 
 */
class User extends Model{

  /**
   * Establish the table to use with database
   */
  public function __construct(){
    parent::__construct('users');
    
  }


  /**
   * Fetch all the rows in the tables
   * @return Object database results
   */
  public function fetchAll(){
    $this->load(); // SELECT * from users
    return $this->query;
  }

}