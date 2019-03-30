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
		<div class="col-md-6">
			<h1>TRU Survey</h1>
			<div class="list-survey"></div>
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
                 var form = '<form action="controller.php" method="post">'
                    for(var i =0; i< questions.length; i++){
                 
                      form+= '<div>';
                      form += '<label>' + questions[i].question + '</label>';
                      form += '</div>';

                      form+= '<div class="custom-control custom-radio">';
                      form += '<input class="custom-control-input" type="radio" name="' + questions[i].survey_questions_id + '" value="' + questions[i].answer1 + '">';
                      form += '<label class="custom-control-label">' + questions[i].answer1 + '</label>';
                      form += '</div>';

                      form+= '<div class="custom-control custom-radio">';
                      form += '<input class="custom-control-input" type="radio" name="' + questions[i].survey_questions_id + '" value="' + questions[i].answer2 + '">';
                      form += '<label class="custom-control-label">' + questions[i].answer2 + '</label>';
                      form += '</div>';

                      form+= '<div class="custom-control custom-radio">';
                      form += '<input class="custom-control-input" type="radio" name="' + questions[i].survey_questions_id + '" value="' + questions[i].answer3 + '">';
                      form += '<label class="custom-control-label">' + questions[i].answer3 + '</label>';
                      form += '</div>';

                     form+= '<div class="custom-control custom-radio">';
                      form += '<input class="custom-control-input" type="radio" name="' + questions[i].survey_questions_id + '" value="' + questions[i].answer4 + '">';
                      form += '<label class="custom-control-label">' + questions[i].answer4 + '</label>';
                      form += '</div>';
                    }
                  form+= '<div>';
                  form += '<input type="submit" value="Submit">';
                      form += '</div>';
                 $('.list-survey').html(form);
              });
	});
</script>

</body>
</html>