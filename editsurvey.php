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
				<button id="btn-create-question">Create Question</button>
				<form style="display: none" class="create-question" action="controller.php" method="post">
					
					<input type='hidden' name='page' value='EditSurvey'></input>
					<input type="text" name="">
					<button class="btn btn-warning survey" type="submit" name='command' value='Survey'>Edit Survey</button>
				</form>
			</div>
		</div>
		<script>
			$( "#btn-create-question" ).click(function() {
				$( ".create-question" ).css("display", "inline");
			});
		</script>
</body>
</html>