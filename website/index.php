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
// TODO: list name or 1st list in order $f3->route('GET @dashboard: /dashboard/list/@list_name', 'PagesController->dashboard');

// Log in hadling
$f3->route('GET @login: /login', 'PagesController->login');
$f3->route('POST @login: /login', 'PagesController->loginProcess');

// Log out 
$f3->route('GET @logout: /logout', 'PagesController->logout');

// GET request to display the sign-up form
$f3->route('GET @signup: /signup', 'PagesController->signup');  

// POST request to handle form submission
$f3->route('POST @signup: /signup', 'PagesController->signupSave'); 

// Contact us form
$f3->route('GET @contact: /contact', 'PagesController->contact');
$f3->route('POST @contact: /contact', 'PagesController->contactSave');


// LISTS

// all the lists
$f3->route('GET @lists: /list', 'ListsController->allList');

// show list by id
$f3->route('GET @showListByIdWithTasks: /dashboard/list/@id', 'TaskListViewController->showListByIdWithTasks');

// show important tasks  
// $f3->route('GET @importantTasks: dashboard/task/important', 'TaskController->importantTasks'); // or TaskListViewController

// create/add a new list
$f3->route('GET @addList: /list/add', 'ListsController->addList');
$f3->route('POST @addList: /list/add', 'ListsController->addListSave');

// modify (delete or update)
$f3->route('GET @modifyList: /list/modify', 'ListsController->modifyList');

// TASKS

// add a new task - save form data  
// $f3->route('POST @addTask: /task', 'TaskController->addTask');

// fetching tasks by list name
$f3->route('GET @tasksByListName: /tasks/@list_name', 'TaskListViewController->tasksByListName');


$f3->run();

