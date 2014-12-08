<?php
/* Générateur de GUID */
function generateCharacter ()
{
$possible = "123456789ABCDEFGHJKLMNPQRTUVWXYZ";
$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
return $char;
}

function generateNum ()
{
$possible = "1234567890";
$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
return $char;
}

function generateGUID ($NbID) //NbID = Le Nombre de Digid de l'ID (ex: 16 = GUID 16Digit, ...)
{
$GUID = "";
for ($i=1; $i<=$NbID; $i++)
{$GUID .= generateCharacter();}
return $GUID;
}

function generateCLT ($NbID) //NbID = Le Nombre de Digid de l'ID (ex: 16 = GUID 16Digit, ...)
{
$GUID = "CLT";
for ($i=1; $i<=$NbID; $i++)
{$GUID .= generateNum();}
return $GUID;
}

function generateCS ($NbID) //NbID = Le Nombre de Digid de l'ID (ex: 16 = GUID 16Digit, ...)
{
$GUID = "CS";
for ($i=1; $i<=$NbID; $i++)
{$GUID .= generateNum();}
return $GUID;
}

function generateLIC ($NbID) //NbID = Le Nombre de Digid de l'ID (ex: 16 = GUID 16Digit, ...)
{
$GUID = "LIC";
for ($i=1; $i<=$NbID; $i++)
{$GUID .= generateNum();}
return $GUID;
}

?>


