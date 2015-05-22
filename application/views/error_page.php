<html>

<head>
<title>Log-in Page</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/loginpage.css"/>
<script src="<?php echo base_url();?>frameworks/jquery-2.1.3.js"></script>
</head>

<script>
$(document).ready(function()
{
    $("#image").delay(100).animate({opacity: '1'}, 'slow');
    $("#rectangle").delay(100).animate({opacity: '1'}, 'slow');
    $("#copyright").delay(100).animate({opacity: '1'}, 'slow');
    $("#user").delay(300).animate({opacity: '1', marginTop: '4%'}, 'slow');
    $("#pass").delay(500).animate({opacity: '1', marginTop: '-3%'}, 'slow');
    $("#login").delay(600).animate({opacity: '1', marginTop: '-2%'});
});
</script>

<body>
	<div id="wrapper">
		<img id="image" src="<?php echo base_url();	?>images/logo.png">
		<div id = "rectangle">
			<br><br>
			<div id="user">Error 404</div>
			<br><br>
			<div id="pass">The page you requested cannot be found!</div>
			<br><br><br>
			<?php 
				echo form_open('L/login'); 
				$login = array('type' => 'submit', 'id' => 'login', 'value' => 'Redirect to Login Page');
				echo form_input($login);
			?>	
		</div>
		<div id="copyright"> 
			<p> Copyright (c) 2015 - All Rights Reserved | University of the Philippines Los Baños</p>
	   		<p> SystemTwo, Los Baños, Laguna, Philippines. VoIP (+632) 536-XXXX. </p>
	   	</div>
	</div>
	
</body>
</html>
