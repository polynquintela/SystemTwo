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
    $("#username").delay(300).animate({opacity: '1'}, 'slow');
    $("#pass").delay(500).animate({opacity: '1', marginTop: '-3%'}, 'slow');
    $("#password").delay(500).animate({opacity: '1'}, 'slow');
    $("#login").delay(600).animate({opacity: '1', marginTop: '-2%'});
});
</script>

<body>
	<?php echo validation_errors(); ?>
	<?php echo form_open('L/login'); ?>
	<div id="wrapper">
		<img id="image" src="<?php echo base_url();	?>images/logo.png">
		<div id = "rectangle">
			<div id="user">Username</div>
			<input type="text" name="username" autocomplete="off" id = "username" value="" size="50" pattern="[a-zA-Z0-9_]+" required/>
			<br><br>
			
			<div id="pass">Password</div>
			<input type="password" name="password" autocomplete="off" id="password" value="" size="50" required/>
			<br><br>
			<input type="submit" id="login" value="Login"/>	
		</div>
		<div id="copyright"> 
			<p> Copyright (c) 2015 - All Rights Reserved | University of the Philippines Los Baños</p>
	   		<p> SystemTwo, Los Baños, Laguna, Philippines. VoIP (+632) 536-XXXX. </p>
	   	</div>
	</div>
	
</body>
</html>
