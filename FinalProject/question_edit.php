<?php

// include our file of stuff we use often
require "inc/functions.inc.php";

/*-- 
	Return the template page which is located in the templates folder
*/
$sender['file_name'] = "question_edit_form.twig";
sendPage($sender);
