<!DOCTYPE html>
<html>
<head>
	<title>Edit Survey</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<!-- <style type="text/css">
	.delete {
		background-color: none;
	}
</style> -->
<body>
	<img src="logo.png" class="mx-auto d-block" alt="Responsive image">
	    <div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1>Edit Survey</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
						<!-- Buttons for Show/Create Questions from Survey -->
					<button class="btn btn-secondary btn-sm" id="btn-create-question">Create Question</button>
					<button class="btn btn-secondary btn-sm" id="btn-show-survey">Show Survey</button>
				</div>
						
				<div class="col-md-2 text-right">
					<form action="controller.php" method="post">
						<input type='hidden' name='page' value='EditSurvey'></input>
						<button class="btn btn-secondary btn-sm" type="submit" name='command' value='SignOut'>Sign Out</button>
					</form>

				</div>
				<div class="col-md-2 text-left">          
					<form action="controller.php" method="post">
			            <input type='hidden' name='page' value='EditSurvey'></input>
			            <button class="btn btn-secondary btn-sm" type="submit" name='command' value='Home'>Home</button>
			        </form>
      			</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<br>
					<h3 style="display: none" class="create-title">Create Question</h3>
					<br>
					<br>
					<!-- Show form to create Question -->
					<form style="display: none" id='survey-edit-form' class="create-question" action="controller.php" method="post">
						<div class="form-group">	
							<input type='hidden' name='page' value='EditSurvey'></input>
							<label>Enter Question</label>
							<textarea form='survey-edit-form' class="form-control" id="add-question" name="survey-question" autofocus required></textarea>
						</div>
						<div class="form-group">	
							<label>Enter Answers</label>
								<div class="form-row">	
									<div class="col">
										<input class="form-control" type="text" id="survey-a1" required>
									</div>
									<div class="col">
										<input class="form-control" type="text" id="survey-a2" required>
									</div>
									<div class="col">	
										<input class="form-control" type="text" id="survey-a3" required>
									</div>
									<div class="col">	
										<input class="form-control" type="text" id="survey-a4" required>
									</div>
								</div>
						</div>
						<div class="form-group">
							<button id="btn-submit-question" class="btn btn-warning survey" type="submit" name='command' value='CreateQuestion'>Add Question</button>
							<button id="btn-cancel-question" class="btn btn-secondary" type="reset">Cancel</button>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<br>
					<h3 style="display: none" class="list-title">List of Questions</h3>
					<br>
					<br>
					<div style="display: none" id="list-survey"></div>
				</div>
			</div>
		</div>
		<!-- Create Question in Survey -->
		<script>
			// Show Create Question
			$( "#btn-create-question" ).click(function() {
				$( ".create-question" ).css("display", "inline");
				$( ".create-title" ).css("display", "inline");
			});
			// Hide Create Question
			$( "#btn-cancel-question" ).click(function() {
				$( ".create-question" ).css("display", "none");
				$( ".create-title" ).css("display", "none");
			});


			//Show Survey Questions
			$( "#btn-show-survey" ).click(function() {
				$( "#list-survey" ).css("display", "inline");
				$( ".list-title" ).css("display", "inline");
			});

			//Submit Survey Question
			$('#survey-edit-form').submit(function(event)
            {   
            	console.log("inside click", $('#add-question').val());
                // Send then'EditSuveryQuestion' command using jQuery AJAX    
                var url = 'controller.php';
                var query = { page: "EditSurvey", command: "CreateQuestion", question: $('#add-question').val(),
                answer1: $('#survey-a1').val(), answer2: $('#survey-a2').val(), answer3: $('#survey-a3').val(), answer4: $('#survey-a4').val()};

				console.log(query);
				//Send to controller.php
                $.post(url,query);
                // event.preventDefault();
            });
		</script>

		<!-- List Survey Questions -->
		<script>
			var count = 0;
        $('#btn-show-survey').click(function()
            {
                var url = 'controller.php'; 
                var query = { page: "EditSurvey", command: "ListQuestions"};  
                //Added List of Survey Questions 
                $.post(url,
                    query,
                    function(data) {
                       var questions = JSON.parse(data);
                       var table = '<table class="table table-condensed">';
                        table += '<tr>';
                       
                       for(var title in questions[0]){
                            table += '<th>' + title + "</th>";
                       }
                       table += '</tr>';

                       
                       for(var i =0; i< questions.length; i++) {
                       		count++;
                            table += '<tr id="delete'+count+'">';
	                       for(q in questions[i]) {
	                            table +='<td>' + questions[i][q] + '</td>';   
	                       }
	                      	table += '<td><button onclick="delete_question(\'' + questions[i].Question + '\')">Delete</button></td>';
	                      	//list_assingments(this, \''+ obj[i].id + '\')
	                        table  += '</tr>';
	                       
                       }
                       table += '</table>';
                       $('#list-survey').html(table);
                });
            });
		
        	function delete_question(question) {
				$( '#delete'+count+'').css("background-color", "red");
        		var url = 'controller.php'; 
        		var query = { page:"EditSurvey", command: "DeleteQuestion", question: question};


				//Send to controller.php
                $.post(url,query);
        	}

        </script>
</body>
</html>