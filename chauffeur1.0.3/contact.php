<?php
if(!isset($_SESSION))
{
	session_start();
}
require 'localization.php';
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Multicusine  Website Template | Contact  :: W3layouts</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link href="css/slider.css" rel="stylesheet" type="text/css"  media="all" />
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" src="js/camera.min.js"></script>
  <script type="text/javascript" src="js/jquery.lightbox.js"></script>
  <link rel="stylesheet" type="text/css" href="css/lightbox.css" media="screen" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

  <script type="text/javascript">

  </script>
  <script type="text/javascript">
	 $(document).ready(function() {
		    $(".fr").click(function() {
		    	 var lang = "fr_FR";
				    $.post("fr.php", {"input": lang});

		    });

		});

	 $(document).ready(function() {
		    $(".en").click(function() {
		    	 var lang = "en_US";
				    $.post("en.php", {"input": lang});
		    });
		});

	</script>

 </head>
  <body>
	<!----start-header----->
	 <div class="header">
	     <div class="wrap">
			<div class="top-header">
				<div class="logo">
					<a href="index.php"><img src="images/logo.png" width="220" title="logo" /></a>
				</div>
				<div class="social-icons">
					<ul>
						<li><a href="contact.php"><img name="en" class="en" src="images/langues/us.png" title="EN" alt="EN"/></a></li>
						<li><a href="contact.php"><img name="fr" class="fr" src="images/langues/fr.png" title="FR" alt="FR"/></a></li>
				    </ul>
				</div>
				<div class="clear"> </div>
			</div>
			<!---start-top-nav---->
			<div class="top-nav">
				<div class="top-nav-left">
					<ul>
						<li><a href="index.php"><?php echo _f("Home"); ?></a></li>
						<li><a href="services.php"><?php echo _f("Services"); ?></a></li>
						<li><a href="tarifs.php"><?php echo _f("Prices"); ?></a></li>
						<li><a href="devis.php"><?php echo _f("Online quote"); ?></a></li>
						<li class="active"><a href="contact.php"><?php echo _f("Contact"); ?></a></li>
						<div class="clear"></div>
					</ul>
				</div>

				<div class="clear"> </div>
			</div>
			<!---End-top-nav---->
		</div>
	</div>
   <!----End-header----->
		 <!---start-content---->
		 <div class="content">
		 	<!---start-contact---->
		 	<div class="contact">
		 		<div class="wrap">
				<div class="section group">
				<div class="col span_1_of_3">
				<br><br><br><br>
					<div class="contact_info">
		    	 		<div class="map">
				   			<iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2622.6960207570605!2d2.2432138000000004!3d48.9021301!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e665a910b93f65%3A0x95be5b6e75e44435!2s110+Avenue+Marceau%2C+92400+Courbevoie!5e0!3m2!1sfr!2sfr!4v1414250490483"></iframe>
				   		</div>
      				</div>
      			<div class="company_address">
					<p>SARL PARIVAC</p>
					<p>110 avenue Marceau</p>
					<p>92400 Courbevoie</p>
					<p>06.24.26.86.86</p>
					<p><A HREF="mailto:conatct@paris-limo-chauffeur.com">conatct@paris-limo-chauffeur.com</A></p>
					<br>
				   </div>
				</div>
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h3><?php echo _f("Contact Us");?></h3>
					    <form method="post" action="contact-post.html">
					    	<div>
						    	<span><label><?php echo _f("Name");?></label></span>
						    	<span><input name="data[Contact][name]" placeholder=<?php echo _f('"Full name"'); ?> required="required" type="text" id="ContactName"></span>
						    </div>
						    <div>
						    	<span><label><?php echo _f("E-Mail");?></label></span>
						    	<span><input style="width: 766.09px; height: 24px;" name="data[Contact][mail]" placeholder="email@domain.com" required="required" type="email" id="ContactMail"></span>
						    </div>
						    <div>
						     	<span><label><?php echo _f("Mobile");?></label></span>
						    	<span><input name="userPhone" type="text" pattern="\d{10}" title=<?php echo _f('"Incorrect phone number"'); ?> required class="textbox"></span>
						    </div>
						    <div>
						    	<span><label><?php echo _f("Subject");?></label></span>
						    	<span><textarea name="data[Contact][message]" cols="30" rows="6" id="ContactMessage"> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" class="mybutton" value=<?php echo _f('"Send"');?>></span>
						  </div>
					    </form>

				    </div>
  				</div>
			  </div>
			</div>
			</div>
		 	<!---End-contact---->
		 	</div>
		 <!---End-content---->
		 <!---start-footer---->
		<div class="footer">
		<div class="wrap">
			<div class="footer-grid">

			<br>
				<p align="center"><a href="services.php"><?php echo _f("Services"); ?></a>&nbsp; | &nbsp; <a href="tarifs.php"><?php echo _f("Prices"); ?></a> &nbsp; | &nbsp; <a href="devis.php"><?php echo _f("Online quote"); ?></a>&nbsp; | &nbsp; <a href="contact.php"><?php echo _f("Contact"); ?></a></p>
			<br>
			<p align="center"> SARL PARIVAC </p>
			<p align="center">110 avenue Marceau</p>
			<p align="center">92400 Courbevoie</p>
			<p align="center">06.24.26.86.86</p>
			<p align="center"><A HREF="mailto:conatct@paris-limo-chauffeur.com">conatct@paris-limo-chauffeur.com</A></p>
			<br>

			</div>



			<div class="clear"> </div>
		</div>
		<div class="clear"> </div>
	</div>
	<div class="copy-right">
		<div class="top-to-page">
						<a href="#top" class="scroll"> </a>
						<div class="clear"> </div>
					</div>
		<p>Paris Limo Chauffeur &#xA9 2014</p>
	</div>
		 <!---End-footer---->
	</body>
</html>

