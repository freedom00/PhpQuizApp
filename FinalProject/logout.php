<?php

use Monolog\Logger;

require "inc/functions.inc.php";
// start session to have access to SESSION superglobal

$sender['log_file_name'] = "logs/users.log";
$sender['log_type'] = Logger::INFO;
pushLog($sender);

//log INFO - user has logged out (addtional parameter: user's name)
$log->info($_SESSION['name'] . " has logged out ");

// remove all existing session data
session_destroy();
session_unset();

// redirect
header("Location: index.php");
