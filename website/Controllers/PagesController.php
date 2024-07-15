<?php
// handle all non-database pages
class PagesController extends Controller{


    /**
     * Handles the rendering of the homepage
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function homepage($f3){
        $f3->set('pageTitle', 'Home - TASK-IT');
        $f3->set('pageDecription', 'TASK-IT: Simplify and organize your tasks effectively with our easy-to-use to-do list application.');
        echo Template::instance()->render('index.html');
    } 
    

    /**
     * Handles the rendering of the dashboard page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function dashboard($f3){    
        $f3->set('pageTitle', 'Dashboard - TASK-IT');
        $f3->set('pageDecription', 'Manage your tasks efficiently with TASK-IT intuitive Dashboard. Stay organized and focused on your goals with our powerful task management features.');   
        echo Template::instance()->render('dashboard.html');
    }


    /**
     * Handles the rendering of the log in page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function login($f3){           
        $f3->set('pageTitle', 'Login to TASK-IT');
        $f3->set('pageDecription', 'Log in to TASK-IT to access your personalized task management dashboard. Simplify your task management and stay organized with ease.');    
        echo Template::instance()->render('log-in.html');
    }
}