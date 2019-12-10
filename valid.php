<?php

// new user
if (isset($_POST["newUser"])) {
    require_once "./DatabaseAdapter.php";

    session_start();
    $_SESSION['firstName'] = $_POST['firstName'];
    $_SESSION['lastName'] = $_POST['lastName'];
    $_SESSION['username'] = $_POST['username'];
    $theDBA->addUser($_POST['firstName'], $_POST['lastName'], $_POST['username'], $_POST['password']);
    header("Location: ./valid.php");
} // login
else if (isset($_POST["login"])) {
    require_once './DatabaseAdapter.php';
    $member = $theDBA->logIn($_POST['username'], $_POST['password']);
    if ($member == true) {
        session_start();
        $_SESSION['firstName'] = $theDBA->firstName($_POST['username']);
        $_SESSION['lastName'] = $theDBA->lastName($_POST['username']);
        $_SESSION['username'] = $_POST['username'];

        // if they have an account!!!!
        if ($_SESSION['username'] == "admin") {
            header("Location: ./form.html");
        }
    } else {
        session_start();
        $_SESSION['error'] = - 1;
        header("Location: ./login.php");
    }
} else {
    require_once ("./index.html");
}
?>