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
      <!-- <div class="list-survey"></div> -->
    </div>
    <div class="col-md-6">
			<div class="list-survey"></div>
		</div>
        <div class="col-md-3">
      <!-- <div class="list-survey"></div> -->
    </div>
	</div>
</div>
<script>
	$(document).ready(function() {
        var url = 'controller.php'; 
        console.log("inside document ready");
        var query = { page: "TakeSurvey", command: "ShowSurvey"}; 
          $.post(url,
              query,
              function(data) {
                 var questions = JSON.parse(data);
                 var form = '<br><form class="justify-content-center" action="controller.php" method="post">'
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
                      form += '<input class="btn btn-secondary" type="submit" value="Submit">';
                      form += '<input class="m-2 btn btn-danger" type="reset" value="Clear">';
                    form += '</div>';
                  form += '</form>'
                 $('.list-survey').html(form);
              });
	});
</script>

</body>
</html>