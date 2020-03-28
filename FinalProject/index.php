<?php

require "inc/functions.inc.php"; 
// start session to have access to SESSION superglobal

// import the monolog library
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
// create a log channel
$log = new Logger("phoenix_quiz_logger");
$log->pushHandler( new StreamHandler( "logs/users.log", Logger::INFO) );
// MEEKRO QUERY
$subjects = DB::query("SELECT * FROM final_project_subject");

$currentYear = date("Y");
$userName = "zhilin";
echo $twig->render("home.twig",
				array("subjects"=>$subjects,
						"year"=>$currentYear,
						"login"=>loggedIn(),
						"userName" => $userName)
					);

?>
