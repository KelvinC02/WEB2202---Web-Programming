<?php
if (isset($_SESSION['email']))
{
    $email = htmlspecialchars($_SESSION['email']);

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
        destroy_session_and_data();

        echo '<script type="text/JavaScript">alert("session time out");</script>';
    }
    else
        $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
}
else ;

function destroy_session_and_data()
{
    //session_start();
    //$_SESSION = array();

    unset($_SESSION['email']);
    $_SESSION = array();
    session_unset();
    setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();
}
?>




