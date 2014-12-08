<?php
/********************************************************
 *
 *
 ********************************************************/
if (! isset ( $_SESSION )) {
	session_start ();
}
include ("../localization.php");
include ("../_includes/_login.inc");
include ("../_includes/_requetes.inc");
include ("../_includes/_formatage.inc");

$SQL = "SELECT * FROM voitures";
$voitures = Liste ( $SQL, $MyHost, $MyUser, $MyPswd, $MyBase );

for($i = 0; $i < count ( $voitures ); $i ++) {
	$Ligne = $voitures [$i];
	if ($Ligne['selected'] == "1"){
		$vehicle = $Ligne['designation'];
		$_SESSION ['vehicle'] = $vehicle;
	}
}

if (! isset ( $_REQUEST ['marLieux'] )) {
	if ((! isset ( $_SESSION ['marLieux'] )) || (empty ( $_SESSION ['marLieux'] )))
		header ( 'Location: ../index.php' );
	$marLieux = $_SESSION ['marLieux'];
} else {
	$marLieux = $_REQUEST ['marLieux'];
	$_SESSION ['marLieux'] = $marLieux;
}


if (! isset ( $_REQUEST ['nbHours'] )) {
	if ((! isset ( $_SESSION ['nbHours'] )) || (empty ( $_SESSION ['nbHours'] )))
		header ( 'Location: ../index.php' );
	$nbHours = $_SESSION ['nbHours'];
} else {
	$nbHours = $_REQUEST ['nbHours'];
	$_SESSION ['nbHours'] = $nbHours;
}

if (! isset ( $_REQUEST ['date1'] )) {
	if ((! isset ( $_SESSION ['date'] )) || (empty ( $_SESSION ['date'] )))
		header ( 'Location: ../index.php' );
	$date = $_SESSION ['date'];
} else {
	$date = $_REQUEST ['date1'];
	$_SESSION ['date'] = $date;
}

if (! isset ( $_REQUEST ['heure'] )) {
	if ((! isset ( $_SESSION ['heure'] )) || (empty ( $_SESSION ['heure'] )))
		header ( 'Location: ../index.php' );
	$heure = $_SESSION ['heure'];
} else {
	$heure = $_REQUEST ['heure'];
	$_SESSION ['heure'] = $heure;
}

if (! isset ( $_REQUEST ['minute'] )) {
	if ((! isset ( $_SESSION ['minute'] )) || (empty ( $_SESSION ['minute'] )))
		header ( 'Location: ../index.php' );
	$minute = $_SESSION ['minute'];
} else {
	$minute = $_REQUEST ['minute'];
	$_SESSION ['minute'] = $minute;
}

if (! isset ( $_REQUEST ['code'] )) {
	if (isset ( $_SESSION ['code'] )){
			if (empty ( $_SESSION ['code'] )){
				header ( 'Location: ../index.php' );
			}else{
				$code = $_SESSION ['code'];
			}
}
} else {
	$code = $_REQUEST ['code'];
	if (!empty($_REQUEST ['code']))
	{
		$_SESSION ['code'] = $code;
	}else{
		if (isset($_SESSION['code']))
			unset($_SESSION['code']);
	}
}

if (! isset ( $_REQUEST ['opt'] )) {
	if (isset ( $_SESSION ['opt'] )) {
		$opt = $_SESSION ['opt'];
	} else {
		$opt = '';
	}
} else {
	$opt = $_REQUEST ['opt'];
	$_SESSION ['opt'] = $opt;
}

try {
	if (isset($marLieux)) {
		if (!empty($marLieux)){
				if (isset($code)){
					$prix = getPrixMariage ($marLieux,$vehicle,$heure,$date,$code,$nbHours);
				}else{
					$prix = getPrixMariage ($marLieux,$vehicle,$heure,$date,"",$nbHours);
				}
			}
	}else{
		throw new Exception ( 'Une erreur est survenue. Merci de contacter l\'administrateur du site. (Redirection vers la page d\'acceuil dans 5 sec ...)');
	}
} catch ( Exception $e ) {
	echo $e->getMessage (), "\n";
	header('Refresh: 5; ../index.php');
	ob_flush();
}

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Multicusine Website Template | Contact :: W3layouts</title>
<meta charset="ISO-8859-1">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- ========================  CSS Files  ========================== -->
<link rel="stylesheet" href="../css/style.css" type="text/css"
	media="all" />
<link rel="stylesheet" href="../css/map.css" type="text/css" />
<link rel="stylesheet" href="../css/jquery-ui-1.8.12.custom.css"
	type="text/css" />

<!-- ========================  JS Files  =========================== -->
<script type="text/javascript" src="../js/jquery.lang.js"></script>


</head>

<body onload="javascript:calculate()">
	<!----start-header----->
	<div class="header">
		<div class="wrap">
			<div class="top-header">
				<div class="logo">
					<a href="../index.php"><img src="../images/logo.png" width="220"
						title="logo" /></a>
				</div>
				<div class="social-icons">
					<ul>
						<li><a href="transfert.php"><img name="en" class="en"
								src="../images/langues/us.png" title="EN" alt="EN" /></a></li>
						<li><a href="transfert.php"><img name="fr" class="fr"
								src="../images/langues/fr.png" title="FR" alt="FR" /></a></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<!---start-top-nav---->
			<div class="top-nav">
				<div class="top-nav-left">
					<ul>
						<li><a href="../index.php"><?php echo _f("Home"); ?></a></li>
						<li><a href="../services.php"><?php echo _f("Services"); ?></a></li>
						<li><a href="../tarifs.php"><?php echo _f("Prices"); ?></a></li>
						<li><a href="../devis.php"><?php echo _f("Online quote"); ?></a></li>
						<li><a href="../contact.php"><?php echo _f("Contact"); ?></a></li>
						<div class="clear"></div>
					</ul>
				</div>

				<div class="clear"></div>
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
						<br> <br> <br> <br>
						<div class="contact_info"></div>


					</div>
					<div class="col span_2_of_3">
						<div style="margin-left: 30px;">
							<p class="clsDetails"><?php echo _f("Détails de votre réservation :");?></p>
							<br>
							<p class="clsRates"><?php echo $prix;?></p>
							<p class="clsSousTitre"><?php echo _f("Informations trajet :");?></p>
							<ul class="b">
								<li>Véhicule  :  &emsp; <?php echo $vehicle; ?></li>
								<li>Nb heures  :  &emsp; <?php echo $nbHours."h"; ?></li>
								<li>Départ le  :&emsp; <?php echo $date." à ".$heure.":".$minute; ?> </li>
							</ul>
						</div>
						<div style="margin-left: 30px;">
							<br>

				</div>
						<div style="margin-left: 30px;">
							<br>
					<?php if (!empty($opt)) {?>
					<p class="clsSousTitre"><?php echo _f("Options :");?></p>
							<ul class="b">
					<?php
						foreach ( $opt as $selected ) {
							?>
								<li><?php echo $selected; ?></li>
								<?php }?>
					</ul>
					<?php }?>
				</div>
						<br>

						<div style="margin-left: 30px;">
							<div class="contact-form">
								<form method="post" action="contact-post.html">

									<div class="clsTR">
										<span><label><?php echo _f("Title * :");?></label></span> <span><span><select
												name="title" required="required" id="title" class="Clscombo">
													<option></option>
													<option><?php echo _f("Miss");?></option>
													<option><?php echo _f("Mrs.");?></option>
													<option><?php echo _f("Mr.");?></option>
											</select></span>

									</div>

									<div>
										<table>
											<tr class="clsTR">
												<td><span><label><?php echo _f("Last name * : ");?></label></span></td>
												<td><span><label><?php echo _f("First name * : ");?></label></span></td>

											</tr>
											<tr class="clsTR">
												<td style="padding-right: 5px"><span><input
														style="width: 277px;" name="data[devis][Lastname]"
														required="required" type="text" id="DevisLastName"></span></td>
												<td><span><input style="width: 277px;"
														name="data[devis][Firstname]" required="required"
														type="text" id="DevisFirstName"></span></td>

											</tr>
										</table>

									</div>

									<div class="clsTR">
										<span><label><?php echo _f("Company :");?></label></span> <span><input
											name="data[devis][Company]" type="text" id="DevisCompany"></span>
									</div>
									<div class="clsTR">
										<span><label><?php echo _f("Addresse * :");?></label></span>
										<span><input name="DevisPassenger" type="text" pattern="[1-7]"
											title=<?php echo _f('"Number of passengers must be between 1 and 7"'); ?>
											required class="textbox"></span>
									</div>

									<div class="clsTR">
										<span><label><?php echo _f("Email * : ");?></label></span> <span><input
											name="data[Contact][mail]" placeholder="email@domain.com"
											required="required" type="email" id="ContactMail"
											style="width: 590px; height: 24px;"></span>
									</div>
									<div class="clsTR">
										<span><label><?php echo _f("Phone number * : ");?></label></span>
										<span><input name="userPhone" type="text" pattern="\d{10}"
											title=<?php echo _f('"Incorrect phone number"'); ?> required
											class="textbox"></span>
									</div>
									<div>
										<span><input type="submit" class="mybutton"
											style="width: 590px;" value=<?php echo _f('"Send"');?>></span>
									</div>
								</form>

							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Include Javascript -->
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript"
		src="../js/jquery-ui-1.8.12.custom.min.js"></script>
	<script type="text/javascript"
		src="http://maps.google.com/maps/api/js?sensor=false&language=fr"></script>
	<script type="text/javascript" src="../js/functions.js"></script>

	<!---End-contact---->
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

