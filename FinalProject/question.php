<?php
// include our file of stuff we use often
use Monolog\Logger;

require "inc/functions.inc.php";

$sender['log_file_name'] = "logs/questions.log";
$sender['log_type'] = Logger::INFO;
pushLog($sender);

//if user is not logged in,he or she need to go back to login page; 
//or, if the user is not teacher he must go back to home page
if ( !$_SESSION['isLoggedIn'] ){
	header("Location: login.php");
	die();
}else if(!isTeacherLogin($_SESSION['name'])){
	header("Location: index.php");
	die();
}
//if server request method is a get method
if($_SERVER['REQUEST_METHOD']=="GET"){
	//check each method and then render to different templates 
	if(isset($_GET['mode'])&&$_GET['mode']!=""){
		$sender['mode'] = $_GET['mode'];
	}
	if(isset($_GET['id'])&&is_numeric($_GET['id'])){
		$sender['questionId'] = $_GET['id'];
	}
	if(isset($_GET['subId'])&&is_numeric($_GET['subId'])){
		$sender['subId'] = $_GET['subId'];
	}
	//request for getting the questions' list show up	
	if($sender['mode']=="list"){
		$sender['questions'] = getQuestions();
		//this is condition for the sort button, allow user to sort questions by subjects
		if($sender['subId'] ){
			$sender['questions']=getQuestionsBySubId($_GET['subId']);	
		}
		$sender['file_name'] = "questions_list.twig";		
	}else if ($sender['mode']=="create"){//request for creating a new question
		$sender['file_name'] = "question_create.twig";
	}else if($sender['mode']=="delete"){//request for deleting a question	
		deleteQuestionById(($sender['questionId']));
		$sender['questions'] = getQuestions();
		$sender['file_name'] = "questions_list.twig";
	}else if($sender['mode']=="viewAndEdit"){//request for updating a question by question id
		$sender['answer_editing'] = getAnswerByQuestionId(($sender['questionId']));	
		$sender['question_editing']= getQuestionById(($sender['questionId']));
		$sender['options_editing'] = getOptionsByQuestionId($sender['questionId']);	
		$sender['file_name'] = "question_viewAndEdit.twig";						
	}	
	sendPage($sender);	
//if server request method is a post method
}else if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_GET['mode'])&&$_GET['mode']!=""){
		$sender['mode'] = $_GET['mode'];
	}
	//validations for each field
	if (isFieldEmpty($_POST['question'])){
		$sender['errorMessage'] = "Question's field is not allowed empty";
	} 
	if (isFieldEmpty($_POST['subject'])){
		$sender['errorMessage'] = "Subject field is required.";
	}
	if (isFieldEmpty($_POST['type'])){
		$sender['errorMessage'] = "Type field is required.";
	}
	
	if($sender['errorMessage'] != ""){
		if($sender['mode']== "create")
			$sender['file_name'] = "question_create.twig";
		sendPage($sender);
			
	
	}else if($sender['errorMessage'] == ""&&$sender['mode']== "create"){
		$vars_question = array( 
			'subId' => $_POST['subject'], 
			'quName' => $_POST['question'],  
			'quType' => $_POST['type'] 		
			);		
				
		DB::insertUpdate("final_project_question", $vars_question);	
		
		$quId = DB::insertId();
		
		for ($i = 1; $i <=4; $i++) {
			$answerIds = $_POST['answerId'];
			if(!isset($_POST['answerId'])){	
				$sender['errorMessage'] = "Please choose at least one answer";								
			}else{
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
		
		}$log->info("New question with ID #$quId has been created.");
		
	}else if($sender['errorMessage'] == ""&&$sender['mode'] == "viewAndEdit"){
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
		
		$log->info("One question with ID #$quId has been updated.");			
	}
		
	}	
	header("Location:question.php?mode=list");
	die();
}


