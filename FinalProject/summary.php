<?php

// include our file of stuff we use often
require "inc/functions.inc.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $sender['query'] = "SELECT stu.stuName, sub.subName, res.tmConsume, res.quCount, res.score FROM final_project_student AS stu, final_project_subject AS sub, final_project_result AS res WHERE stu.stuId = res.stuId AND sub.subId = res.subId  AND stu.stuName = '" . $_SESSION['name'] . "'";
    $sender['questions'] = getRows($sender);
    $sender['query'] = "";
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['html']) && $_POST['html'] !== "") {
        export($_POST['html']);
    }
}

$sender['file_name'] = "summary.twig";

/*-- 
	Return the template page which is located in the templates folder
*/

sendPage($sender);