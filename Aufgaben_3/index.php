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
$newCsvString = "";
if (($file = fopen("Probeaufgabe_Testdaten.csv","r")) !== FALSE) {
	while(!feof($file)){	
		array_push($dataArray, fgets($file));
		$row++;
	}
    fclose($file);

    for($i=0;$i<count($dataArray);$i++){

		$searchRegex = '/\(([^)]+)\)/';
		$resCount = preg_match_all($searchRegex, $dataArray[$i], $result);

		if($i==0){
			$newCsvString .= $dataArray[$i];
		}

		for($j=0;$j<$resCount;$j++){

		    if(preg_match('/\\bmodul mit anleitung\\b/i', $result[1][$j])){
		        $newCsvString .= str_ireplace("modul mit anleitung","Modul mit Anl.", $dataArray[$i]);
		        break;
		    }elseif(preg_match('/\\bnur modul\\b/i', $result[1][$j])){
		        $newCsvString .= str_ireplace("nur modul","Modul", $dataArray[$i]);
		        break;
		    }else{
		    	$newCsvString .= $dataArray[$i];
		    	break;
		    }
		}
    }

    print("Zustaende geaendert!");
    file_put_contents("result.csv", $newCsvString);
}
?>


</body>

</html>