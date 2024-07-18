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
        echo Template::instance()->render('index.html');
    } 
    

    /**
     * Handles the rendering of the dashboard page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function dashboard(){  
        $this->setPageTitle('Dashboard');
        $this->f3->set('pageDecription', 'Manage your tasks efficiently with TASK-IT intuitive Dashboard. Stay organized and focused on your goals with our powerful task management features.');   
        echo Template::instance()->render('dashboard.html');
    }


    /**
     * Handles the rendering of the log in page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function login(){   
        $this->setPageTitle('Login');
        $this->f3->set('pageDecription', 'Log in to TASK-IT to access your personalized task management dashboard. Simplify your task management and stay organized with ease.');    
        echo Template::instance()->render('log-in.html');
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
        echo Template::instance()->render('sign-up.html');
    }


    /**
     * Saving the data from sign up page form
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function signupSave(){  
        // validate the form data       

        // save or reroute
        
        $this->f3->reroute('@home');
    }

    /**
     * Handles the rendering of the contact us page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function contact(){   
        $this->setPageTitle('Contact us');
        $this->f3->set('pageDecription', 'Contact us TASK-IT if you have any questions or suggestions.');    
        echo Template::instance()->render('contact-us.html');
    }

    private function isFormSignUpValid(){
        
        $errors = [];
        // validate the title
        if (trim($this->f3->get('POST.username')) == ""){
            array_push($errors, 'Title is not valid');
        }
        if (trim($this->f3->get('POST.email')) == ""){
            array_push($errors, 'Email is not valid');
        }
        if (empty($errors)){
            return true;
        } else {
            echo Template::instance()->render('sign-up.html');
        }


    }

}