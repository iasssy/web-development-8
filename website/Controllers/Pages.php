<?php
// handle all non-database pages
class Pages{
    /**
     * Handles the rendering of the homepage
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function homepage($f3){
        echo Template::instance()->render('index.html');
    } 
    

    /**
     * Handles the rendering of the dashboard page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function dashboard($f3){       
        echo Template::instance()->render('dashboard.html');
    }


    /**
     * Handles the rendering of the log in page
     * 
     * @param Base $f3 The Fat-Free Framework instance
     */
    function login($f3){               
        echo Template::instance()->render('log-in.html');
    }
}