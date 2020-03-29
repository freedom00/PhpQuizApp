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
    // MEEKRO QUERY
    return DB::query("SELECT * FROM final_project_subject");
}

/**
 * @return all students' info from database
 */
function getStudents()
{
    // MEEKRO QUERY
    return DB::query("SELECT * FROM final_project_student");
}

/**
 * @return all teachers' info from database
 */
function getTeachers()
{
    // MEEKRO QUERY
    return DB::query("SELECT * FROM final_project_teacher");
}


/**
<<<<<<< HEAD
 *@return questions' info from database
=======
 * @return all questions' info from database
>>>>>>> 3a398c4921dfbfd4107f4ef2f7fab46352661f92
 */
function getQuestions()
{
    // MEEKRO QUERY
<<<<<<< HEAD
    return DB::query("SELECT q.quId, s.subName, q.quName
    FROM final_project_question AS q, final_project_subject AS s WHERE s.subId = q.subId ");
}

=======
    return DB::query("SELECT * FROM final_project_question");
}

function getRowBy($sender)
{
    $key = array_keys($sender['row']);
    $query = $sender['query'] == "" ? "SELECT * FROM " . $sender['tableName'] . " where " . array_shift($key) . "='" . array_shift($sender['row']) . "'" : $sender['query'];
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
>>>>>>> 3a398c4921dfbfd4107f4ef2f7fab46352661f92
