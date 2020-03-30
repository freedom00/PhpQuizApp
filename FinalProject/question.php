<?php
// include our file of stuff we use often
require "inc/functions.inc.php";
use Monolog\Logger;
/*
if ( !$_SESSION['isLoggedIn'] ){
	header("Location: login.php");
	die();
}else if(!isTeacherLogin($_SESSION['name'])){
	header("Location: index.php");
	die();
}*/
$sender['log_file_name'] = "logs/questions.log";
$sender['log_type'] = Logger::INFO;
pushLog($sender);

if($_SERVER['REQUEST_METHOD']=="GET"){
	$sender['mode'] = $_GET['mode'];	
	if(isset($_GET['mode'])&&$_GET['mode']=="list"){
		$sender['questions'] = getQuestions();
		if(isset($_GET['subId'])&&is_numeric($_GET['subId'])){
			$sender['questions']=getQuestionsBySubId($_GET['subId']);	
		}
		$sender['file_name'] = "questions_list.twig";
		sendPage($sender);
		die();
	}else if (isset($_GET['mode'])&&$_GET['mode']=="create"){
		$sender['file_name'] = "question_create.twig";
		sendPage($sender);

	}else if(isset($_GET['id'])&&is_numeric($_GET['id'])){			
		if(isset($_GET['mode'])&&$_GET['mode']=="delete"){
			deleteQuestionById(($_GET['id']));
			$sender['questions'] = getQuestions();
			$sender['file_name'] = "questions_list.twig";
			sendPage($sender);
			die();
		}else if(isset($_GET['mode'])&&$_GET['mode']=="viewAndEdit"){
			$sender['answer_editing'] = getAnswerByQuestionId(($_GET['id']));	
			$sender['question_editing']= getQuestionById(($_GET['id']));
			$sender['options_editing'] = getOptionsByQuestionId(($_GET['id']));	
			$sender['file_name'] = "question_viewAndEdit.twig";
			sendPage($sender);	
		}		
	}	
	
}else if($_SERVER['REQUEST_METHOD']=="POST"){
	if (isFieldEmpty($_POST['question']) || isFieldEmpty($_POST['type']) || 
	isFieldEmpty($_POST['subject'])){
		$sender['errorMessage'] = "These fields are required.";
	}	
	if($sender['errorMessage'] == ""){

		if(isset($_GET['mode'])&&$_GET['mode'] == "create"){
			$vars_question = array( 
				'subId' => $_POST['subject'], 
				'quName' => $_POST['question'],  
				'quType' => $_POST['type'] 		
				);		
				  
			DB::insertUpdate("final_project_question", $vars_question);	
			
			$quId = DB::insertId();
			
			for ($i = 1; $i <=4; $i++) {
				$answerIds = $_POST['answerId'];
												
				if(isset($_POST['answerId'])){
					if(in_array($i,$_POST['answerId'])){
						$vars_option = array(  				
							'quId'=>$quId,
							'quOption' => $_POST['option'.$i],  
							'quAnswer' => 1 );
					DB::insertUpdate("final_project_answer", $vars_option);
					}else{
						$vars_option = array(  				
							'quId'=>$quId,
							'quOption' => $_POST['option'.$i],  
							'quAnswer' => 0 );
						DB::insertUpdate("final_project_answer", $vars_option);	
					}
				}
			}
			$log->info("New question with ID #$quId has been created.");
		}else if(isset($_GET['mode'])&&$_GET['mode'] == "viewAndEdit"){
			$quId =$_POST['quId'];
			$optionIds = getOptionsByQuestionId($_POST['quId']);
			$optionAccount =count($optionIds);
			$vars_question = array( 
			'quId'=> $_POST['quId'],
			'subId' => $_POST['subject'], 
			'quName' => $_POST['question'],  
			'quType' => $_POST['type'] 		
			);

			DB::insertUpdate("final_project_question", $vars_question);	

			for ($i = 1; $i <=$optionAccount; $i++) {
				if(!isFieldEmpty($_POST['option'.$i])){													
					
					if(in_array($i,$_POST['answerId'])){
						$vars_option = array( 
							'ansId'=> $optionIds[$i-1]['ansId'],				
							'quId'=>$quId,
							'quOption' => $_POST['option'.$i],  
							'quAnswer' => 1 );
						DB::insertUpdate("final_project_answer", $vars_option);
					}else{
						$vars_option = array( 
							'ansId'=> $optionIds[$i-1]['ansId'], 				
							'quId'=>$quId,
							'quOption' => $_POST['option'.$i],  
							'quAnswer' => 0 );
						DB::insertUpdate("final_project_answer", $vars_option);	
					}								
				}				
			}
			$log->info("One question with ID #$quId has been updated.");			
		}
	}
	$sender['file_name'] = "questions_list.twig";
	$sender['questions'] = getQuestions();
	sendPage($sender);
	die();
}


