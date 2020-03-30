<?php
define('TEACHER', 'final_project_teacher');
define('STUDENT', 'final_project_student');
define('SUBJECT', 'final_project_subject');
define('ANSWER', 'final_project_answer');
define('QUESTION', 'final_project_question');
define('RESULT', 'final_project_result');

//start session
session_start();

//include composers autoloader
require_once 'vendor/autoload.php';

// setup the location of our template files. They will be in the "templates" folder
$loader = new \Twig\Loader\FilesystemLoader('templates');
//-- setup the twig template environment.
$twig = new \Twig\Environment($loader);


//MEEKRO - database variables
DB::$user = 'ipd19';
DB::$password = 'ipdipd';
DB::$dbName = 'ipd19';


// import the monolog library
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger("phoenix_quiz_logger");

//add a global value to the footer
$twig->addGlobal("year", date("Y"));

$sender = array();
//$sender['year'] = date("Y");
$sender['login'] = loggedIn();
$sender['subjects'] = getSubjects();
$sender['errorMessage'] = "";
$sender['query'] = "";

/**
 * @param $sender
 */
function pushLog($sender)
{
    global $log;
    $log->pushHandler(new StreamHandler($sender['log_file_name'], $sender['log_type']));
}

/**
 * @param $sender
 * @throws \Twig\Error\LoaderError
 * @throws \Twig\Error\RuntimeError
 * @throws \Twig\Error\SyntaxError
 */
function sendPage($sender)
{
    global $twig;
    if (!empty($twig)) {
        echo $twig->render($sender['file_name'], $sender);
    }
}

/**
 * Pretty printout of given variable
 *
 * @param [*] $data
 */
function pr($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}


/**
 * Validate if a given variable is empty
 *
 * @param [string] $field
 * @return boolean
 */
function isFieldEmpty($field)
{
    return (!isset($field) || trim($field) == "");
}

/**
 * Verify if user is logged in using session variables.
 *
 * @return Boolean
 */
function loggedIn()
{
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
        if (!isset($_SESSION['name'])) {
            $_SESSION['name'] = "Random Person";
        }
        return true;
    } else {
        return false;
    }
}

/**
 * @return all subjects' info from database
 */
function getSubjects()
{
    return DB::query("SELECT * FROM final_project_subject");
}

/**
 * @return all students' info from database
 */
function getStudents()
{
    return DB::query("SELECT * FROM final_project_student");
}

/**
 * @return all teachers' info from database
 */
function getTeachers()
{
    return DB::query("SELECT * FROM final_project_teacher");
}


/**
 * @return all questions' info from database
 */
function getQuestions()
{
    return DB::query("SELECT * FROM final_project_question");
}

function getRowBy($sender)
{
    $key = array_keys($sender['column']);
    $query = $sender['query'] == "" ? "SELECT * FROM " . $sender['tableName'] . " where " . array_shift($key) . "='" . array_shift($sender['column']) . "'" : $sender['query'];
    $result = DB::queryFirstRow($query);
    $result['count'] = DB::count();
    return $result;
}

/**
 * @param $sender
 * @return mixed
 */
function getRows($sender)
{
    return DB::query($sender['query'] == "" ? "SELECT * FROM " . $sender['tableName'] : $sender['query']);
}

/**
 * @param $sender
 */
function insertUpdate($sender)
{
    DB::insertUpdate($sender['tableName'], $sender['row']);
}

function secToTime($times)
{
    $result = '00:00:00';
    if ($times > 0) {
        $hour = floor($times / 3600);
        $minute = floor(($times - 3600 * $hour) / 60);
        $second = floor((($times - 3600 * $hour) - 60 * $minute) % 60);
        $result = sprintf("%02d:%02d:%02d", $hour, $minute, $second);
    }
    return $result;
}


/****************************functions zhilin inc***************************** */
$errorMessage = "";
/**
 * @return questions' info from database
 */
function getQuestionById($id)
{
    return DB::queryFirstRow("SELECT q.quId, s.subName, q.quName,s.subPicPath
    FROM final_project_question AS q, final_project_subject AS s WHERE s.subId = q.subId AND q.quId = $id");
}

/***
 *
 */
function getOptionsByQuestionId($id)
{
    return DB::query("SELECT *  FROM final_project_answer WHERE quId = $id");
}

/***
 *
 *
 */
function getAnswerByQuestionId($id)
{
    return DB::queryFirstRow("SELECT * FROM final_project_answer WHERE quId = $id AND quAnswer = '1'");
}

/***
 *
 *
 */
function getSubIdBySubName($subName)
{
    return DB::queryFirstRow("SELECT * FROM final_project_subject WHERE subName = '$subName'")['subId'];
}

/***
 *
 *
 */
function deleteQuestionById($id)
{
    return DB::queryFirstRow("DELETE FROM final_project_question WHERE quId = $id");
}

/***
 *
 *
 */
function isTeacher($name)
{
    $teachers = getTeachers();
    foreach ($teacher as $teachers) {
        if ($teacher . tchName == $name)
            return true;
    }
}
/**functions zhilin inc****** */
