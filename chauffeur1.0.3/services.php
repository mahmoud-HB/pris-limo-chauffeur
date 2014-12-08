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
  <title>Multicusine  Website Template | Services  :: W3layouts</title>
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
						<li><a href="services.php"><img name="en" class="en" src="images/langues/us.png" title="EN" alt="EN"/></a></li>
						<li><a href="services.php"><img name="fr" class="fr" src="images/langues/fr.png" title="FR" alt="FR"/></a></li>
				    </ul>
				</div>
				<div class="clear"> </div>
			</div>
			<!---start-top-nav---->
			<div class="top-nav">
				<div class="top-nav-left">
					<ul>
						<li><a href="index.php"><?php echo _f("Home"); ?></a></li>
						<li class="active"><a href="services.php"><?php echo _f("Services"); ?></a></li>
						<li><a href="tarifs.php"><?php echo _f("Prices"); ?></a></li>
						<li><a href="devis.php"><?php echo _f("Online quote"); ?></a></li>
						<li><a href="contact.php"><?php echo _f("Contact"); ?></a></li>
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
		 	<!---start-services---->
		 	<div class="services">
		 		<div class="wrap">
					<div class="services-header">
						<h3>Services</h3>
						<div class="clear"> </div>
					</div>
					<div class="services-grids">
						<div class="services-grid">
							<a href="#">consectetur adiing</a>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi.</p>
						</div>
						<div class="services-grid">
							<a href="#">consectetur adiing</a>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi.</p>
						</div>
						<div class="services-grid">
							<a href="#">consectetur adiing</a>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi.</p>
						</div>
						<div class="services-grid">
							<a href="#">consectetur adiing</a>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi.</p>
						</div>
						<div class="services-grid">
							<a href="#">consectetur adiing</a>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi.</p>
						</div>
						<div class="services-grid">
							<a href="#">consectetur adiing</a>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi.</p>
						</div>
						<div class="services-grid">
							<a href="#">consectetur adiing</a>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi.</p>
						</div>
						<div class="services-grid">
							<a href="#">consectetur adiing</a>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi.</p>
						</div>
						 <div class="clear"> </div>
					</div>

				<div class="specials">
					<div class="specials-heading">
						<h3>Special Dishes</h3>
						<div class="clear"> </div>
					</div>
					<div class="clear"> </div>
					<div class="specials-grids">
						<div class="special-grid">
							<img src="images/slider2.jpg" title="image-name">
							<a href="#">Lorem ipsum dolor</a>
							<p>Lorem ipsum dolor sit amet consectetur adiing elit. In volutpat luctus eros ac placerat. Quisque erat metus facilisis non feu,aliquam hendrerit quam. Donec ut lectus vel dolor adipiscing tincnt.</p>
						</div>
						<div class="special-grid">
							<img src="images/slider1.jpg" title="image-name">
							<a href="#">volutpat luctus</a>
							<p>Lorem ipsum dolor sit amet consectetur adiing elit. In volutpat luctus eros ac placerat. Quisque erat metus facilisis non feu,aliquam hendrerit quam. Donec ut lectus vel dolor adipiscing tincnt.</p>
						</div>
						<div class="special-grid spe-grid">
							<img src="images/slider4.jpg" title="image-name">
							<a href="#">Quisque erat metus</a>
							<p>Lorem ipsum dolor sit amet consectetur adiing elit. In volutpat luctus eros ac placerat. Quisque erat metus facilisis non feu,aliquam hendrerit quam. Donec ut lectus vel dolor adipiscing tincnt.</p>
						</div>
						<div class="clear"> </div>
					</div>
					<div class="clear"> </div>
					</div>
				</div>
				</div>
		 	<!---End-services---->
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


