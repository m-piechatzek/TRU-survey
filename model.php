<?php
// connect to MySQL DB
$conn = mysqli_connect('localhost', 'mpiechatzek','mpiechatzek', 'C354_mpiechatzek');

function insert_new_user($username, $password, $email)
{
    global $conn;
    
    if (user_exist($username))
        return false;
    else {
        $current_date = date('Ymd');
        $hashed_pass = hash('SHA256', $password);
        $sql = "insert into Users values (NULL, '$username', '$hashed_pass', '$email', $current_date)";
        $result = mysqli_query($conn, $sql);
        return $result;
    }
}

function is_valid($username, $password) 
{
    global $conn;
    
    $hashed_pass = hash('SHA256', $password);
    $sql = "select * from Users where (Username = '$username' and Password = '$hashed_pass')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function user_exist($username) 
{
    global $conn;
    
    $sql = "select * from Users where (Username = '$username')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

//Remove user from the database
function unsubscribed($u) {

    global $conn;

    $sql = "SELECT `userID` FROM `Users` WHERE username = '$u'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $uid = $row['userID'];  // The column that include user ids

        $sql2 = "DELETE FROM `Users` WHERE userID = '$uid'";
        $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                $sql3 = "DELETE FROM `UserAnswers` WHERE userID ='$uid";
                $result3 = mysqli_query($conn, $sql3);

                return true;
            }
            else {
                return false;
            }
    } else {
        return false;
    }
}

/*
*   Queries
*/

function create_question($q, $a1, $a2, $a3, $a4, $u)  // question, username
{
    global $conn;
    
    $sql = "select * from Users where (Username = '$u')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $uid = $row['userID'];  // The column that include user ids
    }
    else {
        echo "Posting a question failed!";
        return;
    }
   // echo '<script>console.log("in model create_question")</script>';
    
    // insert statement
    // "INSERT INTO Persons (FirstName,LastName,Age) VALUES ('Glenn','Quagmire',33)"
    $sql = "INSERT INTO SurveyQuestions (survey_questions_id, question, answer1, answer2, answer3, answer4, survey_id) values  (NULL, '$q', '$a1', '$a2', '$a3', '$a4', 1)";
    $result = mysqli_query($conn, $sql);
    return true;
}

function list_survey_questions()
{
    global $conn;
    
    $sql = "select question AS 'Question', 
    answer1 AS 'Answer 1',
    answer2 AS 'Answer 2',
    answer3 AS 'Answer 3',
    answer4 AS 'Answer 4' 
     from SurveyQuestions";
    $result = mysqli_query($conn, $sql);
    $data = array();
    $i = 0;
    while($row = mysqli_fetch_assoc($result))
        $data[$i++] = $row;
    echo json_encode($data);
}

function delete_question($q) {
   
    global $conn;

    $sql = "DELETE FROM SurveyQuestions WHERE question = '$q'";
    $result = mysqli_query($conn, $sql);
    return true;
}

function survey() {
    
    global $conn;

    $sql = "SELECT * FROM SurveyQuestions";  
    
    $result = mysqli_query($conn, $sql);
    $data = array();
    $i = 0;
    while($row = mysqli_fetch_assoc($result))
        $data[$i++] = $row;
    // print_r($data);
    // return $data;
    echo json_encode($data);

}

function submitSurvey($survey, $u) {

    global $conn;
    
    $sql = "select * from Users where (Username = '$u')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $uid = $row['userID'];  // The column that include user ids
    }
    else {
        echo "Posting a survey failed!";
        return;
    }
    foreach ($survey as $key => $value) {

        $sql = "INSERT INTO UserAnswers (user_answers_id, survey_id, survey_questions_id, answer, userID) VALUES 
        (null, 1, '$key', '$value', '$uid')";
        $result = mysqli_query($conn, $sql);

    }

    return true;
}

//Check if user already took survey
function user_took_survey($u) {
    global $conn;

    $sql = "SELECT * FROM UserAnswers ua, Users u WHERE ua.userID = u.userID AND u.username = '$u'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    else {
        return false;
    }
}


// DATA ANALYSIS 
function internationalStudents() {
    global $conn;

    //Number of students who find it welcoming
    $sql = "SELECT COUNT(answer) AS COUNT FROM `UserAnswers` WHERE answer = 'Very welcome' AND userID IN ( SELECT userID FROM UserAnswers where survey_questions_id = 42 AND answer = 'Student')";
    $result = mysqli_query($conn, $sql);
    $data = array();
    $i = 0;
        while($row = mysqli_fetch_assoc($result))
        $data[$i++] = $row;
    
    //Number of users who find it welcoming
    $sql2 = "SELECT count(answer) AS COUNT FROM `UserAnswers` WHERE survey_questions_id = 44";
    $result2 = mysqli_query($conn, $sql2);
    $data2 = array();
    $i2 = 0;
        while($row2 = mysqli_fetch_assoc($result2))
        $data2[$i2++] = $row2;
    $percent = round(((float) $data[0]['COUNT']/ (float) $data2[0]['COUNT']) * 100.00);
     return json_encode($percent);
}

function parkingAlwaysEveryone() {
    global $conn;
    //Number of people who find parking always
    $sql = "SELECT count(answer) AS COUNT FROM `UserAnswers` WHERE survey_questions_id = 45 AND answer = 'Always'";
    $result = mysqli_query($conn, $sql);
    $data = array();
    $i = 0;
        while($row = mysqli_fetch_assoc($result))
        $data[$i++] = $row;

    //Number of people who answered the parking question
    $sql2 = "SELECT count(answer) AS COUNT FROM `UserAnswers` WHERE survey_questions_id = 45";
    $result2 = mysqli_query($conn, $sql2);
    $data2 = array();
    $i2 = 0;
        while($row2 = mysqli_fetch_assoc($result2))
        $data2[$i2++] = $row2;
    $percent = round(((float) $data[0]['COUNT']/ (float) $data2[0]['COUNT']) * 100.00);
    return json_encode($percent);
}

function voteStudent() {
    global $conn;
    //Number of people who voted yes
    $sql = "SELECT count(answer) AS COUNT FROM `UserAnswers` WHERE survey_questions_id = 46 AND answer = 'Yes'";
    $result = mysqli_query($conn, $sql);
    $data = array();
    $i = 0;
        while($row = mysqli_fetch_assoc($result))
        $data[$i++] = $row;

    //Number of people who answered the vote question
    $sql2 = "SELECT count(answer) AS COUNT FROM `UserAnswers` WHERE survey_questions_id = 46";
    $result2 = mysqli_query($conn, $sql2);
    $data2 = array();
    $i2 = 0;
        while($row2 = mysqli_fetch_assoc($result2))
        $data2[$i2++] = $row2;
    $percent = round(((float) $data[0]['COUNT']/ (float) $data2[0]['COUNT']) * 100.00);
    return json_encode($percent); 
}

function sleepYesEveryone() {
    global $conn;
    //Number of people who answered yes to sleeping facilities
    $sql = "SELECT COUNT(answer) AS COUNT FROM `UserAnswers` WHERE answer = 'Yes' and survey_questions_id = 47";
    $result = mysqli_query($conn, $sql);
    $data = array();
    $i = 0;
        while($row = mysqli_fetch_assoc($result))
        $data[$i++] = $row;

    //Number of people who answered the sleep question
    $sql2 = "SELECT count(answer) AS COUNT FROM `UserAnswers` WHERE survey_questions_id = 47";
    $result2 = mysqli_query($conn, $sql2);
    $data2 = array();
    $i2 = 0;
        while($row2 = mysqli_fetch_assoc($result2))
        $data2[$i2++] = $row2;
    $percent = round(((float) $data[0]['COUNT']/ (float) $data2[0]['COUNT']) * 100.00);
    return json_encode($percent); 
}
?>   