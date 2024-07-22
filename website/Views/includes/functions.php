<?php
// functions.php

// for debugging if file is included
echo 'functions.php is included';

/**
 * Checks the 'Remember me' cookie and handles user login.
 */
function checkRememberMe() {
    if (isset($_COOKIE['remember_me'])) {
        $email = $_COOKIE['remember_me'];

        // Fetch user by email from database
        // Assuming you have a User model class
        $userModel = new User(); 
        $userEmail = $userModel->fetchByName('users', 'email', $email);
        $userName = $userModel->fetchByName('users', 'email', $email);

        if ($userEmail) {
            // logging in the user automatically
            session_start();
            $_SESSION['userEmail'] = $userEmail;
            $_SESSION['userName'] = $userName;
        }
    }
}