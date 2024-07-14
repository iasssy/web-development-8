<?php
// handle all non-databse pages
class Pages{


    /**
     * Handles the rendering of the homepage.
     * 
     * @param Base $f3 The Fat-Free Framework instance.
     */
    function homepage($f3){
        // route alias (nickname)        
        $dashboard_route = $f3->get('BASE').$f3->alias('dashboard');
        // $f3->get('BASE') - retrieves the base URL of the application
        
        echo Template::instance()->render('index.html');

    } 
    

    /**
     * Handles the rendering of the dashboard page.
     * 
     * @param Base $f3 The Fat-Free Framework instance.
     */
    function dashboard($f3){
        
        $home_route = $f3->get('BASE').$f3->alias('home');
        
        echo Template::instance()->render('dashboard.html');
        echo "<a href='{$home_route}'>Home</a>";
    }
}