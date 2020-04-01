<?php

// include our file of stuff we use often
require "inc/functions.inc.php";


$sender = $_SESSION['sender'];
$sender['name'] = $_SESSION['name'];
$sender['time'] = secToTime(time() - $sender['time']);

$sender['file_name'] = "summary.twig";

/*-- 
	Return the template page which is located in the templates folder
*/

sendPage($sender);