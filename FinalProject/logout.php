<?php
require "inc/functions.inc.php"; 
// start session to have access to SESSION superglobal

// import the monolog library
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
// create a log channel
$log = new Logger("phoenix_quiz_logger");
$log->pushHandler( new StreamHandler( "logs/users.log", Logger::INFO) );
// remove all existing session data
session_destroy();
session_unset();
//log INFO - user has logged out (addtional parameter: user's name)
$log->info($userName." has logged out ");
// redirect
header("Location: login.php");

?>