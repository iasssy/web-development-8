<?php

// load the composer required libraries so that any installed files to be automatically loaded by composer 
require "vendor/autoload.php";

/* setting up the invironment, so that Fat-Free framework will exist
f3 (framework engine) that holds the entire framework (server) information, 
"Base" is a core class that contains the main functionality of the framework
*/
$f3 = Base::instance(); 

// setting up a route to homepage
// @home here = alias
$f3->route('GET @home: /', 'Pages->homepage'); 

$f3->route('GET @dashboard: /dashboard', 'Pages->dashboard');

// handle all non-databse pages
class Pages{
    function homepage($f3){
        // route alias (nickname)
        $dashboard_route = $f3->get('BASE').$f3->alias('dashboard');

        echo "Homepage content";
        echo "<a href='{$dashboard_route}'>Dashboard</a>";

    } 
    
    function dashboard($f3){
        // route alias (nickname)
        $home_route = $f3->get('BASE').$f3->alias('home');

        echo "Dashboard content";
        echo "<a href='{$home_route}'>Home</a>";
    }
}



$f3->run();

