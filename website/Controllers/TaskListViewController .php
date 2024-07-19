<?php

/**
 * Model to interact with View TaskListView in database 
 */
class TaskListView extends Model {

  /**
   * setting the table to use with database
   */
  public function __construct(){
    parent::__construct('TaskListView');
  }

  /**
   * Fetching tasks by list name
   * @param String list name
   */
  public function tasksByListName($f3, $params) {
    // Fetch tasks where list name is passed as a parameter
    $listName = $params['list_name'];
    $items = $this->model->fetchTasksByListName($listName);

    $f3->set('task_list_results', $items); 
    $f3->set('list_name', $listName);
    echo $this->template->render("tasks/task_list_view.html");
  }

}
