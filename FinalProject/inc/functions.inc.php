<?php
//start session
session_start();

//include composers autoloader
require_once 'vendor/autoload.php';

// setup the location of our template files. They will be in the "templates" folder
$loader = new Twig_Loader_Filesystem('templates');
//-- setup the twig template environment.
$twig = new Twig_Environment($loader);


//MEEKRO - database variables
DB::$user = 'ipd19';
DB::$password = 'ipdipd';
DB::$dbName = 'ipd19';


// import the monolog library
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
// create a log channel
$log = new Logger("phoenix_quiz_logger");


$sender = array();
$sender['year'] = date("Y");
$sender['login'] = loggedIn();
$sender['subjects'] = getSubjects();

function getSubjects() {
    // MEEKRO QUERY
    return DB::query("SELECT * FROM final_project_subject");
}

/**
 * @param $sender
 */
function pushLog($sender) {
    global $log;
    $log->pushHandler(new StreamHandler($sender['log_file_name'], $sender['log_type']));
}

/**
 * @param $sender
 * @throws \Twig\Error\LoaderError
 * @throws \Twig\Error\RuntimeError
 * @throws \Twig\Error\SyntaxError
 */
function sendPage($sender) {
    global $twig;
    if (!empty($twig)) {
        echo $twig->render($sender['file_name'],$sender);
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

