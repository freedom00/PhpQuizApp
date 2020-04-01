<?php

// include our file of stuff we use often
use Monolog\Logger;

require "inc/functions.inc.php";

$sender['file_name'] = "login.twig";

$sender['log_file_name'] = "logs/users.log";
$sender['log_type'] = Logger::INFO;
pushLog($sender);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isFieldEmpty($_POST['inputEmail']) || isFieldEmpty($_POST['inputPassword'])) {
        $sender['errorMessage'] = "All field are required.";
        sendPage($sender);
        die();
    }
    if (!filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)) {
        $sender['errorMessage'] = "Email is not valid.";
        sendPage($sender);
        die();
    }

    $sender['tableName'] = STUDENT;
    $sender['column'] = array('stuEmail' => $_POST['inputEmail']);
    $student = getRowBy($sender);

    $sender['tableName'] = TEACHER;
    $sender['column'] = array('tchEmail' => $_POST['inputEmail']);
    $teacher = getRowBy($sender);

    if ($student['count'] < 1 && $teacher['count'] < 1) {
        $sender['errorMessage'] = "No user with that email was found.";
        sendPage($sender);
        die();
    }

    if ($student['count'] > 0 && password_verify($_POST['inputPassword'], $student['stuPassword'])) {
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['name'] = $student['stuName'];
        $_SESSION['occupation'] = STU;
        $log->info($_SESSION['name'] . " has logged in ");
        header("Location: index.php");
        die();
    } elseif ($teacher['count'] > 0 && password_verify($_POST['inputPassword'], $teacher['tchPassword'])) {
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['name'] = $teacher['tchName'];
        $_SESSION['occupation'] = TCH;
        $log->info($_SESSION['name'] . " has logged in ");
        header("Location: index.php");
        die();
    } else {
        $sender['errorMessage'] = "Password does not match out records.";
    }
}

/*-- 
	Return the template page which is located in the templates folder
*/

sendPage($sender);