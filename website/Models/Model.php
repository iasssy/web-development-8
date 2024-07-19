<?php
/**
 * Parent model class
 */
class Model extends DB\SQL\Mapper {

  
  protected $db; // database connection

  /**
   * Parent class constructor
   * @param string $table Name of the database table to interact with
   */
  public function __construct($table){
    
    $f3 = Base::instance(); // load the framework


    $db_name = $f3->get('DBNAME');
    $db_user = $f3->get('DBUSER');
    $db_pass = $f3->get("DBPASS");
    $db_port = $f3->get('DBPORT');
    // connect to the database
    try {
      $this->db = new DB\SQL(
          "mysql:host=localhost;dbname={$db_name};port={$db_port}",
          $db_user,
          $db_pass
      );
      // echo "Database connection successful.";
      } catch (Exception $e) {
          // echo "Database connection failed: " . $e->getMessage();
      }
          // creates mapper of given table
          parent::__construct($this->db, $table);

  }
  
  /**
   * Fetch all the rows in the table
   * @return Object database results
   */
  public function fetchAll(){
    $this->load(); // SELECT * FROM `model table`
    return $this->query;
  }

  /**
   * Insert a new row into the table using POST data
   * @return int Last inserted ID
   */
  public function addItem(){
    $this->copyfrom('POST');
    $this->save();

    return $this->id; // last insersted id
  }

  
  



}