<?php
// include our file of stuff we use often
use Monolog\Logger;

require "inc/functions.inc.php";
$sender['log_file_name'] = "logs/questions.log";
$sender['log_type'] = Logger::INFO;
pushLog($sender);

//if user is not logged in,he or she need to go back to login page; 
//or, if the user is not teacher he must go back to home page
if (!$_SESSION['isLoggedIn']) {
    header("Location: login.php");
    die();
} else if (!isTeacherLogin($_SESSION['name'])) {
    header("Location: index.php");
    die();
}
//if server request method is a get method
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    //check each method and then render to different templates
    if (isset($_GET['mode']) && $_GET['mode'] != "") {
        $sender['mode'] = $_GET['mode'];
    }
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $sender['questionId'] = $_GET['id'];
    }
    if (isset($_GET['subId']) && is_numeric($_GET['subId'])) {
        $sender['subId'] = $_GET['subId'];
    }
    //request for getting the questions' list show up
    if ($sender['mode'] == "list") {
        setDataToListpage();
    } else if ($sender['mode'] == "create") {//request for creating a new question
        $sender['messages'] = "";
        $sender['file_name'] = "question_create.twig";
    } else if ($sender['mode'] == "delete") {//request for deleting a question
        deleteQuestionById(($sender['questionId']));
        $sender['questions'] = getQuestions();
        $sender['file_name'] = "questions_list.twig";
    } else if ($sender['mode'] == "viewAndEdit") {//request for updating a question by question id
        setDataToEditpage($sender['questionId']);
    }
    //finally, render to new page
    sendPage($sender);
//if server request method is a post method
} else if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_GET['mode']) && $_GET['mode'] != "") {
        $sender['mode'] = $_GET['mode'];
    }
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $sender['questionId'] = $_GET['id'];
    }
    //validations for each field
    if (@isFieldEmpty($_POST['question'])) {
        $sender['errorMessage'] = $sender['errorMessage'] . "Question's field is required.";
    }
    if (@isFieldEmpty($_POST['subject'])) {
        $sender['errorMessage'] = $sender['errorMessage'] . "\nSubject field is required.";
    }
    if (@isFieldEmpty($_POST['type'])) {
        $sender['errorMessage'] = $sender['errorMessage'] . "\nType field is required.";
    }
    if (!isset($_POST['answerId'])) {
        $sender['errorMessage'] = $sender['errorMessage'] . "\nAn answer is required.";
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['html']) && $_POST['html'] !== "") {
            export($_POST['html']);
        }
    }
    //if no errors
    if ($sender['errorMessage'] == "" && $sender['mode'] == "create") {
        $vars_question = array(
            'subId' => $_POST['subject'],
            'quName' => $_POST['question'],
            'quType' => $_POST['type']
        );
        //firstly, insert into final_project_question table
        DB::insertUpdate("final_project_question", $vars_question);
        //get the newest data
        $quId = DB::insertId();
        //get four options to insert into insert into final_project_answer table
        for ($i = 1; $i <= 4; $i++) {
            //first insert the right answer
            $answerIds = $_POST['answerId'];
            if (in_array($i, $_POST['answerId'])) {
                $vars_option = array(
                    'quId' => $quId,
                    'quOption' => $_POST['option' . $i],
                    'quAnswer' => 1);
                DB::insertUpdate("final_project_answer", $vars_option);

                //then insert other answers
            } else {
                $vars_option = array(
                    'quId' => $quId,
                    'quOption' => $_POST['option' . $i],
                    'quAnswer' => 0);
                DB::insertUpdate("final_project_answer", $vars_option);
            }
        }
        //log
        $log->info("New question with ID #$quId has been created.");
        //if successfully, go back to list page
        setDataToListpage();

        // separate two pages, incase of errors// edit mode
    } else if ($sender['errorMessage'] == "" && $sender['mode'] == "viewAndEdit") {
        $quId = $_POST['quId'];
        $optionIds = getOptionsByQuestionId($_POST['quId']);
        $optionAccount = count($optionIds);
        $vars_question = array(
            'quId' => $_POST['quId'],//already exsit
            'subId' => $_POST['subject'],
            'quName' => $_POST['question'],
            'quType' => $_POST['type']
        );
        //firstly, update final_project_question table
        DB::insertUpdate("final_project_question", $vars_question);

        //our exist questions have 2-4 options to choose.
        for ($i = 1; $i <= $optionAccount; $i++) {
            if (!isFieldEmpty($_POST['option' . $i])) {
                //first upadate the right answer
                if (in_array($i, $_POST['answerId'])) {
                    $vars_option = array(
                        'ansId' => $optionIds[$i - 1]['ansId'],
                        'quId' => $quId,
                        'quOption' => $_POST['option' . $i],
                        'quAnswer' => 1);
                    DB::insertUpdate("final_project_answer", $vars_option);
                    //then update others
                } else {
                    $vars_option = array(
                        'ansId' => $optionIds[$i - 1]['ansId'],
                        'quId' => $quId,
                        'quOption' => $_POST['option' . $i],
                        'quAnswer' => 0);
                    DB::insertUpdate("final_project_answer", $vars_option);
                }
            }
            //log
            $log->info("One question with ID #$quId has been updated.");
            //go back to list page
            setDataToListpage();
        }
        //if has errors, stay in same page continue to create or edit
    } else if ($sender['errorMessage'] != "") {
        if ($sender['mode'] == "create")
            $sender['file_name'] = "question_create.twig";
        if ($sender['mode'] == "viewAndEdit") {
            setDataToEditpage($sender['questionId']);
        }
    }
    //finally, render to new page
    sendPage($sender);
}


