<?php
include ("_includes/_login.inc");
include ("_includes/_requetes.inc");

if (! isset ( $_SESSION )) {
	session_start ();
}
require 'localization.php';
if (isset($_SESSION['opt']))
		unset($_SESSION['opt']);
?>

<!DOCTYPE HTML>
<html>
<head>
<title><?php echo _f("Paris-Limo-Chauffeur"); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">


<!-- ========================  Plugin google map  ================== -->
<script
	src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>

<!-- ========================  CSS Files  ========================== -->

<link href='http://fonts.googleapis.com/css?family=Open+Sans'
	rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/slider.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/lightbox.css" rel="stylesheet" type="text/css"
	media="screen" />
<link href="css/popupPrint.css" rel="stylesheet" type="text/css"
	media="print">
<link href="css/popupStyle.css" rel="stylesheet" type="text/css"
	media="screen, projection">
<link rel="stylesheet" type="text/css" media="screen"
	href="css/datePicker.css">
<link rel="stylesheet" type="text/css" media="screen"
	href="css/demo.css">

<!-- ========================  JS Files  =========================== -->

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/camera.min.js"></script>
<script type="text/javascript" src="js/jquery.lightbox.js"></script>
<script type="text/javascript" src="js/jquery.maps.google.js"></script>
<script type="text/javascript" src="js/jquery.lang.js"></script>
<script type="text/javascript" src="js/popupScript.js"></script>
<script type="text/javascript" src="js/jquery.datePicker.js"></script>
<script type="text/javascript" src="js/date.js"></script>


<script type="text/javascript">
  $(function() {
	$('.gallery a').lightBox();
  });
</script>
<script type="text/javascript">
   jQuery(function(){
	jQuery('#camera_wrap_1').camera({
		pagination: false,
	});
});
</script>

<script type="text/javascript">

$(document).ready(function(){
	  $("#other").click(function(){
		    $("#adr_dep").removeAttr("required");
		    $("#adr_arr").removeAttr("required");
		    $('#depart').prop('required',true);
		    $('#arrivee').prop('required',true);

	  });

	  $("#fixed").click(function(){

			    $("#depart").removeAttr("required");
			    $("#arrivee").removeAttr("required");
			    $('#adr_dep').prop('required',true);
			    $('#adr_arr').prop('required',true);

		  });

	});

function displayFixed()
{

	  document.getElementById("adr_dep").selectedIndex = '0';
	  document.getElementById("adr_arr").selectedIndex = '0';

	  document.getElementById('adr_var').style.display = 'none';
	  document.getElementById("divAdr").style.visibility = 'hidden';
	  document.getElementById('adr_other').style.display = 'inline';

}

function displayOther()
{

	  document.getElementById("depart").value = '';
	  document.getElementById("arrivee").value = '';

	  document.getElementById('adr_other').style.display = 'none';
	  document.getElementById('adr_var').style.display = 'inline';

}

</script>


<!-- page specific scripts -->
<script type="text/javascript" charset="utf-8">
    $(function()
      {
		$('.date-pick').datePicker({clickInput:true})
      });
</script>

<script type="text/javascript">
	google.maps.event.addDomListener(window, 'load', initialize3);
	google.maps.event.addDomListener(window, 'load', initialize2);
	google.maps.event.addDomListener(window, 'load', initialize1);
</script>

<script type="text/javascript">

function removeSelected() {
    var x = document.getElementById("adr_dep");
    var arr = document.getElementById("adr_arr");
    var y = document.getElementById("adr_dep").selectedIndex;
    document.getElementById("divAdr").style.visibility = 'visible';

    //document.getElementById("adr_arr").innerHTML = "";
    document.getElementById('adr_arr').options.length=0;

    if (y == 0){
    	document.getElementById("divAdr").style.visibility = 'hidden';
    }else if (y != 1)
	{
		var option = document.createElement("option");
        option.text = x.options[1].value;
        arr.add(option);
	}else
	{
	    var i;
	    var ctn =0;
	    for (i = 0; i < x.length; i++) {
	        if (i != y) {
	           ///alert(ctn);
	            var option = document.createElement("option");
	            option.text = x.options[i].value;
	            arr.add(option);
	            //arr.options[ctn].value = x.options[i].value;
	        	ctn = ctn+1;
	        }
	    }
	}

    //document.getElementById("adr_arr").hide(x.selectedIndex);
}

</script>

</head>
<body class="colorBody">

<?php

$SQL = "SELECT * FROM voitures";
$voitures = Liste ( $SQL, $MyHost, $MyUser, $MyPswd, $MyBase );

$SQL = "SELECT val_fr,val_en FROM time where supp_logic=0";
$heure = Liste ( $SQL, $MyHost, $MyUser, $MyPswd, $MyBase );

$SQL = "SELECT val FROM minute where sup_logic=0";
$minute = Liste ( $SQL, $MyHost, $MyUser, $MyPswd, $MyBase );

$SQL = "SELECT designation FROM fixed_addresse";
$fixed_adresse = Liste ( $SQL, $MyHost, $MyUser, $MyPswd, $MyBase );

$SQL = "SELECT * FROM lieuxfixe";
$lieuxfixe = Liste ( $SQL, $MyHost, $MyUser, $MyPswd, $MyBase );

$SQL = "SELECT * FROM tarifhoraire where validate=1";
$horaire = Liste ( $SQL, $MyHost, $MyUser, $MyPswd, $MyBase );

$SQL = "SELECT * FROM excursion";
$excursion = Liste ( $SQL, $MyHost, $MyUser, $MyPswd, $MyBase );

?>
	<!-- BEGIN SIGN IN FORM -->

	<!-- BEGIN REGISTER FORM -->

	<form id="register-form" action="services/transfert.php" method="post">
		<div class="close"></div>
		<!-- close button of the register form -->
		<ul id="form-section">

			<li><span><?php echo _f("Vehicle * :");?></span> <select
				name="vehicle" required="required" id="vehicle" class="combo">
					<option></option>
							<?php
							for($i = 0; $i < count ( $voitures ); $i ++) {
								$Ligne = $voitures [$i];
								?>

							<option><?php echo $Ligne['designation'];?></option>
							<?php } ?>

					</select></li>
			<div style="clear: both;"></div>
			<p>
				<span class="register-numbering">1</span><span
					class="register-numbering-text"><?php echo _f("Where");?></span>
			</p>
			<div id="adr_other">

				<li><span><label><?php echo _f("Pick-up location * :");?></label></span>
					<select name="adr_dep" required="required" id="adr_dep"
					class="combo" onchange="removeSelected()">
						<option></option>
							<?php
							for($i = 0; $i < count ( $fixed_adresse ); $i ++) {
								$Ligne = $fixed_adresse [$i];
								?>

							<option value='<?php echo $Ligne['designation'];?>'><?php echo $Ligne['designation'];?></option>
							<?php } ?>
							</select></li>
				<div id="divAdr" style="visibility: hidden;">
					<li><span><label><?php echo _f("Destination * :");?></label></span>
						<select name="adr_arr" required="required" id="adr_arr"
						class="combo">

					</select></li>
				</div>
				<li>
					<button name="other" type="button" id="other" class="clsBtn"
						onclick="displayOther();"><?php echo _f("Enter your address");?></button>
				</li>

			</div>
			<div id="adr_var" style="display: none;">
				<li><span><label><?php echo _f("Pick-up location * :");?></label></span>
					<input name="depart" type="text" id="depart"></li>
				<li><span><label><?php echo _f("Destination * :");?></label></span>
					<input name="arrivee" type="text" id="arrivee"></li>
				<li>
					<button name="fixed" type="button" id="fixed" class="clsBtn"
						onclick="displayFixed();"><?php echo _f("Other address");?></button>
				</li>
			</div>

			<p>
				<span class="register-numbering">2</span><span
					class="register-numbering-text"><?php echo _f("When");?></span>
			</p>


			<li><table>
					<tr>
						<td><span><label><?php echo _f("Pick - up * :");?></label></span></td>
						<td><span><label><?php echo _f("Hour(s) * : ");?></label></span></td>
						<td><span><label><?php echo _f("Minute(s) * : ");?></label></span></td>

					</tr>
					<tr>
						<td style="padding-right: 10px;">
							<div>
								<span><input class="date-pick combo clsComboPer"
									style="width: 130px; border-right-width: 10px;" type="text"
									name="date1" id="date1" required="required"></span>
							</div>
						</td>
						<td style="padding-right: 20px;"><span> <select name="heure"
								required="required" id="heure" class="combo"
								style="width: 128px;">
									<option></option>
									<?php
									for($i = 0; $i < count ( $heure ); $i ++) {
										$Ligne = $heure [$i];
										?>
									<?php if ($_SESSION['lang'] == "fr_FR") {?>
									<option><?php echo $Ligne['val_fr'];?></option>
									<?php
										} else {
											?>
									<option><?php echo $Ligne['val_en'];?></option>
									<?php }} ?>
							</select>
						</span></td>
						<td><span> <select name="minute" required="required" id="minute"
								class="combo" style="width: 128px;">
									<option></option>
									<?php
									for($i = 0; $i < count ( $minute ); $i ++) {
										$Ligne = $minute [$i];
										?>

									<option><?php echo $Ligne['val'];?></option>
									<?php } ?>
							</select>
						</span></td>
					</tr>
				</table></li>

			<div style="clear: both;"></div>
			<p>
				<span class="register-numbering">3</span><span
					class="register-numbering-text"><?php echo _f("Other informations");?></span>
			</p>

			<li><table>
					<tr>
						<td><span><label><?php echo _f("Flight or train number :");?></label></span></td>
						<td><span><label><?php echo _f("PRO/TA :");?></label></span></td>

					</tr>
					<tr>
						<td style="padding-right: 30px"><input name="option1" type="text"
							id="option1" style="width: 194px"></td>
						<td><input name="option2" type="text" id="option2"
							style="width: 194px"></td>
					</tr>

				</table></li>
			<li>
			<span><label><?php echo _f("Discount code :");?></label></span>
			<span><input type="text" name="code" id="code"></span>
			</li>
			<p>
				<span class="register-numbering">4</span><span
					class="register-numbering-text"><?php echo _f("Options");?></span>
			</p>
			<li>
				<table>
					<tr>
						<td><span><label style="padding-right: 15px"><?php echo _f("Car seats (baby - booster)");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option3"
							value='<?php echo _f("Car seats (baby - booster)");?>' /></td>
						<td><span><label style="padding-left: 15px; padding-right: 15px;"><?php echo _f("Wheelchairs");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option4" value='<?php echo _f("Wheelchairs");?>' />
						</td>
					</tr>
					<tr>
						<td><span><label style="padding-right: 15px"><?php echo _f("Strollers");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option5" value='<?php echo _f("Strollers");?>' />
						</td>
						<td><span><label style="padding-left: 15px; padding-right: 15px;"><?php echo _f("Pets");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option6" value='<?php echo _f("Pets");?>' /></td>
					</tr>
				</table>
			</li>
			<div style="clear: both;"></div>
			<li>
				<button name="submit" tabindex="11" type="submit"
					id="create-account-submit"><?php echo _f("Get rates");?></button>
			</li>
		</ul>
	</form>
	<!-- END OF REGISTER FORM -->


	<form id="register-form1" action="services/mariage.php" method="post">
		<div class="close"></div>
		<!-- close button of the register form -->
		<ul id="form-section">

			<li><span><?php echo _f("Vehicle * :");?></span> <select
				name="vehicle" required="required" id="vehicle"
				class="combo" disabled="disabled">
					<option></option>
							<?php
							for($i = 0; $i < count ( $voitures ); $i ++) {
								$Ligne = $voitures [$i];
								if ($Ligne['selected'] == "1"){
								?>
								<option selected><?php echo $Ligne['designation'];?></option>
								<?php }else{?>
							<option><?php echo $Ligne['designation'];?></option>
							<?php }} ?>
			</select></li>
			<div style="clear: both;"></div>
			<p>
				<span class="register-numbering">1</span><span
					class="register-numbering-text"><?php echo _f("Where");?></span>
			</p>
			<li><span><?php echo _f("Cities * :");?></span> <span> <select
					name="marLieux" required="required" id="marLieux"
					class="combo">
						<option></option>
							<?php
							for($i = 0; $i < count ( $lieuxfixe ); $i ++) {
								$Ligne = $lieuxfixe [$i];
								?>

							<option value='<?php echo htmlspecialchars($Ligne['designation'],ENT_QUOTES);?>'><?php echo $Ligne['designation'];?></option>
							<?php } ?>
				</select>
			</span></li>
			<p>
				<span class="register-numbering">2</span><span
					class="register-numbering-text"><?php echo _f("When");?></span>
			</p>


			<li><table>
					<tr>
						<td><span><label><?php echo _f("Pick - up * :");?></label></span></td>
						<td><span><label><?php echo _f("Hour(s) * : ");?></label></span></td>
						<td><span><label><?php echo _f("Minute(s) * : ");?></label></span></td>

					</tr>
					<tr>
						<td style="padding-right: 10px;">
							<div>
								<span><input class="date-pick combo clsComboPer"
									style="width: 130px; border-right-width: 10px;" type="text"
									name="date1" id="date1" required="required"></span>
							</div>
						</td>
						<td style="padding-right: 20px;"><span> <select name="heure"
								required="required" id="heure" class="combo"
								style="width: 128px;">
									<option></option>
									<?php
									for($i = 0; $i < count ( $heure ); $i ++) {
										$Ligne = $heure [$i];
										?>
									<?php if ($_SESSION['lang'] == "fr_FR") {?>
									<option><?php echo $Ligne['val_fr'];?></option>
									<?php
										} else {
											?>
									<option><?php echo $Ligne['val_en'];?></option>
									<?php }} ?>
							</select>
						</span></td>
						<td><span> <select name="minute" required="required" id="minute"
								class="combo" style="width: 128px;">
									<option></option>
									<?php
									for($i = 0; $i < count ( $minute ); $i ++) {
										$Ligne = $minute [$i];
										?>

									<option><?php echo $Ligne['val'];?></option>
									<?php } ?>
							</select>
						</span></td>
					</tr>
				</table></li>

			<li><span><?php echo _f("Number of hours * :");?></span> <select
				name="nbHours" required="required" id="nbHours"
				class="combo">
					<option></option>
						<?php
						for($i = 0; $i < count ( $horaire ); $i ++) {
							$Ligne = $horaire [$i];
							?>

						<option><?php echo $Ligne['nbHor'];?></option>
						<?php } ?>
			</select></li>

			<div style="clear: both;"></div>
			<p>
				<span class="register-numbering">3</span><span
					class="register-numbering-text"><?php echo _f("Discount");?></span>
			</p>
			<li>
			<span><label><?php echo _f("Discount code :");?></label></span>
			<span><input type="text" name="code" id="code"></span>
			</li>

			<p>
				<span class="register-numbering">4</span><span
					class="register-numbering-text"><?php echo _f("Options");?></span>
			</p>
			<li>
				<table>
					<tr>
						<td><span><label style="padding-right: 15px"><?php echo _f("Car seats (baby - booster)");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option3"
							value='<?php echo _f("Car seats (baby - booster)");?>' /></td>
						<td><span><label style="padding-left: 15px; padding-right: 15px;"><?php echo _f("Wheelchairs");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option4" value='<?php echo _f("Wheelchairs");?>' />
						</td>
					</tr>
					<tr>
						<td><span><label style="padding-right: 15px"><?php echo _f("Strollers");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option5" value='<?php echo _f("Strollers");?>' />
						</td>
						<td><span><label style="padding-left: 15px; padding-right: 15px;"><?php echo _f("Pets");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option6" value='<?php echo _f("Pets");?>' /></td>
					</tr>
				</table>
			</li>

			<div style="clear: both;"></div>
			<li>
				<button name="submit" tabindex="11" type="submit"
					id="create-account-submit"><?php echo _f("Get rates");?></button>
			</li>
		</ul>
	</form>
	<!-- END OF REGISTER FORM -->

	<form id="register-form2" action="services/excursion.php" method="post">
		<div class="close"></div>
		<!-- close button of the register form -->
		<ul id="form-section">

			<li><span><?php echo _f("Vehicle * :");?></span> <select
				name="vehicle" required="required" id="vehicle"
				class="combo">
					<option></option>
							<?php
							for($i = 0; $i < count ( $voitures ); $i ++) {
								$Ligne = $voitures [$i];
								?>
							<option><?php echo $Ligne['designation'];?></option>
							<?php }?>
			</select></li>
			<div style="clear: both;"></div>
			<p>
				<span class="register-numbering">1</span><span
					class="register-numbering-text"><?php echo _f("Where");?></span>
			</p>
			<li><span><?php echo _f("Cities * :");?></span> <span> <select
					name="marLieux" required="required" id="marLieux"
					class="combo">
						<option></option>
							<?php
							for($i = 0; $i < count ( $excursion ); $i ++) {
								$Ligne = $excursion [$i];
								?>

							<option value='<?php echo $Ligne['lieux'];?>'><?php echo $Ligne['lieux'];?></option>
							<?php } ?>
				</select>
			</span></li>
			<p>
				<span class="register-numbering">2</span><span
					class="register-numbering-text"><?php echo _f("When");?></span>
			</p>


			<li><table>
					<tr>
						<td><span><label><?php echo _f("Pick - up * :");?></label></span></td>
						<td><span><label><?php echo _f("Hour(s) * : ");?></label></span></td>
						<td><span><label><?php echo _f("Minute(s) * : ");?></label></span></td>

					</tr>
					<tr>
						<td style="padding-right: 10px;">
							<div>
								<span><input class="date-pick combo clsComboPer"
									style="width: 130px; border-right-width: 10px;" type="text"
									name="date1" id="date1" required="required"></span>
							</div>
						</td>
						<td style="padding-right: 20px;"><span> <select name="heure"
								required="required" id="heure" class="combo"
								style="width: 128px;">
									<option></option>
									<?php
									for($i = 0; $i < count ( $heure ); $i ++) {
										$Ligne = $heure [$i];
										?>
									<?php if ($_SESSION['lang'] == "fr_FR") {?>
									<option><?php echo $Ligne['val_fr'];?></option>
									<?php
										} else {
											?>
									<option><?php echo $Ligne['val_en'];?></option>
									<?php }} ?>
							</select>
						</span></td>
						<td><span> <select name="minute" required="required" id="minute"
								class="combo" style="width: 128px;">
									<option></option>
									<?php
									for($i = 0; $i < count ( $minute ); $i ++) {
										$Ligne = $minute [$i];
										?>

									<option><?php echo $Ligne['val'];?></option>
									<?php } ?>
							</select>
						</span></td>
					</tr>
				</table></li>
			<div style="clear: both;"></div>
			<p>
				<span class="register-numbering">3</span><span
					class="register-numbering-text"><?php echo _f("Other informations");?></span>
			</p>

			<li>
			<span><label><?php echo _f("Discount code :");?></label></span>
			<span><input type="text" name="code" id="code"></span>
			</li>

			<p>
				<span class="register-numbering">4</span><span
					class="register-numbering-text"><?php echo _f("Options");?></span>
			</p>
			<li>
				<table>
					<tr>
						<td><span><label style="padding-right: 15px"><?php echo _f("Car seats (baby - booster)");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option3"
							value='<?php echo _f("Car seats (baby - booster)");?>' /></td>
						<td><span><label style="padding-left: 15px; padding-right: 15px;"><?php echo _f("Wheelchairs");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option4" value='<?php echo _f("Wheelchairs");?>' />
						</td>
					</tr>
					<tr>
						<td><span><label style="padding-right: 15px"><?php echo _f("Strollers");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option5" value='<?php echo _f("Strollers");?>' />
						</td>
						<td><span><label style="padding-left: 15px; padding-right: 15px;"><?php echo _f("Pets");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option6" value='<?php echo _f("Pets");?>' /></td>
					</tr>
				</table>
			</li>

			<div style="clear: both;"></div>
			<li>
				<button name="submit" tabindex="11" type="submit"
					id="create-account-submit"><?php echo _f("Get rates");?></button>
			</li>

		</ul>
	</form>

	<form id="register-form3" action="services/miseadispo.php" method="post">
		<div class="close"></div>
		<!-- close button of the register form -->
		<ul id="form-section">

			<li><span><?php echo _f("Vehicle * :");?></span> <select
				name="marVoiture" required="required" id="marVoiture"
				class="combo">
					<option></option>
							<?php
							for($i = 0; $i < count ( $voitures ); $i ++) {
								$Ligne = $voitures [$i];
								?>
							<option><?php echo $Ligne['designation'];?></option>
							<?php }?>
			</select></li>

			<div style="clear: both;"></div>
			<p>
				<span class="register-numbering">1</span><span
					class="register-numbering-text"><?php echo _f("Where");?></span>
			</p>
			<li><span><?php echo _f("Pick-up location * :");?></span> <input
				name="departMise" required="required" type="text"
				id="departMise"></li>
			<p>
				<span class="register-numbering">2</span><span
					class="register-numbering-text"><?php echo _f("When");?></span>
			</p>


			<li><table>
					<tr>
						<td><span><label><?php echo _f("Pick - up * :");?></label></span></td>
						<td><span><label><?php echo _f("Hour(s) * : ");?></label></span></td>
						<td><span><label><?php echo _f("Minute(s) * : ");?></label></span></td>

					</tr>
					<tr>
						<td style="padding-right: 10px;">
							<div>
								<span><input class="date-pick combo clsComboPer"
									style="width: 130px; border-right-width: 10px;" type="text"
									name="date1" id="date1" required="required"></span>
							</div>
						</td>
						<td style="padding-right: 20px;"><span> <select name="heure"
								required="required" id="heure" class="combo"
								style="width: 128px;">
									<option></option>
									<?php
									for($i = 0; $i < count ( $heure ); $i ++) {
										$Ligne = $heure [$i];
										?>
									<?php if ($_SESSION['lang'] == "fr_FR") {?>
									<option><?php echo $Ligne['val_fr'];?></option>
									<?php
										} else {
											?>
									<option><?php echo $Ligne['val_en'];?></option>
									<?php }} ?>
							</select>
						</span></td>
						<td><span> <select name="minute" required="required" id="minute"
								class="combo" style="width: 128px;">
									<option></option>
									<?php
									for($i = 0; $i < count ( $minute ); $i ++) {
										$Ligne = $minute [$i];
										?>

									<option><?php echo $Ligne['val'];?></option>
									<?php } ?>
							</select>
						</span></td>
					</tr>
				</table></li>

			<li><span><?php echo _f("Number of hours * :");?></span> <select
				name="nbHours" required="required" id="nbHours"
				class="combo">
					<option></option>
						<?php
						for($i = 0; $i < count ( $horaire ); $i ++) {
							$Ligne = $horaire [$i];
							?>

						<option><?php echo $Ligne['nbHor'];?></option>
						<?php } ?>
			</select></li>

			<div style="clear: both;"></div>
			<p>
				<span class="register-numbering">3</span><span
					class="register-numbering-text"><?php echo _f("Other informations");?></span>
			</p>
			<li>
			<span><label><?php echo _f("Discount code :");?></label></span>
			<span><input type="text" name="code" id="code"></span>
			</li>

			<p>
				<span class="register-numbering">4</span><span
					class="register-numbering-text"><?php echo _f("Options");?></span>
			</p>
			<li>
				<table>
					<tr>
						<td><span><label style="padding-right: 15px"><?php echo _f("Car seats (baby - booster)");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option3"
							value='<?php echo _f("Car seats (baby - booster)");?>' /></td>
						<td><span><label style="padding-left: 15px; padding-right: 15px;"><?php echo _f("Wheelchairs");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option4" value='<?php echo _f("Wheelchairs");?>' />
						</td>
					</tr>
					<tr>
						<td><span><label style="padding-right: 15px"><?php echo _f("Strollers");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option5" value='<?php echo _f("Strollers");?>' />
						</td>
						<td><span><label style="padding-left: 15px; padding-right: 15px;"><?php echo _f("Pets");?></label></span></td>
						<td><INPUT style="width: 15px; height: 15px" type="checkbox"
							name="opt[]" id="option6" value='<?php echo _f("Pets");?>' /></td>
					</tr>
				</table>
			</li>

			<div style="clear: both;"></div>

			<li>
				<button name="submit" tabindex="11" type="submit"
					id="create-account-submit"><?php echo _f("Get rates");?></button>
			</li>
		</ul>
	</form>

	<div id="background-on-popup"></div>
	<!-- END OF REGISTER FORM -->

	<!----start-header----->
	<div class="header">
		<div class="wrap">
			<div class="top-header">
				<div class="logo">
					<a href="index.php"><img src="images/logo.png" width="220"
						title="logo" /></a>
				</div>
				<div class="social-icons">
					<ul>
						<li><a href="index.php"><img name="en" class="en"
								src="images/langues/us.png" title="EN" alt="EN" /></a></li>
						<li><a href="index.php"><img name="fr" class="fr"
								src="images/langues/fr.png" title="FR" alt="FR" /></a></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<!---start-top-nav---->
			<div class="top-nav">
				<div class="top-nav-left">
					<ul>
						<li class="active"><a href="index.php"><?php echo _f("Home"); ?></a></li>
						<li><a href="services.php"><?php echo _f("Services"); ?></a></li>
						<li><a href="tarifs.php"><?php echo _f("Prices"); ?></a></li>
						<li><a href="devis.php"><?php echo _f("Online quote"); ?></a></li>
						<li><a href="contact.php"><?php echo _f("Contact"); ?></a></li>
						<div class="clear"></div>
					</ul>
				</div>

				<div class="clear"></div>
			</div>
			<!---End-top-nav---->
		</div>
	</div>
	<!----End-header----->
	<!--start-image-slider---->

	<div class="slider">
		<div class="camera_wrap" id="camera_wrap_1">

			<div data-src="images/cars3.jpg"></div>
			<div data-src="images/cars4.jpg"></div>
			<div data-src="images/cars5.jpg"></div>
			<div data-src="images/cars8.jpg"></div>

		</div>
		<div class="clear"></div>
	</div>

	<!--End-image-slider---->
	<!---start-content---->
	<div class="content">
		<div class="top-grids">
			<div class="wrap" style="position: absolute; top: 36em; left: 4em;">
				<div class="top-grid" id="register-tab">
					<a href="#"><img src="images/icon1.png" title="icon-name"></a>
					<h3><?php echo _f("Transfer service"); ?></h3>
					<p>Paris Limo Chauffeur Service airport transfer.</p>

				</div>
				<div class="top-grid" id="register-tab1">
					<a href="#"><img src="images/icon2.png" title="icon-name"></a>
					<h3><?php echo _f("Wedding"); ?></h3>
					<p>Paris Limo Chauffeur A car and a driver for your wedding.</p>

				</div>
				<div class="top-grid" id="register-tab2">
					<a href="#"><img src="images/icon2.png" title="icon-name"></a>
					<h3><?php echo _f("Excursions"); ?></h3>
					<p>Paris Limo Chauffeur is also an excursion service.</p>

				</div>
				<div class="top-grid last-topgrid last-topgridEnd"
					id="register-tab3">
					<a href="#"><img src="images/icon3.png" title="icon-name"></a>
					<h3><?php echo _f("Last available"); ?></h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>

				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="mid-grid">
			<div class="wrap">
				<h1><?php echo _f("Welcome to Paris Limo Chauffeur!"); ?></h1>
			</div>
		</div>

	</div>

	<div class="bottom-grids">
		<div class="wrap">
			<div class="bottom-grid1">
				<h3>POPULAR INFO</h3>
				<span>consectetur adipisicing elit, sed do eiusmod tempor</span>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
					eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<ul>
					<li><a href="#">Consectetur adipisicing elit</a></li>
					<li><a href="#">Sed do eiusmod tempor incididunt</a></li>
					<li><a href="#">Labore et dolore magna aliqua.</a></li>
					<li><a href="#">Sed do eiusmod tempor</a></li>
					<li><a href="#">Abore et dolore magna</a></li>
					<li><a href="#">Incididunt ut labore et dolore</a></li>
					<li><a href="#">Dolore magna aliqua</a></li>
					<li><a href="#">Adipisicing elit, sed do eiusmod</a></li>
				</ul>
				<a class="button" href="contact.html">Read More</a>
			</div>
			<div class="bottom-grid2 bottom-mid">
				<h3>Today Special</h3>
				<span>consectetur adipisicing elit, sed do eiusmod tempor</span>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
					eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<div class="gallery">
					<ul>
						<li><a href="images/slider1.jpg"><img src="images/slider1.jpg"
								alt=""></a></li>
						<li><a href="images/slider2.jpg"><img src="images/slider2.jpg"
								alt=""></a></li>
						<li><a href="images/slider3.jpg"><img src="images/slider3.jpg"
								alt=""></a></li>
						<li><a href="images/slider4.jpg"><img src="images/slider4.jpg"
								alt=""></a></li>
						<li><a href="images/slider1.jpg"><img src="images/slider1.jpg"
								alt=""></a></li>
						<li><a href="images/slider2.jpg"><img src="images/slider2.jpg"
								alt=""></a></li>
						<div class="clear"></div>
					</ul>
				</div>
				<a class="button" href="gallery.html">Read More</a>
			</div>
			<div class="bottom-grid1 bottom-last">
				<h3>Latest INFO</h3>
				<span>consectetur adipisicing elit, sed do eiusmod tempor</span>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
					eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
					eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
					eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
					eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<a class="button" href="#">Read More</a>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<!--end-wrap--->
	</div>

	<!---End-content---->
	<!---start-footer---->
	<div class="footer">
		<div class="wrap">
			<div class="footer-grid">

				<br>
				<p align="center">
					<a href="services.php"><?php echo _f("Services"); ?></a>&nbsp; |
					&nbsp; <a href="tarifs.php"><?php echo _f("Prices"); ?></a> &nbsp;
					| &nbsp; <a href="devis.php"><?php echo _f("Online quote"); ?></a>&nbsp;
					| &nbsp; <a href="contact.php"><?php echo _f("Contact"); ?></a>
				</p>
				<br>
				<p align="center">SARL PARIVAC</p>
				<p align="center">110 avenue Marceau</p>
				<p align="center">92400 Courbevoie</p>
				<p align="center">06.24.26.86.86</p>
				<p align="center">
					<A HREF="mailto:conatct@paris-limo-chauffeur.com">conatct@paris-limo-chauffeur.com</A>
				</p>
				<br>

			</div>



			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="copy-right">
		<div class="top-to-page">
			<a href="#top" class="scroll"> </a>
			<div class="clear"></div>
		</div>
		<p>Paris Limo Chauffeur &#xA9 2014</p>
	</div>
	<!---End-footer---->
</body>
</html>

