<?php 
// parent controller class
class Controller{

  // Instance of the Fat-Free framework object, to be able to use it in any functions without using it as function argument
  private $f3;

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

  // TODO: to make same thing with meta description - set up default and append if it is already set
}