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
$f3->route('GET @lists: /list', 'TaskListViewController->allList');

// show list by id
$f3->route('GET @showListByIdWithTasks: /list/@id', 'TaskListViewController->showListByIdWithTasks');

// show important tasks  
// $f3->route('GET @importantTasks: dashboard/task/importance', 'TaskListViewController->importantTasks'); 

// create/add a new list
$f3->route('GET @addList: /list/add', 'TaskListViewController->addList');
$f3->route('POST @addList: /list/add', 'TaskListViewController->addListSave');

// edit list
$f3->route('GET @editList: /list/@id/edit', 'TaskListViewController->editList');
$f3->route('POST @editList: /list/@id/edit', 'TaskListViewController->editListSave');

// delete list
$f3->route('GET @deleteList: /list/@id/delete', 'TaskListViewController->deleteList');

// TASKS

// add a new task
$f3->route('GET @addTask: /list/@id/task', 'TaskListViewController->addTask');
$f3->route('POST @addTask: /list/@id/task', 'TaskListViewController->addTaskSave');

// edit the task
$f3->route('GET @editTask: /task/@id/edit', 'TaskListViewController->editTask');
$f3->route('POST @editTask: /task/@id/edit', 'TaskListViewController->editTaskSave');

// delete the task
$f3->route('GET @deleteTask: /task/@id/delete', 'TaskListViewController->deleteTask');

// completed, @status will be a new (opposite) status of the task
$f3->route('GET @changeStatusCompletedTask: /task/@id/completed/@newStatus', 'TaskListViewController->changeStatusCompletedTask');

// important task 
$f3->route('GET @changeImportanceTask: /task/@id/importance/@importance', 'TaskListViewController->changeImportanceTask');

// count all the tasks for the given list: @filterType can be 'importance', 'completed' or 'all'
$f3->route('GET @countTasksForList: /list/@id/task/@filterType/count', 'TaskListViewController->countTasksForList');



$f3->run();

