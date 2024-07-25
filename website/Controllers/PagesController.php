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
      session_start(); 

       // Check the 'Remember me' cookie
      // checkRememberMe();

    }


    /**
     * Handles the rendering of the sign up page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function signup(){    
        // getting any success or error messages from F3
        $msg = $this->f3->get('msg') ?? '';
        $this->f3->set('msg', $msg);

        // Set POST data for populating the form
        $this->f3->set('item', $this->f3->get('POST'));
        
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
        
        // array of errors
        $errors = [];

        // validating and processing form data
        if ($this->inputTrimAndCheckIfEmpty()) {
            // handle form errors
           array_push($errors, 'All fields are required.');
        } else {                        
            // validating email - correct format
            $email=trim($this->f3->get('POST.email'));
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Invalid email format.");
            } else {
                 // check if the email already exists in database
                $user = $this->userModel->fetchByName('users','email',$email);

                // checking if email exist
                if ($user){
                    array_push($errors, "Email already exists in database.");
                }
            }
                        
            // validating password
            $password=trim($this->f3->get('POST.password'));

            // validate password length
            if (!$this->validateLength($password, 6, PHP_INT_MAX)) {
                array_push($errors, "Password must be at least 6 characters long.");
            } else {
                // additional password validations
                if (!preg_match('/[A-Z]/', $password)) {
                    array_push($errors, "Password must include at least one uppercase letter.");
                }
                if (!preg_match('/[a-z]/', $password)) {
                    array_push($errors, "Password must include at least one lowercase letter.");
                }
                if (!preg_match('/[0-9]/', $password)) {
                    array_push($errors, "Password must include at least one number.");
                }
                if (!preg_match('/[\W_]/', $password)) {
                    array_push($errors, "Password must include at least one special character.");
                }
            }                
               
        }

        // checking if there are errors
        if (!empty($errors)) {
            $this->f3->set('errors', $errors);
        } else {
            // Hash the password before saving
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // verififcation of password hashing fror debugging 
            if ($hashedPassword === false) {
                array_push($errors, "Password hashing failed.");
                $this->f3->set('errors', $errors);
            } else {
                // for debugging
                echo "Hashed password: " . htmlspecialchars($hashedPassword) . "<br>";
                // the modified data to be saved to the database
                $newUser = [
                    'username' => trim($this->f3->get('POST.username')),
                    'email' => $email,
                    'password' => $hashedPassword
                ];

                // debugging the data being saved
                // echo "User data being saved: " . print_r($newUser, true) . "<br>";

                $result = $this->userModel->addItemWithData($newUser);

                if ($result) {
                    // setting a success message
                    $this->f3->set('msg', 'You are successfully signed up!');

                    // clearing the form fields
                    $this->f3->clear('POST');

                        
                    $rememberMe = $this->f3->get('POST.remember_me') == '1';
                    // printing the "Remember me" value for debugging
                    // echo "Remember me value: " . htmlspecialchars($rememberMe) . "<br>";

                    // if "Remember me" is checked
                    if (!empty($rememberMe) && $rememberMe == '1') {
                        //setting a cookie to remember the user
                        setcookie('remember_me', $email, time() + (86400 * 30), "/"); // cookie expires in 30 days
                    } else {
                        // deleting cookie "Remember me" if it is not checked
                        if (isset($_COOKIE['remember_me'])) {
                            setcookie('remember_me', '', time() - 3600, "/"); // Delete the cookie
                        }
                    }
                }                
            }
        }

        // Render the form page with the message
        $this->signup();
    }

    /**
     * Handles the rendering of the log in page
     * 
     */
    function login(){   
        // setting POST data for populating the form
        $this->f3->set('item', $this->f3->get('POST'));

        $this->setPageTitle('Login');
        $this->f3->set('pageDecription', 'Log in to TASK-IT to access your personalized task management dashboard. Simplify your task management and stay organized with ease.');    
        echo $this->template->render('log-in.html');
    }

    /**
     * Handles the login process
     */
    function loginProcess() {
        // array of error messages
        $errors = [];

        // validating POST inputs
        if ($this->inputTrimAndCheckIfEmpty()) {
            array_push($errors, 'Email and password are required.');
        } else {
            // Get POST data
            $email = trim($this->f3->get('POST.email'));
            $password = trim($this->f3->get('POST.password'));

            // validating email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, 'Invalid email format.');
            } else {
                // fetching user data by email
                $user = $this->userModel->fetchByName('users', 'email', $email);

                if (!$user){
                    array_push($errors, 'Invalid credentials.');
                } else {
                    // verifying the password
                    if (!password_verify($password, $user['password'])) {
                        array_push($errors, 'Invalid credentials.');
                    } else {
                         // successful login
                        session_start();
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['userEmail'] = $user['email'];
                        $_SESSION['userName'] = $user['username']; 

                        // redirect to dashboard
                        $this->f3->reroute('@dashboard'); 
                        return;
                    }
                }
            }
        }

        // set errors and re-render the login page
        $this->f3->set('errors', $errors);
        $this->login(); // Re-render login page with errors
    }


    /**
     * Handles user logout
     */
    function logout() {
        session_start();
        session_unset();
        session_destroy();

        // Remove 'remember_me' cookie if set
        if (isset($_COOKIE['remember_me'])) {
            setcookie('remember_me', '', time() - 3600, "/");
        }

        $this->f3->reroute('@home'); // Redirect to home or any other page
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
        $this->f3->set('item', $this->f3->get('POST'));

        $this->setPageTitle('Contact us');
        $this->f3->set('pageDecription', 'Contact us TASK-IT if you have any questions or suggestions.');    
        echo $this->template->render('contact-us.html');
    }

    /**
     * Handles the submission of the contact us page form
     */
    function contactSave() {

        $errors = [];

        // checking if any fields are empty
        if ($this->inputTrimAndCheckIfEmpty()) {
            $errors[] = 'All fields are required.';

        } else {

            // validating email - correct format
            if (!filter_var(trim($this->f3->get('POST.email')), FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Invalid email format.");
            }

            if (!$this->validateLength(trim($this->f3->get('POST.comment')), 10, 500)) {
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

        if (!$this->isLoggedIn()) {
            // Redirect to login page if not logged in
            $this->f3->reroute('@login');
        }

        // getting user_id from session
        $user_id = $this->f3->get('SESSION.user_id');

        // Fetch user details
        $user = $this->userModel->fetchById($user_id);
        $this->f3->set('user', $user);

        // fetching the lists data for the lists for side bar (for the logged-in user)
        $resultsLists = $this->listsModel->fetchAllListsByUserId($user_id);
        $this->f3->set('resultsLists', $resultsLists);

        $this->setPageTitle('Dashboard');
        $this->f3->set('pageDecription', 'Manage your tasks efficiently with TASK-IT intuitive Dashboard. Stay organized and focused on your goals with our powerful task management features.');   
        echo $this->template->render('dashboard.html');
    }

    
    
    
    

}