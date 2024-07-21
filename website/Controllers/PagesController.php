<?php

// handles all pages

class PagesController extends Controller{

    private $listsModel; // table "lists" from database
    private $taskListViewModel; // View "tasklistview" from database - didn't work for now
    private $contactModel; // table "contact_us" from database
    private $userModel; // table "contact_us" from database

    public function __construct($f3) {
      parent::__construct($f3);
      $this->listsModel = new Lists(); // establish database connection with table "lists"
      $this->taskListViewModel = new TaskListView(); // establish database connection with table "lists
      $this->contactModel = new ContactUs();
      $this->userModel = new User();

    }

    /**
     * Handles the rendering of the homepage
     * 
     */
    function homepage(){
        $this->setPageTitle('Home');
        $this->f3->set('pageDecription', 'TASK-IT: Simplify and organize your tasks effectively with our easy-to-use to-do list application.');
        echo $this->template->render('index.html');
    } 
    

    /**
     * Handles the rendering of the dashboard page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     * @param string $params list name to fetch the 
     */
    function dashboard(){  

        // fetching the lists data for the lists for side bar
        $resultsLists = $this->listsModel->fetchAllList();
        $this->f3->set('resultsLists', $resultsLists);

        $this->setPageTitle('Dashboard');
        $this->f3->set('pageDecription', 'Manage your tasks efficiently with TASK-IT intuitive Dashboard. Stay organized and focused on your goals with our powerful task management features.');   
        echo $this->template->render('dashboard.html');
    }
    /*  with View TaskListView 
    function dashboard($f3, $params){  

        // fetching tasks from specified list - from View TaskListView to show in right side content
        //TODO: default - maybe order of lists, the first one in order 

        // Get list name from parameters
        $listName = $params['list_name'];
        $tasks_by_list = $this->taskListViewModel->fetchTasksByListName($listName);
        $f3->set('tasks_by_list', $tasks_by_list); 
        $f3->set('list_name', $listName);


        // fetching the data for the lists for side bar
        $resultsLists = $this->listsModel->fetchAllList();
        $this->f3->set('resultsLists', $resultsLists);

        $this->setPageTitle('Dashboard');
        $this->f3->set('pageDecription', 'Manage your tasks efficiently with TASK-IT intuitive Dashboard. Stay organized and focused on your goals with our powerful task management features.');   
        echo $this->template->render('dashboard.html');
    }
*/


    /**
     * Handles the rendering of the log in page
     * 
     */
    function login(){   
        $this->setPageTitle('Login');
        $this->f3->set('pageDecription', 'Log in to TASK-IT to access your personalized task management dashboard. Simplify your task management and stay organized with ease.');    
        echo $this->template->render('log-in.html');
    }


    // TODO: loginCheck function

    /**
     * Handles the rendering of the sign up page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function signup(){    
        // Get any success or error messages from F3
        $msg = $this->f3->get('msg') ?? '';
        $this->f3->set('msg', $msg);
        $this->setPageTitle('Sign up');
        $this->f3->set('pageDecription', 'Sign up to TASK-IT to access your personalized task management dashboard.');    
        echo $this->template->render('sign-up.html');
    }


    /**
     * Saving the data from sign up page form
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function signupSave() {

        // Validate and process form data
        if ($this->inputTrimAndCheckIfEmpty()) {
            // handle form errors
            $this->f3->set('msg', 'All fields are required.');


        } else {            
            // TODO: validation of each field? 

            // check if the email already exists in database


            // Save the data to the database
            $this->userModel->addItem();

            // Set a success message
            $this->f3->set('msg', 'You are successfully signed up!');
        }

        // Render the form page with the message
        $this->signup();
    }

    /**
     * Handles the rendering of the contact us page with fomr
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function contact(){   
        // Get any success or error messages from F3
        $msg = $this->f3->get('msg') ?? '';
        $this->f3->set('msg', $msg);

        // Set POST data for populating the form
        $postData = $this->f3->get('POST');
        $this->f3->set('item', $postData);

        $this->setPageTitle('Contact us');
        $this->f3->set('pageDecription', 'Contact us TASK-IT if you have any questions or suggestions.');    
        echo $this->template->render('contact-us.html');
    }

    /**
     * Handles the submission of the contact us page form
     */
    public function contactSave() {

        // trim POST data
        $username = trim($this->f3->get('POST.username') ?? '');
        $email = trim($this->f3->get('POST.email') ?? '');
        $comment = trim($this->f3->get('POST.comment') ?? '');

        $errors = [];

        // checking if any fields are empty
        if ($this->inputTrimAndCheckIfEmpty()) {
            $errors[] = 'All fields are required.';

        } else {
            // validating email - correct format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Invalid email format.");
            }

            if (!$this->validateLength($comment, 10, 500)) {
                array_push($errors, "Your comment must be between 10 and 500 characters.");
            }
            
        }

        // checking if there are errors
        if (!empty($errors)) {

            // $this->f3->set('msg', implode('<br>', $errors));

            $this->f3->set('errors', $errors);
        } else {
            // saving the data to the database
            $this->contactModel->addItem();

            // setting a success message
            $this->f3->set('msg', 'Your comment has been successfully sent!');


            // clearing the form fields
            $this->f3->clear('POST'); 

        }
        // rendering the form page with the message
        $this->contact();
        
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
     * Function to get all POST input values, trim them, and check if any POST variables are empty
     *
     * @return boolean true if any input is empty, false otherwise
     */
    private function inputTrimAndCheckIfEmpty() {
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



    
    
    

}