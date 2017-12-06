<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Submit PHP Forms without Page Refresh using jQuery and Ajax</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<!--<link rel="stylesheet" type="text/css" href="style.css" />-->
<style>
	.wrapper{
		padding-top: 50px;
	}
	#form-content{
		margin: 0 auto;
		width: 500px;
	}
</style>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://www.codingcage.com">Coding Cage</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a target="_blank" href="http://www.codingcage.com/2015/06/submit-php-form-without-page-refresh-jquery-ajax.html">Back to Article</a></li>
            <li><a href="http://www.codingcage.com/search/label/jQuery">jQuery</a></li>
            <li><a href="http://www.codingcage.com/search/label/PHP">PHP</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 


<div class="wrapper">
	
	<div class="container">
	
	<div class="page-header">
		<h1>
		<a target="_blank" href="http://www.codingcage.com/2015/06/submit-php-form-without-page-refresh-jquery-ajax.html">
		Ajax Form Submit
		</a> - Demo by Coding Cage</h1>
	</div>
	
	<div class="col-lg-12">
	
		<div class="row">
		
			<div id="form-content">
			
			<form method="post" id="reg-form" autocomplete="off">
				
				<div class="form-group">
					<input type="text" class="form-control" name="txt_fname" id="lname" placeholder="First Name" required />
				</div>
				
				<div class="form-group">
					<input type="text" class="form-control" name="txt_lname" id="lname" placeholder="Last Name" required />
				</div>
				
				<div class="form-group">
					<input type="text" class="form-control" name="txt_email" id="lname" placeholder="Your Mail" required />
				</div>
				
				<div class="form-group">
					<input type="text" class="form-control" name="txt_contact" id="lname" placeholder="Contact No" required />
				</div>
				
				<hr />
				
				<div class="form-group">
					<button class="btn btn-primary">Submit</button>
				</div>
				
			</form>
            
            </div>
            
            </div>
		
	</div>
	
</div>
	
</div>

<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {	
	
	// submit form using $.ajax() method
	
	$('#reg-form').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.ajax({
			url: 'submit.php',
			type: 'POST',
			data: $(this).serialize() // it will serialize the form data
		})
		.done(function(data){
			$('#form-content').fadeOut('slow', function(){
				$('#form-content').fadeIn('slow').html(data);
			});
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	});
	
	
	/*
	// submit form using ajax short hand $.post() method
	
	$('#reg-form').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.post('submit.php', $(this).serialize() )
		.done(function(data){
			$('#form-content').fadeOut('slow', function(){
				$('#form-content').fadeIn('slow').html(data);
			});
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');
		});
		
	});
	*/
	
});
</script>
</body>
</html>