<?php

include 'libs/load.php';

//If logout, then it removes the DB entry on session table and destroys the session
if (isset($_GET['logout'])) {
    // Check if session_token exists in the session
    if (Session::isset_session("session_token")) {
        // Create a new UserSession object with the session token
        $Session = new UserSession(Session::get("session_token"));
        // Remove the session from the database
        if ($Session->removeSession()) {
            echo "<h3> Pervious Session is removing from db </h3>";
        } else {
            echo "<h3>Pervious Session not removing from db </h3>";
        }
    }
    // Destroy the current session
    Session::destroy();
    $redirect_url=get_config('base_path');
    //  // Redirect to the homepage
    header("Location: $redirect_url");
    die();// Terminate script execution
} else {
    Session::renderPage();
}


