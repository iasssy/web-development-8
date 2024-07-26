<?php 
// parent controller class
class Controller{

  // Instance of the Fat-Free framework object, to be able to use it in any functions without using it as function argument
  protected $f3;
  protected $template; 
  
   /**
   * Constructor method
   *
   * This method is automatically called when an instance of the Controller class is created. 
   *
   * @param Base $f3 The Fat-Free Framework instance
   */
  function __construct($f3){

    $this->f3 = $f3;
    // sets up a default page title 
    $f3->set('pageTitle', 'Task-IT');
    
    // array of errors
    $f3->set('errors', null);

    $this->template = new Template;
   
  }
 

  /**
   * Sets the page title for the application.
   *
   * This method allows changing the page title dynamically.
   * If a title already exists, it appends the new title to the current title.
   *
   * @param string $title The title to set for the page.
   */
  public function setPageTitle($title){
    $currentTitle = $this->f3->get('pageTitle');

    $newTitle = $title;

    // Appends the current title if it exists
    if ($currentTitle != ""){
        // append string
        $newTitle .= " | ". $currentTitle;
    }

    $this->f3->set('pageTitle', $newTitle);
  }

    /**
   * Check that string is withing specified length
    * @param string $strToCheck The string to be checked
    * @param int $minLength Minimum length allowed of the string to check
    * @param int $maxLength Maximum length allowed of the string to check
    * @return bool TRUE is the string is between the min and max inclusive
    */
    public function validateLength($strToCheck, $minLength, $maxLength) {  
      return (strlen($strToCheck) >= $minLength && strlen($strToCheck) <= $maxLength);
  }


  
/** 
 * TODO: doesn't work for now
 * Checks the 'Remember me' cookie and handles user login.
 */
public function checkRememberMe() {
  if (isset($_COOKIE['remember_me'])) {
      $email = $_COOKIE['remember_me'];

      // Fetch user by email from database
      // Assuming you have a User model class
      $userModel = new User(); 
      $userEmail = $userModel->fetchByName('users', 'email', $email);
      $userName = $userModel->fetchByName('users', 'email', $email);

      if ($userEmail) {
          // logging in the user automatically
          session_start();
          $_SESSION['userEmail'] = $userEmail;
          $_SESSION['userName'] = $userName;
      }
  }
}


/**
 * Function to get all POST input values, trim them, and check if any POST variables are empty
 *
 * @return boolean true if any input is empty, false otherwise
 */
public function inputTrimAndCheckIfEmpty() {
  foreach ($this->f3->get('POST') as $key => $value) {
      if (is_string( $value)){
          $value = trim($value ?? '');
      } 
      if ($value === '') {
          return true;
      }
  }
  return false;
}

/**
 * Checks if the user is logged in
 * 
 * @return bool True if logged in, false otherwise
 */
public function isLoggedIn() {
  $session = $this->f3->get('SESSION');
  
  return isset($_SESSION['userEmail'] );
}
 

/**
 * Count rows with given fieldName in any model (for the logged-in user)
 * @param $model -  model for the table in the database
 * @param $fieldName - field in the database table 
 * @param $fieldValue - field value in the database table 
 */
/*
public function rowsCount($model, $fieldName, $fieldValue){    
  $user_id = $this->f3->get('SESSION.user_id');
  $countRows = $this->$model->countRowsByFieldAndUser($fieldName, $fieldValue, $user_id);

  header('Content-Type: application/json');
  if ($countRows !== false){
    echo json_encode(['status' => 'success', 'count' => $countRows]);
  } else {
    echo json_encode(['status' => 'error', 'error' => 'Failed to fetcth important tasks.']);
  }
}
  */

}