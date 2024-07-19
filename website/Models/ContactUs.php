<?php

/**
 * Model to interact with "contact_us" table from database 
 */
class ContactUs extends Model{
  
   /**
   * Setting the table to use with database
   */
  public function __construct(){
    parent::__construct('contact_us');
    
  }
  
}