<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<img src="logo.png" class="mx-auto d-block" alt="Responsive image">
<div class="container">
	<div class="row">
      <div class="col-md-12 text-center">
			
        <h1>TRU Survey</h1> 
        
      </div>
    </div>
    <div class="row">
          <div class="col-md-3">
          <form action="controller.php" method="post">
            <input type='hidden' name='page' value='TakeSurvey'></input>
            <button class="btn btn-secondary btn-sm" type="submit" name='command' value='SignOut'>Sign Out</button>
          </form>
          <form action="controller.php" method="post">
            <input type='hidden' name='page' value='TakeSurvey'></input>
            <button class="btn btn-secondary btn-sm" type="submit" name='command' value='Home'>Home</button>
          </form>
    </div>
    <div class="col-md-6">
			<div class="list-survey"></div>
		</div>
        <div class="col-md-3">
      <!-- <div class="list-survey"></div> -->
      <div style="display: none;" class="submit-survey-success"></div>
    </div>
	</div>
</div>
<script>
        var questions = '';
        var finalQuestions = [];
  $(document).ready(function() {
        var url = 'controller.php'; 
        console.log("inside document ready");
        var query = { page: "TakeSurvey", command: "ShowSurvey"}; 

          $.post( url,
              query,
              function(data) {
                 questions = JSON.parse(data);
                 var form = '<br><form id="submit-form-id" class="justify-content-center" action="controller.php" method="post">'
                    form += '<input type="hidden" name="page" value="TakeSurvey">';
                    form += '<input type="hidden" name="command" value="SubmitSurvey">';
                    // form += '<input type="hidden" name="finalQuestionsSubmit[]" value="' + finalQuestionsFun() + '">';
                    for(var i =0; i< questions.length; i++){
                 
                      form+= '<div class="p-5 mb-3 rounded bg-light">';
                        // form += '<div class="form-group">';
                        form += '<label class="lead form-group">' + questions[i].question + '</label>';
                        // form += '</div>';
                        // form += '<br>';      
                        form+= '<div class="form-check form-group">';
                          form += '<input class="form-check-input" type="radio" name="' + questions[i].survey_questions_id + '" value="' + questions[i].answer1 + '">';
                          form += '<label class="form-check-label">' + questions[i].answer1 + '</label>';
                        form += '</div>';

                        form+= '<div class="form-check form-group">';
                          form += '<input class="form-check-input" type="radio" name="' + questions[i].survey_questions_id + '" value="' + questions[i].answer2 + '"> ';
                          form += '<label class="form-check-label">' + questions[i].answer2 + '</label>';
                        form += '</div>';

                        form+= '<div class="form-check form-group">';
                          form += '<input class="form-check-input" type="radio" name="' + questions[i].survey_questions_id + '" value="' + questions[i].answer3 + '">';
                          form += '<label class="form-check-label">' + questions[i].answer3 + '</label>';
                        form += '</div>';

                        form+= '<div class="form-check form-group">';
                          form += '<input class="form-check-input" type="radio" name="' + questions[i].survey_questions_id + '" value="' + questions[i].answer4 + '">';
                          form += '<label class="form-check-label">' + questions[i].answer4 + '</label>';
                        form += '</div>';
                      form += '</div>';
                      // form += '<br><br><br>';
                    }
                    form+= '<div class="col text-center">';
                      form += '<button id="btn-survey-submit" class="btn btn-secondary" type="submit" value="Submit">Submit</button>';
                      form += '<input class="m-2 btn btn-danger" type="reset" value="Clear">';
                    form += '</div>';
                  form += '</form>'
                 $('.list-survey').html(form);
     

                }).done(function() {
          // This $.post doesn't work
                $('#submit-form-id').submit(function(){
                    console.log("inside function sendSurvey");
                    for(var i = 0; i < questions.length; i++) {

                      var key = questions[i].survey_questions_id;
                      var value = $('input[name=' + questions[i].survey_questions_id + ']:checked', '#submit-form-id' ).val();
                // test for empty value***********************
                      finalQuestions.push({ key: value });
                    }

                    var url = 'controller.php'; 
                    var query = { page: "TakeSurvey", command: "SubmitSurvey", finalQuestionsSubmit: finalQuestions }; 
                    console.log(query);

                    $.post(url, query)     
                  });//closes $('#submit-form-id').submit
                  
                 });// closes $.post
                // this is for the <input name="finalQuestionsSubmit" value
                function finalQuestionsFun() {
                    for(var i = 0; i < questions.length; i++) {
                      var key = questions[i].survey_questions_id;
                      var value = $('input[name=' + questions[i].survey_questions_id + ']:checked', '#submit-form-id' ).val();
                      console.log(key + ' ' + value);
                      finalQuestions.push({ key: value });
                    }
                  return finalQuestions;
                }
              });//closes document.onload

</script>

</body>
</html>