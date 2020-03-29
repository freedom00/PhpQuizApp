<?php

// include our file of stuff we use often
use Monolog\Logger;

require "inc/functions.inc.php";

$sender['log_file_name'] = "logs/users.log";
$sender['log_type'] = Logger::INFO;
pushLog($sender);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isFieldEmpty($_POST['inputEmail']) || isFieldEmpty($_POST['inputPassword'])) {
        $sender['errorMessage'] = "All field are required.";
    } else if (!filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)) {
        $sender['errorMessage'] = "Email is not valid.";
    }
    if ($sender['errorMessage'] == "") {
        $sender['tableName'] = STUDENT;
        $sender['row'] = array('stuEmail' => $_POST['inputEmail']);
        $result = getRowBy($sender);
        if ($result['count'] != 1) {
            $sender['errorMessage'] = "No user with that email was found.";
        } elseif (!password_verify($_POST['inputPassword'], $result['stuPassword'])) {
            $sender['errorMessage'] = "Password does not match out records.";
        } else {
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['name'] = $result['stuName'];
            $log->info($_SESSION['name'] . " has logged in ");
            header("Location: index.php");
        }
    }
}

/*-- 
	Return the template page which is located in the templates folder
*/
$sender['file_name'] = "login.twig";
sendPage($sender);