<?php

// Fonction de requete SQL.
function Select($Req, $Server, $User, $Pwd, $Base)
{

	$Link = mysqli_connect($Server, $User, $Pwd, $Base);
	mysqli_query($Link,"SET NAMES UTF8");
	if (!$Link) {echo "Err-000//connexion impossible    #    ";} else
	{	//La connexion a MYSQL est OK.
		$Dbase = mysqli_select_db($Link, $Base);
		$Datas = mysqli_query($Link, $Req);
		if (!$Datas) {echo "Err-FFF//La requete comporte une erreur/SQL=[{$Req}]    #    ";} else
		{ // La requete a ete executee avec succes, on retourne la premiere ligne.
			$Reponse = mysqli_fetch_array($Datas, MYSQL_ASSOC);
			mysqli_free_result($Datas);
		}
		mysqli_close($Link);
	}
	return $Reponse;
}



function Liste($Req, $Server, $User, $Pwd, $Base)
{

	$Link = mysqli_connect($Server, $User, $Pwd, $Base);
	mysqli_query($Link,"SET NAMES UTF8");
	if (!$Link) {echo "Err-000//connexion impossible    #    ";} else
	{	//La connexion a MYSQL est OK.
		$Dbase = mysqli_select_db($Link, $Base);
		$Datas = mysqli_query($Link, $Req);
		if (!$Datas) {echo "Err-FFF//La requete comporte une erreur/SQL=[{$Req}]    #    ";} else
		{ // La requete a ete executee avec succes, on retourne un tableau avec toutes les lignes.
			while ($row = mysqli_fetch_array($Datas, MYSQL_ASSOC))
			{
				$Reponse[] = $row;
			}
			mysqli_free_result($Datas);
		}
		mysqli_close($Link);
	}
	return $Reponse;
}



function Insert($Req, $Server, $User, $Pwd, $Base)
{
	$Link = mysql_connect($Server, $User, $Pwd);
	if (!$Link)
	{
		echo "Err-000//connexion impossible    #    ";
		$Reponse = "Err-000//Pas de connexion DB";
	}
	else
	{	//La connexion a MYSQL est OK.
		$Dbase = mysql_select_db($Base, $Link);
		$Datas = mysql_query($Req, $Link);
		if (!$Datas)
		{
			echo "Err-FFF//La requete comporte une erreur/SQL=[{$Req}]    #    ";
			$Reponse = "Err-FFF//La requete comporte une erreur/SQL=[{$Req}]    #    ";
		}
		else
		{ // La requete a ete executee avec succes.
			$Reponse = "Ok";
		}
		mysql_close($Link);
	}
	return $Reponse;
}



function Update($Req, $Server, $User, $Pwd, $Base)
{
	$Link = mysql_connect($Server, $User, $Pwd);
	if (!$Link)
	{
		echo "Err-000//connexion impossible    #    ";
		$Reponse = "Err-000//connexion impossible    #    ";
	}
	else
	{	//La connexion a MYSQL est OK.
		$Dbase = mysql_select_db($Base, $Link);
		$Datas = mysql_query($Req, $Link);
		if (!$Datas)
		{
			echo "Err-FFF//La requete comporte une erreur/SQL=[{$Req}]    #    ";
			$Reponse = "Err-FFF//La requete comporte une erreur/SQL=[{$Req}]    #    ";
		}
		else
		{ // La requete a ete executee avec succes.
			$Reponse = "Ok";
		}
		mysql_close($Link);
	}
	return $Reponse;
}

function Delete($Req, $Server, $User, $Pwd, $Base)
{
	$Link = mysql_connect($Server, $User, $Pwd);
	if (!$Link)
	{
		echo "Err-000//connexion impossible    #    ";
		$Reponse = "Err-000//connexion impossible    #    ";
	}
	else
	{	//La connexion a MYSQL est OK.
		$Dbase = mysql_select_db($Base, $Link);
		$Datas = mysql_query($Req, $Link);
		if (!$Datas)
		{
			echo "Err-FFF//La requete comporte une erreur/SQL=[{$Req}]    #    ";
			$Reponse = "Err-FFF//La requete comporte une erreur/SQL=[{$Req}]    #    ";
		}
		else
		{ // La requete a ete executee avec succes.
			$Reponse = "Ok";
		}
		mysql_close($Link);
	}
	return $Reponse;
}

?>