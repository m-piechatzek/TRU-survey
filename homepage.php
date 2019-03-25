<!DOCTYPE html>
<html>
<head>
	<title>TRU Survey</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>


	<!-- If user is admin then they are only allowed to edit survey -->
	<!-- try FORM -->
	<?php
		if($_SESSION['username'] == 'admin') {
	?>
	<button type="button">Edit Survey</button>
	<?php
		} else {
	?>
		<button type="button">Take Survey</button>
	<?php
		}
	?>

<!-- 	<script>
		

	</script> -->
</body>
</html>