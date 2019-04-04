<?php
if (empty($_POST['page'])) { 
    $display_type = 'no-signin';  
    include ('index.php');
    exit();
}

// if(empty($_SESSION['username'])) {
//     $display_type = 'no-signin';  
//     include ('index.php');
//     exit();
// }

session_start();

require('model.php'); 

// When commands come from StartPag
if ($_POST['page'] == 'StartPage')
{
    switch($_POST['command']) { 
        case 'SignIn':
            if (!is_valid($_POST['username'], $_POST['password'])) {
                $error_msg_username = 'Incorrect Username or Incorrect Password';
                $error_msg_password = ''; // Set an error message into a variable.
                                                        // This variable will used in the form in 'view_startpage.php'.
                $display_type = 'signin';  // It will display the start page with the SignIn box.
                                           // This variable will be used in 'view_startpage.php'.
                include('index.php');
            } 
            else {
                $_SESSION['signedin'] = 'YES';
                $_SESSION['username'] = $_POST['username'];
                $username = $_POST['username'];
                $tookSurvey = user_took_survey($_SESSION['username']);
                include ('homepage.php');
            }
            exit();

        case 'Join': 
            if (user_exist($_POST['username'])) {
                $error_msg_username = 'User exists, please choose another username';
                $error_msg_password = '';
                $display_type = 'join';
                include('index.php');
            } else {
                if (insert_new_user($_POST['username'], $_POST['password'], $_POST['email'])) {
                    $error_msg_username = '';
                    $error_msg_password = '';
                    $display_type = 'signin';
                    $_SESSION['username'] = $_POST['username'];
                    $username = $_POST['username'];
                    $tookSurvey = user_took_survey($_SESSION['username']);
                    include('homepage.php');
                } else {
                    $error_msg_username = 'Error!';
                    $error_msg_password = '';
                    $display_type = 'join';
                    include('index.php');
                }
            }
            exit();
    }
}

// When commands come from 'MainPage'
else if ($_POST['page'] == 'MainPage') 
{   
    switch($_POST['command']) {
        case 'SignOut':
            session_unset();
            session_destroy();
            $display_type = 'no-signin';
            include('index.php');
        break;

        case 'Survey':
            userSessionEmpty($_SESSION['username']); 

            if ($_SESSION['username'] == 'admin')
            {
                $display_type = 'editsurvey'; 
                include('editsurvey.php');
            } else 
            {
                $display_type = 'takesurvey';   
                // $surveryquestions = survey(); 
     
                // exit;                           
                include('survey.php');
            }
        break;

        case 'ShowData':
            userSessionEmpty($_SESSION['username']); 
            $international = internationalStudents();
            $parkingAlways = parkingAlwaysEveryone();
            $voteYes = voteStudent();
            $sleepYes = sleepYesEveryone();
            $tookSurvey = user_took_survey($_SESSION['username']);
            include('homepage.php');
           break;

        case 'Unsubscribe':
            if(unsubscribed($_SESSION['username'])) {
                session_unset();
                session_destroy();
                $display_type = 'no-signin';
                include('index.php');
            }
            break;

        default:
            echo 'Unclear of what you want: ' . $command . '<br>';
    }
}

else if ($_POST['page'] == 'EditSurvey')
{
    switch($_POST['command']) {
        case 'CreateQuestion':
            userSessionEmpty($_SESSION['username']); 
            if(isset($_POST['question'])){
            $result = create_question(
                $_POST['question'], 
                $_POST['answer1'], 
                $_POST['answer2'], 
                $_POST['answer3'], 
                $_POST['answer4'], 
                $_SESSION['username']
            ); 
        }else {
                $display_type = 'editsurvey'; 
                include('editsurvey.php');
        }
            break;

        case 'ListQuestions':
            userSessionEmpty($_SESSION['username']); 
            $result = list_survey_questions();
            break;

        case 'DeleteQuestion':
            userSessionEmpty($_SESSION['username']); 
            $result = delete_question($_POST['question']);
            break;

        case 'Home':
            userSessionEmpty($_SESSION['username']); 
            $tookSurvey = user_took_survey($_SESSION['username']);
            include('homepage.php');
            break;

        case 'SignOut':
            session_unset();
            session_destroy();
            $display_type = 'no-signin';
            include('index.php');
        break;
            
        default:
            echo 'Editing didn\'t work: ' .$_POST['command'] . '<br>';
    }
}
else if ($_POST['page'] == 'TakeSurvey') 
{

    switch($_POST['command']) {
        case 'ShowSurvey':
            userSessionEmpty($_SESSION['username']); 
            $result = survey();
  
            break;

        case 'SubmitSurvey':
            userSessionEmpty($_SESSION['username']); 
            unset($_POST['page']);
            unset($_POST['command']);

            $result = submitSurvey($_POST, $_SESSION['username']);
            $tookSurvey = user_took_survey($_SESSION['username']);
            include('homepage.php');
            break;

        case 'SignOut':
            session_unset();
            session_destroy();
            $display_type = 'no-signin';
            include('index.php');
        break;

        case 'Home':
            userSessionEmpty($_SESSION['username']); 
            $tookSurvey = user_took_survey($_SESSION['username']);
            include('homepage.php');

        default:
            echo 'Survey didn\'t work: ' .$_POST['command'] . '<br>';        
    }

}

function userSessionEmpty($u) {
    if(empty($u)) {
        $display_type = 'no-signin';  
        include ('index.php');
        exit();
     }
}
?>   
