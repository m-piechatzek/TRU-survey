<!DOCTYPE html>
<html>
<head>
	<title>Edit Survey</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
	<img src="logo.png" class="mx-auto d-block" alt="Responsive image">
	    <div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1>Edit Survey</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
						
					<button id="btn-create-question">Create Question</button>
					<button id="btn-show-survey">Show Survey</button>

					<form style="display: none" id='survey-edit-form' class="create-question" action="controller.php" method="post">
						
						<input type='hidden' name='page' value='EditSurvey'></input>
						<label>Enter Question</label>
						<textarea form='survey-edit-form' id="add-question" name="survey-question" required></textarea>
						<label>Enter Answers</label>
						<input type="text" id="survey-a1" autofocus required>
						<input type="text" id="survey-a2" autofocus required>
						<input type="text" id="survey-a3" autofocus required>
						<input type="text" id="survey-a4" autofocus required>
						<button id="btn-submit-question" class="btn btn-warning survey" type="submit" name='command' value='Survey'>Edit Survey</button>
						<button id="btn-cancel-question" class="btn btn-secondary" type="reset">Cancel</button>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div style="display: none" id="list-survey">List of Questions</div>
				</div>
			</div>
		</div>
		<script>
			// Show Create Question
			$( "#btn-create-question" ).click(function() {
				$( ".create-question" ).css("display", "inline");
			});
			// Hide Create Question
			$( "#btn-cancel-question" ).click(function() {
				$( ".create-question" ).css("display", "none");
			});


			//Show Survey Questions
			$( "#btn-show-survey" ).click(function() {
				$( "#list-survey" ).css("display", "inline");
			});

			//Submit Survey Question
			$('#survey-edit-form').submit(function(event)
            {   
            	console.log("inside click");
                // Send then'EditSuveryQuestion' command using jQuery AJAX    
                var url = 'controller.php';
                var query = { page:"EditSurvey", command: "CreateQuestion", question: $('#add-question').val(),
                answer1: $('#survey-a1').val(), answer2: $('#survey-a2').val(), answer3: $('#survey-a3').val(), answer4: $('survey-a4').val()};

                event.preventDefault();

				//Send to controller.php
                $.post(url,query);
            });
		</script>
</body>
</html>