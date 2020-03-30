<?php

// include our file of stuff we use often
require "inc/functions.inc.php";

if ( !loggedIn() ){
    header("Location: login.php");
    die();
}

$sender['file_name'] = "quiz.twig";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (!isset($_GET['subject']) || trim($_GET['subject']) == "") {
        $sender['errorMessage'] = "There is no such subject.";
        sendPage($sender);
        return;
    }

    if (isset($_SESSION['sender']) && count($_SESSION['sender']) != 0) {
        $sender = $_SESSION['sender'];
    } else {
        $sender['query'] = "SELECT q.quId, s.subName, q.quName FROM final_project_question AS q, final_project_subject AS s WHERE s.subId = q.subId AND s.subName = '" . $_GET['subject'] . "'";
        $sender['questions'] = getRows($sender);
        $sender['query'] = "";
        if (count($sender['questions']) < 1) {
            $sender['errorMessage'] = "There is no quiz for " . $_GET['subject'];
            sendPage($sender);
            return;
        }
        $sender['totalQuestions'] = count($sender['questions']);
        $sender['submittedQuestions'] = array();
        $sender['correctCount'] = 0;
        $sender['time'] = time();

    }
    if (isset($_GET['option'])) {
        $sender['submittedQuestions'][$_GET['page']] = true;
        $sender['tableName'] = ANSWER;
        $sender['column'] = array('ansId' => $_GET['option']);
        $result = getRowBy($sender);
        if ($result['quAnswer'] == 1) {
            $sender['correctCount'] += 1;
        }
        $_GET['page'] += 1;
    }

    if ($_GET['page'] < 1) {
        $sender['currentPage'] = $_GET['page'] + 1;
    } elseif ($_GET['page'] > count($sender['questions'])) {
        $sender['currentPage'] = $_GET['page'] - 1;
    } else {
        $sender['currentPage'] = $_GET['page'];
    }

    $quId = $sender['questions'][$sender['currentPage'] - 1]['quId'];
    $sender['query'] = "SELECT * FROM final_project_answer WHERE quId = '$quId'";
    $sender['options'] = getRows($sender);
    $sender['query'] = "";

    $sender['progressRate'] = count($sender['submittedQuestions']) / $sender['totalQuestions'] * 100;

    $_SESSION['sender'] = $sender;

    if ($sender['progressRate'] == 100) {
        header("Location: summary.php");
    }
}

sendPage($sender);