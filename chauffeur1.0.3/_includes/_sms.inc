<?php

$smsbox_user = 'secone'; // Votre identifiant SMSBOX
$smsbox_pass = 'C%61ple'; // Votre mot de passe SMSBOX

$api_type = 'php'; // Ne pas changer
$api_path = 'https://api.smsbox.fr/api.'.$api_type; // Ne pas changer

$fgc = false; // Pour forcer l'utilisation des sockets, mettre à false

/********************************************************************************************************************/

/* Messages correspondants aux différents retours possibles de l'API */
$description = array('OK' => 'Message envoyé avec succès', 'ERROR 01' => 'Paramètres manquants', 'ERROR 02' => 'Identifiant ou mot de passe incorrect', 'ERROR 03' => 'Crédit insuffisant', 'ERROR 04' => 'Numéro invalide', 'ERROR 05' => 'Erreur d\'éxécution SMSBOX');




function sendSMS($to, $message, $from='SMSBOX', $mode='Expert', $id=false, $date=null, $heure=null)
{
    global $smsbox_user, $smsbox_pass, $api_path, $fgc;

    $query  = $api_path.'?login='.rawurlencode($smsbox_user).'&pass='.rawurlencode($smsbox_pass);
		$query .= '&dest='.rawurlencode($to).'&mode='.rawurlencode($mode).'&origine='.rawurlencode($from);
		$query .= '&msg='.rawurlencode($message).'&udh=1';
    if($id) $query .= '&id=1';
    if(!empty($date) && !empty($heure)) $query .= '&date='.rawurlencode($date).'&heure='.rawurlencode($heure);
    
    if($fgc && strlen($query)>1024) $fgc = false;
    if($fgc) $buffer = @file_get_contents($query);
    else $buffer = use_socket($query);

    return $buffer;
}




function getCredit()
{
    global $smsbox_user, $smsbox_pass, $api_path, $fgc;

    $query = $api_path.'?login='.rawurlencode($smsbox_user).'&pass='.rawurlencode($smsbox_pass).'&action=credit';

     if($fgc) $buffer = @file_get_contents($query);
    else $buffer = use_socket($query);

    return (substr($buffer, 0, 7)==='CREDIT ')? (float)substr($buffer, 7) : '(Erreur survenue)';
}




function use_socket($uri, $port=80, $timeout=10)
{
	$ligne = "";
    $r_uri = parse_url($uri);
    $sock = fsockopen($r_uri['host'], $port, $errno, $errstr, $timeout);
    if($sock)
    {
        fputs($sock, "POST {$r_uri['path']} HTTP/1.1\r\n");
        fputs($sock, "Host: {$r_uri['host']}\r\n");
        fputs($sock, "Content-Type: application/x-www-form-urlencoded\r\n");
        fputs($sock, "Content-Length: ".strlen($r_uri['query'])."\r\n");
        fputs($sock, "Content-Encoding: ISO-8859-15\r\n");
        fputs($sock, "Connection: Close\r\n\r\n");
        fputs($sock, $r_uri['query']);
        $body = false;
        $buffer = null;
        while($ligne = fgets($sock, 1024))
        {
            if($body) $buffer .= $ligne;
            if(!$body && trim($ligne)==='') $body = true;
            if(trim($ligne) == '0') break;
        }
        return $buffer;
    }
    else return false;
}

?> 