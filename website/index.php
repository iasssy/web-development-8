<?php

// load the composer required libraries so that any installed files to be automatically loaded by composer 
require "vendor/autoload.php";

/* setting up the invironment, so that Fat-Free framework will exist
f3 (framework engine) that holds the entire framework (server) information, 
"Base" is a core class that contains the main functionality of the framework
*/
$f3 = Base::instance(); 

// framework to automatically load the classes
$f3->set('AUTOLOAD', 'Controllers/');

// framework to automatically load templates (VIEWS)
$f3->set('UI', 'Views/');


// setting up a route to homepage
// @home here = alias (nickname) of the webpage
$f3->route('GET @home: /', 'Pages->homepage'); 

$f3->route('GET @dashboard: /dashboard', 'Pages->dashboard');


$f3->run();

