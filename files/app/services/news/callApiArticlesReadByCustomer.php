<?php
ini_set('display_errors', '1');
include_once('../../../../../files/config.php');

function articlesReadByCustomer($annee) {
	global $token_security;
// echo "articlesReadByCustomer()";
//Initialize cURL.
$ch = curl_init();

//Set the URL that you want to GET by using the CURLOPT_URL option.
curl_setopt($ch, CURLOPT_URL, 'http://localhost:81/API_JSON_PHP/stats/articles/read/byCustomer.php');

//Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

$valueJson = json_encode(array('token' => $token_security, 'annee' => $annee));

//Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, array('token' => $token_security, 'annee' => $annee));
curl_setopt($ch, CURLOPT_POSTFIELDS, $valueJson);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

//Execute the request.
$data = curl_exec($ch);

//Close the cURL handle.
curl_close($ch);
$json =  json_decode($data, true);
// var_dump($data);



$resultstr = "[";
$resultabscisse = "[";


$next = false;
$i=0;
$count = count($json["results"]); // count compte en plus l'élément tableau (tout ce qu'il y a dedans)
// echo "count :";
// echo count($json["results"]);
// echo '<br>';
		while ($i<$count){
				if ($next) { $resultstr .= ","; $resultabscisse .= ","; }
				else { $next=true; }

			    $resultabscisse.="\"" . $json["results"][$i]["customer"] . "\"";
					$resultstr.=$json["results"][$i]["nb"];
				$i++;
		}

		$resultstr .= "]";
		$resultabscisse .= "]";

		return array("nb"=>$resultstr,"customer"=>$resultabscisse);

}

function articlesReadByCustomerStats($annee) {
	global $token_security;
// echo "articlesReadByCustomerStats()";
//Initialize cURL.
$ch = curl_init();

//Set the URL that you want to GET by using the CURLOPT_URL option.
curl_setopt($ch, CURLOPT_URL, 'http://localhost:81/API_JSON_PHP/stats/articles/read/byCustomerStats.php');

//Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

$valueJson = json_encode(array('token' => $token_security, 'annee' => $annee));

//Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, array('token' => $token_security, 'annee' => $annee));
curl_setopt($ch, CURLOPT_POSTFIELDS, $valueJson);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));


//Execute the request.
$data = curl_exec($ch);

//Close the cURL handle.
curl_close($ch);
$json =  json_decode($data, true);
// var_dump($data);

		// return array("nb"=>$resultstr,"customer"=>$resultabscisse);
		return $json["results"];

}

?>
