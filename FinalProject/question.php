<?php

// include our file of stuff we use often
require "inc/functions.inc.php";
/**functions to move to inc****** */
/**
 *@return questions' info from database
 */
function getQuestionById($id) {
    // MEEKRO QUERY
    return DB::queryFirstRow("SELECT q.quId, s.subName, q.quName
    FROM final_project_question AS q, final_project_subject AS s WHERE s.subId = q.subId AND q.quId = $id");
}
/***
 * 
 */
function getOptionsByQuestionId($id) {
    // MEEKRO QUERY
    return DB::query("SELECT *  FROM final_project_answer WHERE quId = $id");
}
/***
 * 
 * 
 */
function getAnswerByQuestionId($id) {
    // MEEKRO QUERY
    return DB::queryFirstRow("SELECT * FROM final_project_answer WHERE quId = $id AND quAnswer = '1'");
}
/***
 * 
 * 
 */
function getSubIdBySubName($subName) {
    // MEEKRO QUERY
    return DB::queryFirstRow("SELECT * FROM final_project_subject WHERE subName = '$subName'")['subId'];
}

function deleteQuestionById($id) {
    // MEEKRO QUERY
    return DB::queryFirstRow("DELETE FROM final_project_question WHERE quId = $id");
}


/**functions to move to inc****** */
$errorMessage = "";

if($_SERVER['REQUEST_METHOD']=="GET"){
	
	if(isset($_GET['id'])&&is_numeric($_GET['id'])){
		$sender['question_editing']= getQuestionById(($_GET['id']));
		$sender['options_editing'] = getOptionsByQuestionId(($_GET['id']));
		$sender['answer_editing'] = getAnswerByQuestionId(($_GET['id']));		
		$sender['mode'] = $_GET['mode'];
		
		if($_GET['mode']=="list"){
			$sender['questions'] = getQuestions();
			$sender['file_name'] = "questions_list.twig";
			sendPage($sender);
			die();
		}else if($_GET['mode']=="delete"){
			deleteQuestionById(($_GET['id']));
			$sender['questions'] = getQuestions();
			$sender['file_name'] = "questions_list.twig";
			sendPage($sender);
			die();
		}else if($_GET['mode']=="view"){
			$sender['file_name'] = "question_view.twig";
			sendPage($sender);
		}else if ($_GET['mode']=="edit"){
			$sender['file_name'] = "question_edit.twig";
			sendPage($sender);
		}else if ($_GET['mode']=="create"){
			
			$sender['file_name'] = "question_create.twig";
			sendPage($sender);
		}	
	}	
}else if($_SERVER['REQUEST_METHOD']=="POST"){
	if (isFieldEmpty($_POST['question']) || isFieldEmpty($_POST['type']) || 
	isFieldEmpty($_POST['subject']) ||isFieldEmpty($_POST['answer'])){
      $errorMessage = "All fields are required";
	}

	if($errorMessage == ""){
		$vars_question = array( 
		'subId' => getSubIdBySubName($_POST['subject']), 
		'quName' => $_POST['question'],  
		'quType' => $_POST['type']//we can also have a table for types   
		
	  	);
	
		if (isset($_POST['id']) && is_numeric($_POST['id']))
			$vars_question['quId'] = $_POST['id'];
		  var_dump($_POST['question']);
		DB::insertUpdate("final_project_question", $vars_question);
		$newId = DB::insertId();
		$vars_option1 = array(  
			'quId'=>$newId,
			'quOption' => $_POST['option1'],  
			'quAnswer' => 0  
			  );
		$vars_option2 = array(  
			'quId'=>$newId,
			'quOption' => $_POST['option2'],  
			'quAnswer' => 0  
				);
		$vars_option3 = array(  
			'quId'=>$newId,
			'quOption' => $_POST['option3'],  
			'quAnswer' => 0  
				);
		$vars_option4 = array(  
			'quId'=>$newId,
			'quOption' => $_POST['answer'],  
			'quAnswer' => 1 
				);
		DB::insertUpdate("final_project_answer", $vars_option1);
		DB::insertUpdate("final_project_answer", $vars_option2);
		DB::insertUpdate("final_project_answer", $vars_option3);
		DB::insertUpdate("final_project_answer", $vars_option4);

    //updated so different redirection
	//$action = isset($vars['id']) ? "updated" : "created";
    //header("Location: books.php?message=$action&title=". htmlentities($title));
		$sender['file_name'] = "questions_list.twig";
		$sender['questions'] = getQuestions();
		sendPage($sender);
		die();
	}
}

