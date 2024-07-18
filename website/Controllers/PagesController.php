<?php
// handle all non-database pages
class PagesController extends Controller{


    /**
     * Handles the rendering of the homepage
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function homepage($f3){
        $this->setPageTitle('Home');
        $f3->set('pageDecription', 'TASK-IT: Simplify and organize your tasks effectively with our easy-to-use to-do list application.');
        echo Template::instance()->render('index.html');
    } 
    

    /**
     * Handles the rendering of the dashboard page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function dashboard($f3){  
        $this->setPageTitle('Dashboard');
        $f3->set('pageDecription', 'Manage your tasks efficiently with TASK-IT intuitive Dashboard. Stay organized and focused on your goals with our powerful task management features.');   
        echo Template::instance()->render('dashboard.html');
    }


    /**
     * Handles the rendering of the log in page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function login($f3){   
        $this->setPageTitle('Login');
        $f3->set('pageDecription', 'Log in to TASK-IT to access your personalized task management dashboard. Simplify your task management and stay organized with ease.');    
        echo Template::instance()->render('log-in.html');
    }



    /**
     * Handles the rendering of the sign up page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function signup($f3){   
        $this->setPageTitle('Sign up');
        $f3->set('pageDecription', 'Sign up to TASK-IT to access your personalized task management dashboard.');    
        echo Template::instance()->render('sign-up.html');
    }


    /**
     * Handles the rendering of the contact us page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function contact($f3){   
        $this->setPageTitle('Contact us');
        $f3->set('pageDecription', 'Contact us TASK-IT if you have any questions or suggestions.');    
        echo Template::instance()->render('contact-us.html');
    }

}