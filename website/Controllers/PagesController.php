<?php

// handles all pages

class PagesController extends Controller{

    private $listsModel; // table "lists" from database
    private $taskListViewModel; // View "tasklistview" from database - didn't work for now
    private $contactModel; // table "contact_us" from database

    public function __construct($f3) {
      parent::__construct($f3);
      $this->listsModel = new Lists(); // establish database connection with table "lists"
      $this->taskListViewModel = new TaskListView(); // establish database connection with table "lists
      $this->contactModel = new ContactUs();

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
     * @param String $params list name to fetch the 
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


    // TODO: loginSave function

    /**
     * Handles the rendering of the sign up page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function signup(){   
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

        // validate the form data 
        /* 
        doesn't work
        if ($this->isFormSignUpValid()) {

                // save and reroute
                $this->f3->reroute('@home');
        } else {
            
            
            echo "invalid";
            echo "<pre>";
            print_r($this->f3->get('errors'));
            echo "</pre>";

            // Render the sign-up form with errors
            $this->f3->set('errors', $this->f3->get('errors') ?? []);
            echo $this->template->render('sign-up.html');
           
        }
            */
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
        $this->setPageTitle('Contact us');
        $this->f3->set('pageDecription', 'Contact us TASK-IT if you have any questions or suggestions.');    
        echo $this->template->render('contact-us.html');
    }

    /**
     * Handles the submission of the contact us page form
     */
    public function contactSave() {
        // Get POST variables and ensure they are strings
        $username = $this->f3->get("POST.username") ?? '';
        $email = $this->f3->get("POST.email") ?? '';
        $comment = $this->f3->get("POST.comment") ?? '';

        // Validate and process form data
        if (trim($username) === "" || trim($email) === "" || trim($comment) === "") {
            // handle form errors
            $this->f3->set('msg', 'All fields are required.');
        } else {
            // Save the data to the database
            $this->contactModel->addItem();
            //$this->contactModel->createMessage($username, $email, $comment);

            // Set a success message
            $this->f3->set('msg', 'Your message has been successfully sent!');
        }

        // Render the form page with the message
        $this->contact();
    }

    

    /**
     * Validating the form inputs from sign up form
     * @return boolean returns true if the the inputs are valid
     */
    private function isFormSignUpValid(){
        
        $errors = [];

        // validate the username
        if (trim($this->f3->get('POST.username')) == "") {
            array_push($errors, 'Username is not valid');
        }
        // validate the email
        if (trim($this->f3->get('POST.email')) == "") {
            array_push($errors, 'Email is not valid');
        }
        // validate the password
        if (trim($this->f3->get('POST.password')) == "") {
            array_push($errors, 'Password is not valid');
        }
        if (empty($errors)) {
            return true;
        } else {

            $this->f3->set("item", $this->f3->get('POST'));

            $this->f3->set('errors', $errors);
            echo $this->template->render("sign-up.html");
            return false;
        }


    } 

}