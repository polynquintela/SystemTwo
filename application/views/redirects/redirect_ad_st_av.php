<html>

<head>
<title>Log-in Page</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/loginpage.css"/>
<script src="<?php echo base_url();?>frameworks/jquery-2.1.3.js"></script>
</head>

<script>
$(document).ready(function()
{
    $("#image").animate({opacity: '1'});
    $("#rectangle").animate({opacity: '1'});
    $("#copyright").animate({opacity: '1'});
    $("#user1").delay(300).animate({opacity: '1'});
    $("#pass").delay(300).animate({opacity: '1'});
    $("#login").delay(600).animate({opacity: '1'});
    $("#login1").delay(700).animate({opacity: '1'});
    $("#login2").delay(800).animate({opacity: '1'});
    $("#login3").delay(800).animate({opacity: '1'});
});
</script>

<body>
	<div id="wrapper">
		<img id="image" src="<?php echo base_url();	?>images/logo.png">
		<div id = "rectangle">
			<div id="user1">Login as one of the following</div>
			<br>
			<?php 
				echo form_open('A/ad'); 
				$login = array('type' => 'submit', 'id' => 'login', 'value' => 'Admin');
				echo form_input($login);
				echo form_close();
			?>
			<?php 
				echo form_open('A/st'); 
				$login1 = array('type' => 'submit', 'id' => 'login1', 'value' => 'Subject Teacher');
				echo form_input($login1);
				echo form_close();
			?>	
			<?php 
				echo form_open('A/av'); 
				$login2 = array('type' => 'submit', 'id' => 'login2', 'value' => 'Adviser');
				echo form_input($login2);
				echo form_close();
			?>
			
		</div>
		<div id="copyright"> 
			<p> Copyright (c) 2015 - All Rights Reserved | University of the Philippines Los Baños</p>
	   		<p> SystemTwo, Los Baños, Laguna, Philippines. VoIP (+632) 536-XXXX. </p>
	   	</div>
	</div>
	
</body>
</html>
