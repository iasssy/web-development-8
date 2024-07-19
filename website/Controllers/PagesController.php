<?php
// handle all non-database pages
class PagesController extends Controller{


    /**
     * Handles the rendering of the homepage
     * 
     * @param Base $f3 The Fat-Free Framework instance
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
     */
    function dashboard(){  
        $this->setPageTitle('Dashboard');
        $this->f3->set('pageDecription', 'Manage your tasks efficiently with TASK-IT intuitive Dashboard. Stay organized and focused on your goals with our powerful task management features.');   
        echo $this->template->render('dashboard.html');
    }


    /**
     * Handles the rendering of the log in page
     * 
     * @param Base $f3 The Fat-Free Framework instance
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
    }

    /**
     * Handles the rendering of the contact us page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function contact(){   
        $this->setPageTitle('Contact us');
        $this->f3->set('pageDecription', 'Contact us TASK-IT if you have any questions or suggestions.');    
        echo $this->template->render('contact-us.html');
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