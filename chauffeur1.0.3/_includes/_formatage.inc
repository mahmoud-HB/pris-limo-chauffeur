<?php

include ("_login.inc");

function getDistance($depart,$arrivee)
{

		$adresse1 = str_replace(" ", "+", $depart);
		$adresse2 = str_replace(" ", "+", $arrivee);
		$url='http://maps.google.com/maps/api/directions/xml?language=fr&origin='.$adresse1.'&destination='.$adresse2.'&sensor=false';
		$xml=file_get_contents($url);
		if (!strpos($xml,'NOT_FOUND') !== false)
		{
			$root = simplexml_load_string($xml);
			if (!empty($root)){
				$distance=$root->route->leg->distance->value;
				$duree=$root->route->leg->duration->value;
				if ($root->status == "OK")
				{
					return array(
							'distance'=>$distance/1000,
							'duree'=>$duree/60
					);

				}
				else
				{
					return "0";
				}
			}else{
				return "0";
			}
		}else{
			return "0";
		}


}

function getPrixTransfertFix ($ard_dep,$adr_arr,$voiture)
{
	$idDepart = getIdAdresseByCode($ard_dep);
	$idArrivee = getIdAdresseByCode($adr_arr);
	$idVoiture = getIdVoitureByCode($voiture);

	$SQL = "SELECT prix FROM calcultrajetfix where idDepart=$idDepart and idArrivee=$idArrivee and idVoiture=$idVoiture";
	$result = Select ( $SQL, "localhost", "root", "", "luxury" );
	return $result['prix'];

}


function getPrixTransfertFixFinal($ard_dep, $adr_arr, $voiture, $heureDepart, $date,$code){

	$prixDepalcement = getPrixTransfertFix ($ard_dep,$adr_arr,$voiture);

	$isWeekendOrFerier=false;
	$isWeekendOrFerier = isHoliday($date);
	$SQL = "SELECT param,valeur FROM parameters";
	$parameters = Liste ( $SQL, "localhost", "root", "", "luxury" );

	$codeValide = false;
	if (!empty($code)){
		$SQL = "SELECT * FROM codereduction where code='$code' and validate = 1";
		$result = Select ( $SQL, "localhost", "root", "", "luxury" );

		if(!empty($result)){
			$codeValide = true;
			$valeurCode = $result['valeur'];
			$typeCode = $result['type'];
		}
	}

	for($i = 0; $i < count ( $parameters ); $i ++) {
		$Ligne = $parameters [$i];
		$param = $Ligne['param'];

		if ($param == 'jours_ferier')
			$augJoursFerier = $Ligne['valeur'];

		if ($param == 'heure_max')
			$heure_max = $Ligne['valeur'];

		if ($param == 'heure_min')
			$heure_min = $Ligne['valeur'];

		if ($param == 'aug_heure')
			$aug_heure = $Ligne['valeur'];
	}

	if($isWeekendOrFerier)
		$prixDepalcement = $prixDepalcement + (($prixDepalcement * $augJoursFerier)/100);

	if (((intval($heureDepart) >= intval($heure_max)) || (intval($heureDepart) <= intval($heure_min))))
	 	$prixDepalcement = $prixDepalcement + (($prixDepalcement * $aug_heure)/100);

	if($codeValide)
	{
		if ($typeCode == "%")
			$reduction = ($prixDepalcement * $valeurCode)/100;
			$prixDepalcement = $prixDepalcement - $reduction;

		if ($typeCode == "euro")
			$reduction = $valeurCode;
			$prixDepalcement = $prixDepalcement - $reduction;

			return $prixDepalcement."€ le trajet (avec ".$reduction." € de réduction)";
	}
	return $prixDepalcement."€ le trajet";
}

function getIdAdresseByCode($adresse)
{
	$SQL = "SELECT id_addresse FROM fixed_addresse where designation like '%$adresse%'";
	$result = Select ( $SQL, "localhost", "root", "", "luxury" );
	return $result['id_addresse'];
}

function getIdVoitureByCode($voiture)
{
	$SQL = "SELECT id_voiture FROM voitures where designation like '%$voiture%'";
	$result = Select ( $SQL, "localhost", "root", "", "luxury" );
	return $result['id_voiture'];
}

function getPrixTransfert($nbKm, $heureDepart, $date,$code,$vehicle)
{
	$isWeekendOrFerier=false;
	$isWeekendOrFerier = isHoliday($date);

	$SQL = "SELECT param,valeur FROM parameters";
	$parameters = Liste ( $SQL, "localhost", "root", "", "luxury" );

	$codeValide = false;
	if (!empty($code)){
		$SQL = "SELECT * FROM codereduction where code='$code' and validate = 1";
		$result = Select ( $SQL, "localhost", "root", "", "luxury" );

		if(!empty($result)){
			$codeValide = true;
			$valeurCode = $result['valeur'];
			$typeCode = $result['type'];
		}
	}

	for($i = 0; $i < count ( $parameters ); $i ++) {
		$Ligne = $parameters [$i];
		$param = $Ligne['param'];

		if ($param == 'prix_km')
			$prixKm = $Ligne['valeur'];

		if ($param == 'jours_ferier')
			$augJoursFerier = $Ligne['valeur'];

		if ($param == 'heure_max')
			$heure_max = $Ligne['valeur'];

		if ($param == 'heure_min')
			$heure_min = $Ligne['valeur'];

		if ($param == 'aug_heure')
			$aug_heure = $Ligne['valeur'];

		if ($param == 'prix_depart')
			$prix_depart = $Ligne['valeur'];

	}

	$prix='';
	$prix = $nbKm*$prixKm;

	$voitureId = getIdVoitureByCode($vehicle);

	if($isWeekendOrFerier)
		$prix = $prix + (($prix * $augJoursFerier)/100);

	if (((intval($heureDepart) >= intval($heure_max)) || (intval($heureDepart) <= intval($heure_min))))
		$prix = $prix + (($prix * $aug_heure)/100);

	if($codeValide)
	{
		if ($typeCode == "%")
			$reduction = ($prix * $valeurCode)/100;
			$prix = $prix - $reduction;

		if ($typeCode == "euro")
			$reduction = $valeurCode;
			$prix = $prix - $reduction;

		return ($prix + $prix_depart)."€ le trajet (avec ".$reduction." € de réduction)";
	}

	$result = $prix + $prix_depart;
	//Classe S
	if ($voitureId == "2")
		$result = $result*2;

	//Vianno
	if ($voitureId == "3")
		$result = $result*1.18;

	return $result."€ le trajet";


}


function getHolidays($year = null)
{
	  if ($year === null)
        {
                $year = intval(strftime('%Y'));
        }

        $easterDate = easter_date($year);
        $easterDay = date('j', $easterDate);
        $easterMonth = date('n', $easterDate);
        $easterYear = date('Y', $easterDate);

        $holidays = array(
                // Jours feries fixes
                mktime(0, 0, 0, 1, 1, $year),// 1er janvier
                mktime(0, 0, 0, 5, 1, $year),// Fete du travail
                mktime(0, 0, 0, 5, 8, $year),// Victoire des allies
                mktime(0, 0, 0, 7, 14, $year),// Fete nationale
                mktime(0, 0, 0, 8, 15, $year),// Assomption
                mktime(0, 0, 0, 11, 1, $year),// Toussaint
                mktime(0, 0, 0, 11, 11, $year),// Armistice
                mktime(0, 0, 0, 12, 25, $year),// Noel
        		mktime(0, 0, 0, 12, 31, $year),// Noel

                // Jour feries qui dependent de paques
                mktime(0, 0, 0, $easterMonth, $easterDay + 1, $easterYear),// Lundi de paques
                mktime(0, 0, 0, $easterMonth, $easterDay + 39, $easterYear),// Ascension
                mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear), // Pentecote
        );

        sort($holidays);

        return $holidays;

}

//Tester si une date est un jour férié ou un week end
function isHoliday($timestamp)
{
		$myarr = explode('/',$timestamp);
		$mynewdate = $myarr[2].'/'.$myarr[1].'/'.$myarr[0];
		$timestamp = date('Y-m-d',strtotime($mynewdate));

	    $iDayNum = date('N', strtotime($timestamp));
        $iYear = strftime('%Y', strtotime($timestamp));

        $aHolidays = getHolidays($iYear);

        /*
        * On est oblige de convertir les timestamps en string a cause des decalages horaires.
        */
        $aHolidaysString = array_map(function ($value)
        {
                return strftime('%Y-%m-%d', $value);
        }, $aHolidays);

        if (in_array(strftime('%Y-%m-%d', strtotime($timestamp)), $aHolidaysString) OR $iDayNum == 6 OR $iDayNum == 7)
        {
              return true;
        }

        return false;
}



function getPrixMariage ($marLieux, $voiture, $heureDepart, $date,$code,$nbHours){

	$isWeekendOrFerier=false;
	$isWeekendOrFerier = isHoliday($date);
	$SQL = "SELECT param,valeur FROM parameters";
	$parameters = Liste ( $SQL, "localhost", "root", "", "luxury" );

	$codeValide = false;
	if (!empty($code)){
		$SQL = "SELECT * FROM codereduction where code='$code' and validate = 1";
		$result = Select ( $SQL, "localhost", "root", "", "luxury" );

		if(!empty($result)){
			$codeValide = true;
			$valeurCode = $result['valeur'];
			$typeCode = $result['type'];
		}
	}

	for($i = 0; $i < count ( $parameters ); $i ++) {
		$Ligne = $parameters [$i];
		$param = $Ligne['param'];

		if ($param == 'jours_ferier')
			$augJoursFerier = $Ligne['valeur'];

		if ($param == 'heure_max')
			$heure_max = $Ligne['valeur'];

		if ($param == 'heure_min')
			$heure_min = $Ligne['valeur'];

		if ($param == 'aug_heure')
			$aug_heure = $Ligne['valeur'];

		if ($param == 'prix_fixe_mariage')
			$prix_fixe_mariage = $Ligne['valeur'];

		if ($param == 'prix_heure')
			$prix_heure = $Ligne['valeur'];

	}

	$prixDepalcement = $prix_heure * $nbHours;

	if($isWeekendOrFerier)
		$prixDepalcement = $prixDepalcement + (($prixDepalcement * $augJoursFerier)/100);

	if (((intval($heureDepart) >= intval($heure_max)) || (intval($heureDepart) <= intval($heure_min))))
		$prixDepalcement = $prixDepalcement + (($prixDepalcement * $aug_heure)/100);

	if($codeValide)
	{
		if ($typeCode == "%")
			$reduction = ($prixDepalcement * $valeurCode)/100;
		$prixDepalcement = $prixDepalcement - $reduction;

		if ($typeCode == "euro")
			$reduction = $valeurCode;
		$prixDepalcement = $prixDepalcement - $reduction;

		return $prixDepalcement."€ le trajet (avec ".$reduction." € de réduction)";
	}
	return $prixDepalcement."€ le trajet";
}

function getPrixMar ($marLieux,$voiture,$nbHours)
{
	$idDepart = getIdLieuxByCode($marLieux);
	$idVoiture = getIdVoitureByCode($voiture);

	$SQL = "SELECT Prix FROM calcultrajetslieuxfixe where idLieux=$idDepart and idVoiture=$idVoiture";
	$result = Select ( $SQL, "localhost", "root", "", "luxury" );
	return $result['Prix'];

}

function getIdLieuxByCode($adresse)
{
	$adresse = addslashes(addslashes($adresse));

	$SQL = "SELECT idLieux FROM lieuxfixe where designation like '%$adresse%'";
	$result = Select ( $SQL, "localhost", "root", "", "luxury" );
	return $result['idLieux'];
}

function getPrixExcursion($marLieux,$vehicle,$heureDepart,$date,$code)
{
	$isWeekendOrFerier=false;
	$isWeekendOrFerier = isHoliday($date);
	$SQL = "SELECT param,valeur FROM parameters";
	$parameters = Liste ( $SQL, "localhost", "root", "", "luxury" );

	$voitureId = getIdVoitureByCode($vehicle);
	$idDepart = getIdAdresseExcursionByCode($marLieux);

	$SQL = "SELECT prix FROM calcultrajetexcursion where idLieux=$idDepart and idVoiture=$voitureId";
	$result = Select ( $SQL, "localhost", "root", "", "luxury" );
	$prixDepalcement =  $result['prix'];

	$codeValide = false;
	if (!empty($code)){
		$SQL = "SELECT * FROM codereduction where code='$code' and validate = 1";
		$result = Select ( $SQL, "localhost", "root", "", "luxury" );

		if(!empty($result)){
			$codeValide = true;
			$valeurCode = $result['valeur'];
			$typeCode = $result['type'];
		}
	}

	for($i = 0; $i < count ( $parameters ); $i ++) {
		$Ligne = $parameters [$i];
		$param = $Ligne['param'];

		if ($param == 'jours_ferier')
			$augJoursFerier = $Ligne['valeur'];

		if ($param == 'heure_max')
			$heure_max = $Ligne['valeur'];

		if ($param == 'heure_min')
			$heure_min = $Ligne['valeur'];

		if ($param == 'aug_heure')
			$aug_heure = $Ligne['valeur'];

		if ($param == 'prix_fixe_mariage')
			$prix_fixe_mariage = $Ligne['valeur'];

		if ($param == 'prix_heure')
			$prix_heure = $Ligne['valeur'];

	}


	if($isWeekendOrFerier)
		$prixDepalcement = $prixDepalcement + (($prixDepalcement * $augJoursFerier)/100);

	if (((intval($heureDepart) >= intval($heure_max)) || (intval($heureDepart) <= intval($heure_min))))
		$prixDepalcement = $prixDepalcement + (($prixDepalcement * $aug_heure)/100);

	if($codeValide)
	{
		if ($typeCode == "%")
			$reduction = ($prixDepalcement * $valeurCode)/100;
		$prixDepalcement = $prixDepalcement - $reduction;

		if ($typeCode == "euro")
			$reduction = $valeurCode;
		$prixDepalcement = $prixDepalcement - $reduction;

		return $prixDepalcement."€ le trajet (avec ".$reduction." € de réduction)";
	}
	return $prixDepalcement."€ le trajet";
}

function getIdAdresseExcursionByCode($adresse)
{
	$adresse = addslashes(addslashes($adresse));

	$SQL = "SELECT idExcursion FROM excursion where lieux like '%$adresse%'";
	$result = Select ( $SQL, "localhost", "root", "", "luxury" );
	return $result['idExcursion'];
}


function getPrixMiseADispo($distance,$vehicle,$heureDepart,$date,$code,$nbHours)
{
	$isWeekendOrFerier=false;
	$isWeekendOrFerier = isHoliday($date);
	$SQL = "SELECT param,valeur FROM parameters";
	$parameters = Liste ( $SQL, "localhost", "root", "", "luxury" );

	$voitureId = getIdVoitureByCode($vehicle);

	$SQL = "SELECT * FROM parametersmiseadispo where idVoiture = '$voitureId' ";
	$result = Select ( $SQL, "localhost", "root", "", "luxury" );
	$prixHeure = $result['prixHeure'];

	$codeValide = false;
	if (!empty($code)){
		$SQL = "SELECT * FROM codereduction where code='$code' and validate = 1";
		$result = Select ( $SQL, "localhost", "root", "", "luxury" );

		if(!empty($result)){
			$codeValide = true;
			$valeurCode = $result['valeur'];
			$typeCode = $result['type'];
		}
	}

	for($i = 0; $i < count ( $parameters ); $i ++) {
		$Ligne = $parameters [$i];
		$param = $Ligne['param'];

		if ($param == 'jours_ferier')
			$augJoursFerier = $Ligne['valeur'];

		if ($param == 'heure_max')
			$heure_max = $Ligne['valeur'];

		if ($param == 'heure_min')
			$heure_min = $Ligne['valeur'];

		if ($param == 'aug_heure')
			$aug_heure = $Ligne['valeur'];

		if ($param == 'prix_fixe_mariage')
			$prix_fixe_mariage = $Ligne['valeur'];

		if ($param == 'prix_heure')
			$prix_heure = $Ligne['valeur'];

		if ($param == 'prix_km')
			$prix_km = $Ligne['valeur'];

	}


	$prixDepalcement = ($prixHeure * $nbHours) + ($distance * $prix_km) ;

	if($isWeekendOrFerier)
		$prixDepalcement = $prixDepalcement + (($prixDepalcement * $augJoursFerier)/100);

	if (((intval($heureDepart) >= intval($heure_max)) || (intval($heureDepart) <= intval($heure_min))))
		$prixDepalcement = $prixDepalcement + (($prixDepalcement * $aug_heure)/100);

	if($codeValide)
	{
		if ($typeCode == "%")
			$reduction = ($prixDepalcement * $valeurCode)/100;
		$prixDepalcement = $prixDepalcement - $reduction;

		if ($typeCode == "euro")
			$reduction = $valeurCode;
		$prixDepalcement = $prixDepalcement - $reduction;

		return $prixDepalcement."€ le trajet (avec ".$reduction." € de réduction)";
	}
	return $prixDepalcement."€ le trajet";
}

?>
