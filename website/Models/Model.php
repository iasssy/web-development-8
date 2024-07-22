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

    $db_host = $f3->get('DBHOST');
    $db_name = $f3->get('DBNAME');
    $db_user = $f3->get('DBUSER');
    $db_pass = $f3->get("DBPASS");
    $db_port = $f3->get('DBPORT');

    // connect to the database
    try {
      $this->db = new DB\SQL(
          "mysql:host={$db_host};dbname={$db_name};port={$db_port}",
          $db_user,
          $db_pass
      );
      // echo "Database connection successful.";
      } catch (Exception $e) {
          // echo "Database connection failed: " . $e->getMessage();
      }

      $this->table = $table;

      // creates mapper of given table
      parent::__construct($this->db, $table);

  }

  /** TODO: didn't work
     * Get the table name
     * @return string Table name
     */
    protected function getTable() {
      return $this->table;
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
   * Fetch a single value from the table using the `id` primary key
   * @param int Id of row to fetch
   * @return Object database result
   */
  public function fetchById( $id ){
      return $this->findone(['id=?', $id]);
  }

  
  /**
  * Fetch a single row from the table based on a dynamic column name and value
  * @param string $table the table name
  * @param string $columnName The name of the column to filter by
  * @param string $columnValue the value to match in the diven column
  * @return Object fetched database result
  * @throws InvalidArgumentException if the column name is invalid
  */
  public function fetchByName($table, $columnName, $columnValue) {
    // validate column name
    if (!$this->isValidColumn($table,$columnName)) {
        throw new InvalidArgumentException("Invalid column name: $columnName");
    }

    // Fetch the record by dynamic column name and value
    return $this->findone([$columnName . '=?', $columnValue]);
  }



  /**
   * Delete a row from the table using the `id` primary key
   * @param int ID of row to delete
   */
  public function deleteById( $id ){
      $this->load(['id=?', $id]);  // load the object
      $this->erase(); // DELETE FROM `$table` WHERE id=$id LIMIT 1
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

  /**
   * Insert a new row into the table using provided data
   * 
   * @param array $data Associative array of user data
   * @return int Last inserted ID
   */
  public function addItemWithData($data) {
    $this->copyfrom($data);
    $this->save();

    return $this->id; // Last inserted ID
  }

  /**
   * Update existing $id row from our table using POST data
   * @param int ID of the row to edit
   */
  public function updateById( $id ){
      $this->load( ['id=?', $id ]); // populate the object from the database
      $this->copyfrom('POST'); // overwrite object with form data
      $this->update(); // UPDATE $table SET ... WEHRE id=$id

  }

  
  /**
  * Validate if the column name exists in the table
  * @param string $table the table name
  * @param string $columnName The column name
  * @return boolean true if valid, false otherwise
  */
  private function isValidColumn($table, $columnName) {
    // getting the list of columns for the table
    $columns = $this->getTableColumns($table);
    
    // checking if the column name is in the list of columns
    return in_array($columnName, $columns);
  }


  /**
  * Retrieve the list of columns for the table
  * @param string $table the table name
  * @return array column names array  
  * @throws RuntimeException if the table name is invalid
  */
  private function getTableColumns($table) {
    $columns = [];


    // Debugging: Output the table name to ensure it's set
    error_log("Table Name: " . $table);

    // checking if $this->tableName is set correctly
    if (empty($table)) {
      throw new RuntimeException("Table name is not set.");
    }
    
    // execute raw SQL query to show all the table columns 
    $result = $this->db->exec("SHOW COLUMNS FROM " . $table);
          
    // fetch column names
    foreach ($result as $row) {
        $columns[] = $row['Field'];
    }
    
    return $columns;
  }

}