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
$invalidStr = "";

if (($file = fopen("Probeaufgabe_Testdaten.csv","r")) !== FALSE) {
	while(!feof($file)){
		array_push($dataArray, fgets($file));
	}
    fclose($file);

    print("Invalid line: </br>");

    $invalidStr .= $dataArray[0];
    for($i=1;$i<count($dataArray)-1;$i++){
		$dataCol = explode(";", $dataArray[$i]);
		preg_match_all('!\d+!', $dataCol[2], $cond);
		preg_match_all('!\d+!', $dataCol[3], $vat);

		if($cond[0][0]==0){
			if($vat[0][0]!=0){
				$pattern = '!\d+!';
				$dataCol[3] = preg_replace($pattern, "0", $dataCol[3]);
				$invalidStr .= implode($dataCol,";");
				print(implode($dataCol,";")."</br>");
			}
		}
		elseif ($cond[0][0]==1) {
			if($vat[0][0]!=2){
				$pattern = '!\d+!';
				$dataCol[3] = preg_replace($pattern, "2", $dataCol[3]);
				$invalidStr .= implode($dataCol,";");
				print(implode($dataCol,";")."</br>");
			}
		}
    }

    file_put_contents("invalidLine.csv", $invalidStr);
}
?>


</body>

</html>