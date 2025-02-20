<?php
    if (session_status() === PHP_SESSION_NONE) {
        $hour = 3600;
        $day = 24*$hour;
        $month = 30*$day;

        ini_set('session.gc_maxlifetime', 2*$month); 
        session_set_cookie_params( 2*$month);
        session_start();
    }

    function isLoggedIn() {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
 
    function isAdmin() {
        if (isset($_SESSION['role']) && $_SESSION['role']=="admin") {
            return true;
        } else {
            return false;
        }
    }
?>
