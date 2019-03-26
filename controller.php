<?php
if (empty($_POST['page'])) { 
    $display_type = 'no-signin';  
    include ('index.php');
    exit();
}

session_start();

require('model.php'); 

// When commands come from StartPage
if ($_POST['page'] == 'StartPage')
{
    switch($_POST['command']) { 
        case 'SignIn':
            if (!is_valid($_POST['username'], $_POST['password'])) {
                $error_msg_username = 'Incorrect Username or';
                $error_msg_password = 'Incorrect Password'; // Set an error message into a variable.
                                                        // This variable will used in the form in 'view_startpage.php'.
                $display_type = 'signin';  // It will display the start page with the SignIn box.
                                           // This variable will be used in 'view_startpage.php'.
                include('index.php');
            } 
            else {
                $_SESSION['signedin'] = 'YES';
                $_SESSION['username'] = $_POST['username'];
                $username = $_POST['username'];
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
            if ($_SESSION['username'] == 'admin')
            {
                $display_type = 'editsurvey';  
                include('editsurvey.php');
            } else 
            {
                $display_type = 'takesurvey';                               
                include('survey.php');
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
            $result = post_question($_POST['question'], $_SESSION['username']); // in model.php
            break;
            
        default:
            echo 'Editing didn\'t work: ' .$command . '<br>';
    }
}

?>   
