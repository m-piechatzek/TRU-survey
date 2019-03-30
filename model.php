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
        $sql = "insert into Users values (NULL, '$username', '$password', '$email', $current_date)";
        $result = mysqli_query($conn, $sql);
        return $result;
    }
}

function is_valid($username, $password) 
{
    global $conn;
    
    $sql = "select * from Users where (Username = '$username' and Password = '$password')";
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
    echo json_encode($data);
}
?>   