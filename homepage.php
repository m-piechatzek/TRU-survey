<!DOCTYPE html>
<html>
<head>
	<title>TRU Survey</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<style>
		body {
			background-color: #FAF7EC;
		}
		.color-back {
			background-color: #FAF7EC;	
		}
		.highlight {
			background-color: #E0F5F7;
		}
		.under-header {
			/*background-color: #F1F5F6;*/
		}
		.under-header-font {
			color: #013E51;
		}
		.header-line {
			height: 100px;
			width: 100vw;
			background-color: #013E51;
			text-align: center;
			color: white;
		}
		.header-line > h1 {
			padding-top: 20px;
		}
		.welcome-img {
			background-image: url(ae.jpg);
						height: 100px;
			width: 100vw;
		}

	</style>
</head>
<body>
					<div class="header-line mw-100 color-back">
	                <h1>TRU Survey</h1>
	                </div>
        <div class='container color-back'>
        <!-- Header -->
        <header>   	
	        <div class='row color-back m-0'>
	            <div class='col-12 p-0 m-0 text-center rounded color-back'>
    				<img src="ae.jpg" class="img-fluid color-back p-0 m-0" alt="Responsive image">
	                <h3 class="display-3 under-header-font m-0 p-0" >Welcome <?php if(!empty($_SESSION['username'])) echo $_SESSION['username']; ?>!</h3>
				</div>
        	</div>
        </header>
			<div class="row">
				<div class="col-md-6 text-right">
					<form action="controller.php" method="post">
						<input type='hidden' name='page' value='MainPage'></input>
						<input type='hidden' name='command' value='ShowData'></input>
						<button id="btn-show-data" class="btn btn-secondary" type="submit" name='command' value='ShowData'>Show Data</button>
					</form>
				</div>
				<div class="col-md-6">
					<form action="controller.php" method="post">
						<input type='hidden' name='page' value='MainPage'></input>
						<button class="btn btn-secondary" type="submit" name='command' value='SignOut'>Sign Out</button>
					</form>
				</div>
			</div>	
			<div class="row">	
				<div class="col-md-12 text-center">
					
					<!-- If user is admin then they are only allowed to edit survey -->
					</br>
					<?php
						if(!empty($_SESSION['username']) and $_SESSION['username'] == 'admin') {
					?>
					<form action="controller.php" method="post">
						<input type='hidden' name='page' value='MainPage'></input>
						<button class="btn btn-warning survey" type="submit" name='command' value='Survey'>Edit Survey</button>
					</form>
					<?php
					// Only show if user hasn't taken the survey 
						} else {
							if(!$tookSurvey) {
					?>
					<form action="controller.php" method="post">
						<input type='hidden' name='page' value='MainPage'></input>
						<button class="btn btn-primary survey" type="submit" name='command' value='Survey'>Take Survey</button>
					</form>
					<?php
							}
						}
						echo $_POST['command']; echo $_POST['page']; echo $tookSurvey;
					?>
				</div>
			</div> 
			<div  id="dataid" class="show-data">
	        	<div class="row">
	        			<div class="col-md-1"></div>
	        		<div class="col-md-5 m-1 rounded highlight">
	        			<h3>
	        				<!-- style="display: none;" -->

	        				<?php if(isset($international)) { ?> <div class="text-center"> <i class="fas fa-globe-americas fa-5x d-block"></i><?php echo $international; ?> % of International Students found TRU very welcoming</div>
	        					<?php } ?>

	        			</h3>
	        		</div>
	        		<div class="col-md-5 m-1 rounded highlight">
	        			<h3>
		        			<?php if(isset($parkingAlways)) {?> <div class="text-center"> <i class="fas fa-car fa-5x"></i><br/> <?php echo $parkingAlways; ?>% of people always find parking at TRU</div>
		        			<?php } ?>
	        			</h3>
	        		</div>
	        		<div class="col-md-1"></div>
	        	</div>
<!-- 	        	<div class="row">
	        		
	        	</div> -->
	        	<div class="row">
	        		<div class="col-md-1"></div>

	        		<div class="col-md-5 m-1 rounded highlight">
	        			<h3>
	        			<?php if(isset($voteYes)) {?> <div class="text-center"> <i class="fas fa-vote-yea fa-5x"></i> <br><?php echo $voteYes; ?>% of people voted in for the student council </div>
	        			<?php } ?>
	        			</h3>
	        		</div>
	        		<div class="col-md-5 m-1 rounded highlight"></div>

	        		<div class="col-md-1"></div>
	        	</div>
			</div>           
    	</div>

    	<script>
    		$(document).ready(function(){
    
    		    		
    	});
    	</script>
</body>
</html>