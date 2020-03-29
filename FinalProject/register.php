<?php

// include our file of stuff we use often
use Monolog\Logger;

require "inc/functions.inc.php";

$sender['log_file_name'] = "logs/users.log";
$sender['log_type'] = Logger::INFO;
pushLog($sender);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isFieldEmpty($_POST['inputName']) || isFieldEmpty($_POST['inputEmail']) || isFieldEmpty($_POST['inputPassword']) || isFieldEmpty($_POST['inputConfirmPassword'])) {
        $sender['errorMessage'] = "All field are required.";
    } else if (!filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)) {
        $sender['errorMessage'] = "Email is not valid.";
    } else if ($_POST['inputPassword'] != $_POST['inputConfirmPassword']) {
        $sender['errorMessage'] = "Password must be the same.";
    }
    if ($sender['errorMessage'] == "") {
        $sender['tableName'] = STUDENT;
        $sender['row'] = array('stuName' => $_POST['inputName'], 'stuEmail' => $_POST['inputEmail'], 'stuPassword' => password_hash($_POST['inputPassword'], PASSWORD_DEFAULT));
        insertUpdate($sender);
        $log->info($_POST['inputName'] . " has registered ");
        header("Location: login.php");
    }
}

/*--
	Return the template page which is located in the templates folder
*/
$sender['file_name'] = "register.twig";
sendPage($sender);