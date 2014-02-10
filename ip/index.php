
<?php


require_once('geoplugin.class.php');

$c=254;

$geoplugin = new geoPlugin();

//locate the IP
$geoplugin->locate();

echo "Geolocation results for {$geoplugin->ip}: <br />\n".
	"Country Name: {$geoplugin->countryName} <br />\n".
	"Country Code: {$geoplugin->countryCode} <br />\n";

if ( $geoplugin->currency != $geoplugin->currencyCode ) {
	echo "<p>At todays rate, US$".$c." will cost of " . $geoplugin->convert($c) ." </p>\n";
}
echo "<title>{$geoplugin->ip} | {$geoplugin->countryName}</title>";
?>
