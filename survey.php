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
			<div class="list-survey"></div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
        var url = 'controller.php'; 
        var query = { page: "TakeSurvey", command: "ShowSurvey"}; 
          // $.post(url,
          //           query,
          //           function(data) {
                       // var questions = JSON.parse(data);
                       // var table = '<table class="table table-condensed">';
                       //  table += '<tr>';
                       
                       // for(var title in questions[0]){
                       //      table += '<th>' + title + "</th>";
                       // }
                       // table += '</tr>';

                       
                       // for(var i =0; i< questions.length; i++){
                       //      table += '<tr>';
                       
                       // for(q in questions[i]){

                       //      table +='<td>' + questions[i][q] + '</td>';
                       //      // console.log(questions[i])
    
                       // }
                      	// table += '<td><button onclick="delete_question(\''  + questions[i].Question + '\')">Delete</button></td>';
                      	// //list_assingments(this, \''+ obj[i].id + '\')
                       //  table  += '</tr>';
                       
                       // }
                       // table += '</table>';
                       // $('#list-survey').html(table);
                // });
	});
</script>

</body>
</html>