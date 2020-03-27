<?php

// include our file of stuff we use often
require "inc/functions.inc.php";

/*-- 
	Return the template page which is located in the templates folder
*/
$year = date("Y");
echo $twig->render("question_edit_form.twig",compact("year"));

?>