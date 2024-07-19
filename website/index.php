<?php

// load the composer required libraries so that any installed files to be automatically loaded by composer 
require "vendor/autoload.php";

/* setting up the invironment, so that Fat-Free framework will exist
f3 (framework engine) that holds the entire framework (server) information, 
"Base" is a core class that contains the main functionality of the framework
*/
$f3 = Base::instance(); 


// CONFIGURATION FILE
$f3->config('config.ini');
$f3->config('access.ini'); // sensitive data


// setting up a route to homepage
// @home here = alias (nickname) of the webpage
$f3->route('GET @home: /', 'PagesController->homepage'); 

$f3->route('GET @dashboard: /dashboard', 'PagesController->dashboard');

$f3->route('GET @login: /login', 'PagesController->login');

// GET request to display the sign-up form
$f3->route('GET @signup: /signup', 'PagesController->signup');  

// POST request to handle form submission
$f3->route('POST @signup: /signup', 'PagesController->signupSave'); 

$f3->route('GET @contact: /contact', 'PagesController->contact');

// LISTS
$f3->route('GET @lists: /list', 'ListsController->allList');


$f3->run();

