<?php
// include our file of stuff we use often
require "inc/functions.inc.php";
$sender['log_file_name'] = "logs/users.log";
$sender['teachers'] = getTeachers();
$sender['students'] = getStudents();
$sender['file_name'] = "users_list.twig";
sendPage($sender);