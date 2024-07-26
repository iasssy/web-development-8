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


  /**
   * Counts the quantity of task rows where $fieldName equals $fieldValue for the given $list_id and $user_id.
   *
   * @param int $list_id - list ID
   * @param string $fieldName - The name of the field to check.
   * @param string $fieldValue - The value of the field to match.
   * @param int $user_id - The user ID.
   * @return int - The count of rows matching the criteria.
   */
  public function countTaskRowsByFieldAndUser($list_id, $user_id, $fieldName, $fieldValue) {
    $query = "SELECT COUNT(*) FROM tasks WHERE $fieldName = :fieldValue AND list_id = :list_id AND user_id = :user_id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([
        ':fieldValue' => $fieldValue,
        ':list_id' => $list_id,
        ':user_id' => $user_id
    ]);
    return $stmt->fetchColumn();
  }

  // completedTasks (html=>list, count=>statistics panel)

   /**
   * TODO
   */
  public function countAllTasksByUser($list_id, $user_id) {
    return $this->db->exec('SELECT COUNT(*) AS count FROM tasks WHERE list_id = ? AND user_id = ?', [$list_id, $user_id])[0]['count'];
  }


}