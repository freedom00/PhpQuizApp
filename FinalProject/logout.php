<?php
require "inc/functions.inc.php";
// start session to have access to SESSION superglobal

$sender['log_file_name'] = "logs/users.log";
$sender['log_type'] = Logger::INFO;
pushLog($sender);

// remove all existing session data
session_destroy();
session_unset();
//log INFO - user has logged out (addtional parameter: user's name)
$log->info($userName . " has logged out ");
// redirect
header("Location: login.php");

?>