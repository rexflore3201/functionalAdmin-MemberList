<?php

if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $homead = $_POST["homead"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $choose = $_POST["choose"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($name, $homead, $email, $username, $pwd, $pwdRepeat, $choose) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (invalidUid($username) !== false) {
        header("location: ../signup.php?error=invaliduid");
        exit(); 
    }
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if (uidExists($conn, $username, $email) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
    
    createUser($conn, $name, $homead, $email, $username, $pwd, $choose);

}
else{
    header("location: ../signup.php");
    exit();
}