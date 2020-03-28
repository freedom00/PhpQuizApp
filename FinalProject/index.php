<?php

use Monolog\Logger;

require "inc/functions.inc.php";
// start session to have access to SESSION superglobal

$sender['log_file_name'] = "logs/users.log";
$sender['log_type'] = Logger::INFO;
pushLog($sender);

$sender['file_name'] = "index.twig";
sendPage($sender);

