<?php

function emptyInputSignup($name, $homead, $email, $username, $pwd, $pwdRepeat, $choose) {
    $result;
    if(empty($name) || empty($homead) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat) || empty($choose)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function invalidUid($username) {
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function invalidEmail($email) {
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function pwdMatch($pwd, $pwdRepeat) {
    $result;
    if($pwd !== $pwdRepeat) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){  
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss", $username, $email);
    mysqli_stmt_execute($stmt);
    
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
function createUser($conn, $name, $homead, $email, $username, $pwd, $choose) {
    $sql = "INSERT INTO users (usersName, userHome, usersEmail, usersUid, usersPwd, usersReference) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){  
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); 

    mysqli_stmt_bind_param($stmt,"ssssss", $name, $homead, $email, $username, $hashedPwd, $choose);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit(); 
}
function emptyInputLogin($username, $pwd) {
    $result;
    if(empty($username) || empty($pwd)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd, $status) {
    $uidExists = uidExists($conn, $username, $username, $status);

    if($uidExists === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    

    // if($uidExists['status'] == 0) {

    // }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed); 


    if($checkPwd === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if($checkPwd === true) {
        session_start();
        if($uidExists['status'] == 0) {
            header("location: ../login.php?error=notactivate");
            exit();
        } else {
            $_SESSION["username"] = $uidExists["usersName"];
            $_SESSION["userid"] = $uidExists["usersId"];
            $_SESSION["useruid"] = $uidExists["usersUid"];
            $_SESSION["status"] = $uidExists["status"];
            header("location: ../index.php");
            exit();
        }
        
    }
}

