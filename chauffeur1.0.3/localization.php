<?php

// define constants
define('DEFAULT_LOCALE', 'fr_FR');

if(!isset($_SESSION))
{
	session_start();
}

if(isset($_SESSION))
{
	if (!isset($_SESSION['lang']))
	{
		$_SESSION['lang'] = DEFAULT_LOCALE;
	}

}

require_once("lib/streams.php");
require_once("lib/gettext.php");

$locale_lang = $_SESSION['lang'];
$locale_file = new FileReader("locale/$locale_lang/LC_MESSAGES/messages.mo");
$locale_fetch = new gettext_reader($locale_file);

	function _f($text)
	{
		global $locale_fetch;
		return $locale_fetch->translate($text);
	}

?>