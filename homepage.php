<!DOCTYPE html>
<html>
<head>
	<title>TRU Survey</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<style>
		.survey {

		}

	</style>
</head>
<body>
    <img src="logo.png" class="mx-auto d-block" alt="Responsive image">
        <div class='container'>
        <!-- Header -->
	        <div class='row'>
	            <div class='col-md-12 text-center'>
	                <h1>TRU Survey</h1>
	                <h3>Welcome <?php echo $username; ?>!</h3>
					<!-- If user is admin then they are only allowed to edit survey -->
					</br>
					<?php
						if($_SESSION['username'] == 'admin') {
					?>
					<form action="controller.php" method="post">
						<input type='hidden' name='page' value='MainPage'></input>
						<button class="btn btn-warning survey" type="submit" name='command' value='Survey'>Edit Survey</button>
					</form>
					<?php
						} else {
					?>
					<form action="controller.php" method="post">
						<input type='hidden' name='page' value='MainPage'></input>
						<button class="btn btn-primary survey" type="submit" name='command' value='Survey'>Take Survey</button>
					</form>
					<?php
						}
					?>

					<br>
					<form action="controller.php" method="post">
						<input type='hidden' name='page' value='MainPage'></input>
						<button class="btn btn-secondary" type="submit" name='command' value='SignOut'>Sign Out</button>
					</form>
	            
				</div>
        	</div>
    	</div>
</body>
</html>