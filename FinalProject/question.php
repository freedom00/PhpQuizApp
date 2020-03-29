<?php
// include our file of stuff we use often
require "inc/functions.inc.php";
/*
if ( !$_SESSION['isLoggedIn'] ){
	header("Location: login.php");
	die();
}else if(!isTeacher($_SESSION['name'])){
	header("Location: index.php");
	die();
}*/
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
		$sender['errorMessage'] = "All field are required.";
	}

	if($sender['errorMessage'] == ""){
		$vars_question = array( 
		'subId' => getSubIdBySubName($_POST['subject']), 
		'quName' => $_POST['question'],  
		'quType' => $_POST['type']//we can also have a table for types   		
	  	);
	
		if (isset($_GET['id']) && is_numeric($_GET['id'])){
			$vars_question['quId'] = $_GET['id'];
			$quId = $_GET['id'];}

		DB::insertUpdate("final_project_question", $vars_question);
	
		$quId = DB::insertId();
		
		for ($i = 1; $i <=3; $i++) {
		if(!isFieldEmpty($_POST['option'.$i])){
			$vars_option = array(  
				'quId'=>$quId,
				'quOption' => $_POST['option'.$i],  
				'quAnswer' => 0 );
			DB::insertUpdate("final_project_answer", $vars_option);
			}
		}
		$vars_option = array(  
            'quId'=>$quId,
            'quOption' => $_POST['answer'],  
            'quAnswer' => 1 
                );
		DB::insertUpdate("final_project_answer", $vars_option);
	}
	
    //updated so different redirection
	//$action = isset($vars['id']) ? "updated" : "created";
    //header("Location: books.php?message=$action&title=". htmlentities($title));
		$sender['file_name'] = "questions_list.twig";
		$sender['questions'] = getQuestions();
		sendPage($sender);
		die();
	}


