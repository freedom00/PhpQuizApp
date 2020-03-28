<?php

// include our file of stuff we use often
require "inc/functions.inc.php";

$sender['questions'] = getQuestions();
$sender['file_name'] = "questions.twig";
sendPage($sender);