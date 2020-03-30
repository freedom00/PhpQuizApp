<?php

use Monolog\Logger;

require "inc/functions.inc.php";
// start session to have access to SESSION super global

$sender['log_file_name'] = "logs/users.log";
$sender['log_type'] = Logger::INFO;
pushLog($sender);

$_SESSION['sender'] = array();

$sender['file_name'] = "index.twig";
sendPage($sender);

