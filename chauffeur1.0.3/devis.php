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
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>

   	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css">

	<script type="text/javascript" src="js/jquery.datePicker.js"></script>
<script type="text/javascript" src="js/date.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="css/datePicker.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/demo.css">

 <!-- page specific scripts -->
<script type="text/javascript" charset="utf-8">
    $(function()
      {
		$('.date-pick').datePicker({clickInput:true})
      });
</script>


	 <script>
		$(function() {
		$( "#date" ).datepicker();
		});
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

  <script>
      function initialize() {
		var input = document.getElementById('devisDepart');
		var options = {
				types: ['geocode'],
		  componentRestrictions: {country: 'fr'}
		};

		autocomplete = new google.maps.places.Autocomplete(input, options);

      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    <script>
      function initialize() {
		var input = document.getElementById('devisArrivee');
		var options = {
				types: ['geocode'],
		  componentRestrictions: {country: 'fr'}
		};

		autocomplete = new google.maps.places.Autocomplete(input, options);

      }
      google.maps.event.addDomListener(window, 'load', initialize);
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
						<li><a href="devis.php"><img name="en" class="en" src="images/langues/us.png" title="EN" alt="EN"/></a></li>
						<li><a href="devis.php"><img name="fr" class="fr" src="images/langues/fr.png" title="FR" alt="FR"/></a></li>
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
						<li class="active"><a href="devis.php"><?php echo _f("Online quote"); ?></a></li>
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
		 	<!---start-contact---->
		 	<div class="contact">
		 		<div class="wrap">
				<div class="section group">
				<div class="col span_1_of_3">
				<br><br><br><br>
					<div class="contact_info">

      				</div>
      				<h3><?php echo _f("Online Estimates");?></h3>
      			<div class="company_address">
					<p><?php echo _f("Online Estimates and Reservations are also available, please fill out the fields below. An operator will send you a quote or booking (*an instant response one hour)");?></p>
					<p><?php echo _f("*Between 8am & 8pm, otherwise asap");?></p>
					<p><?php echo _f("Please complete your quote request :");?></p>
					<br>
				   </div>
				</div>
				<div class="col span_2_of_3">
				  <div class="devis-form">

					    <form method="post" action="contact-post.html">
					    	<div>
						    	<span><label><?php echo _f("Title * :");?></label></span>
						    	<span>
							    	<select  name="data[devis][title]" required="required" id="devisTitle" class="Clscombo">
							    		<option></option>
							    		<option><?php echo _f("Miss");?></option>
							    		<option><?php echo _f("Mrs.");?></option>
							    		<option><?php echo _f("Mr.");?></option>
							    	</select>
						    	</span>
						    </div>
						    <div>
						    <table>
						    	<tr>
						    		<td><span><label><?php echo _f("Last name * : ");?></label></span></td>
						    		<td><span><label><?php echo _f("First name * : ");?></label></span></td>

						    	</tr>
						    	<tr>
						    		<td style="padding-right: 5px"><span><input style="width: 200px;" name="data[devis][Lastname]" required="required" type="text" id="DevisLastName"></span></td>
						    		<td><span><input style="width: 200px;" name="data[devis][Firstname]" required="required" type="text" id="DevisFirstName"></span></td>

						    	</tr>
						    </table>

						    </div>

						    <div>
						    	<span><label><?php echo _f("Company :");?></label></span>
						    	<span><input name="data[devis][Company]" type="text" id="DevisCompany"></span>
						    </div>
						    <div>
						     	<span><label><?php echo _f("Number of passenger(s) * :");?></label></span>
						    	<span><input name="DevisPassenger" type="text" pattern="[1-7]" title=<?php echo _f('"Number of passengers must be between 1 and 7"'); ?> required class="textbox"></span>
						    </div>
						    <div>
						    	<span><label><?php echo _f("Pick-up location * :");?></label></span>
						    	<span><input name="data[devis][depart]" required="required" type="text" id="devisDepart"></span>
						    </div>

						    <div>
						    	<span><label><?php echo _f("Destination * :");?></label></span>
						    	<span><input name="data[devis][arrivee]" required="required" type="text" id="devisArrivee"></span>
						    </div>
						    <div>
						    	<span><label><?php echo _f("Date service are needed * :");?></label></span>
						    	<span></span><input class="date-pick Clscombo" style="width: 150px;" type="text" name="date1" id="date1"></span>
						    </div>
						    <div>
						    <table>
						    	<tr>
						    		<td><span><label><?php echo _f("Hour(s) * : ");?></label></span></td>
						    		<td><span><label><?php echo _f("Minute(s) * : ");?></label></span></td>

						    	</tr>
						    	<tr>
						    		<td style="padding-right: 30px">
						    			<span>
						    				<select  name="data[devis][hour]" required="required" id="devisHour" class="Clscombo">
									    		<option></option>
									    		<option><?php echo _f("1am");?></option>
									    		<option><?php echo _f("2am");?></option>
									    		<option><?php echo _f("3am");?></option>
									    		<option><?php echo _f("4am");?></option>
									    		<option><?php echo _f("5am");?></option>
									    		<option><?php echo _f("6am");?></option>
									    		<option><?php echo _f("7am");?></option>
									    		<option><?php echo _f("8am");?></option>
									    		<option><?php echo _f("9am");?></option>
									    		<option><?php echo _f("10am");?></option>
									    		<option><?php echo _f("11am");?></option>
									    		<option><?php echo _f("12am");?></option>
									    		<option><?php echo _f("1pm");?></option>
									    		<option><?php echo _f("2pm");?></option>
									    		<option><?php echo _f("3pm");?></option>
									    		<option><?php echo _f("4pm");?></option>
									    		<option><?php echo _f("5pm");?></option>
									    		<option><?php echo _f("6pm");?></option>
									    		<option><?php echo _f("7pm");?></option>
									    		<option><?php echo _f("8pm");?></option>
									    		<option><?php echo _f("9pm");?></option>
									    		<option><?php echo _f("10pm");?></option>
									    		<option><?php echo _f("11pm");?></option>
									    		<option><?php echo _f("12pm");?></option>
							    			</select>
						    			</span>
						    		</td>
						    		<td>
						    			<span>
						    				<select  name="data[devis][minute]" required="required" id="devisMinute" class="Clscombo">
									    		<option></option>
													<option>00</option>
													<option>05</option>
													<option>10</option>
													<option>15</option>
													<option>20</option>
													<option>25</option>
													<option>30</option>
													<option>35</option>
													<option>40</option>
													<option>45</option>
													<option>50</option>
													<option>55</option>
							    			</select>
						    			</span>
						    		</td>
						    	</tr>
						    </table>

						    </div>



						    <div>
						    	<span><label><?php echo _f("Email * : ");?></label></span>
						    	<span><input name="data[Contact][mail]" placeholder="email@domain.com" required="required" type="email" id="ContactMail"></span>
						    </div>
						    <div>
						     	<span><label><?php echo _f("Phone number * : ");?></label></span>
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

