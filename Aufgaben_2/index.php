<!DOCTYPE html>
<html>
<head>
<title>Title of the document</title>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

<body>

<?php
$row = 0;
$dataArray = array();
$zustandArray = array();
if (($file = fopen("Probeaufgabe_Testdaten.csv","r")) !== FALSE) {
	while(!feof($file)){	
		array_push($dataArray, fgets($file));
		$row++;
	}
    fclose($file);

    for($i=1;$i<count($dataArray);$i++){

		$searchRegex = '/\(([^)]+)\)/';
		$resCount = preg_match_all($searchRegex, $dataArray[$i], $result);

		for($j=0;$j<$resCount;$j++){

		    if(!array_key_exists($result[1][$j], $zustandArray)){
		        $zustandArray = array_merge($zustandArray,array($result[1][$j] => 1));
		    }else{
		        $keyCounter = $zustandArray[$result[1][$j]];
		        $keyCounter += 1;
		        $zustandArray = array_merge($zustandArray,array($result[1][$j] => $keyCounter));
		    }
		}
    }

    echo "List of states and its frequency:</br>";
    foreach ($zustandArray as $k => $v) {
	    echo "$k => $v</br>";
	}
}
?>


</body>

</html>