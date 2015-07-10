<?php

$url = "http://currencies.apps.grandtrunk.net/getrange/2015-06-01/2015-06-30/usd/tzs";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$curl_odgovor = curl_exec($curl);
 
$string_odgovor = str_replace("\n"," ",$curl_odgovor);
$string_sredjen = trim($string_odgovor);

$niz=explode(" ",$string_sredjen);

curl_close($curl);
$string_json = "{ 
  \"cols\": [ 
    {\"label\":\"Date\",\"type\":\"date\"}, 
    {\"label\":\"Value\",\"type\":\"number\"} 
  ], 
  \"rows\": [ 
";
///goes trough array and makes json file
$b = count($niz);
for ($i=0; $i<=$b-2;$i=$i+2){
	
	///For presentation it sub one month from date
	$d = new DateTime($niz[$i]);
	$interval = new DateInterval('P1M');
    $d->sub($interval);
	
	///formating for presentatio
$timestamp = $d->format('Y,n,d'); 
            

$string_json .="{\"c\":[{\"v\":\"Date(";
$string_json .=$timestamp;

$string_json .=")\"},{\"v\":";
$string_json .=$niz[$i+1];
$string_json .="}]},";
}
$string_json=substr($string_json,0,strlen($string_json)-1);
$string_json .="] 
}";
echo $string_json;
///$fajl = fopen('podaci.json', 'w');
///fwrite($fajl, $string_json);
///fclose($fajl);

?>
