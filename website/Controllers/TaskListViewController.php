<?php

/**
 * Controller to handle View TaskListView from database 
 */
class TaskListViewController extends Controller {

  private $taskListViewModel;
  /**
   * setting the table to use with database
   */
  public function __construct($f3){
    parent::__construct($f3);
    $this->taskListViewModel = new TaskListView(); // establish database connection 
  }

  /**
   * TODO description
   */
  public function showListByIdWithTasks($f3, $params) {
    // Ensure params['id'] is available
    if (!isset($params['id'])) {
        // error_log("Error: 'id' parameter is missing");
        $errors = ["List ID parameter is missing"];
        $f3->set('errors', $errors);
        echo $this->template->render("tasks/task_list_view.html");
        return;
    }

    $list_id = $params['id'];
    // error_log("List ID: $list_id");

    $item_task_list = $this->taskListViewModel->fetchTableByColumnValue('tasklistview', 'list_id', $list_id);

    // Debugging output
    // error_log("Fetched Data: " . print_r($item_task_list, true));

    if (empty($item_task_list)) {
        $errors = ["List is empty"];
        $f3->set('errors', $errors);
    } else {
        $f3->set('item_task_list', $item_task_list);
    }

    echo $this->template->render("tasks/task_list_view.html");
}


}
