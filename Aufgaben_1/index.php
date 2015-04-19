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
if (($file = fopen("Probeaufgabe_Testdaten.csv","r")) !== FALSE) {
	while(!feof($file)){
		if($row>0){	
			array_push($dataArray, fgets($file));
		}
		$row++;
	}
    fclose($file);

    echo "Number of data line: ".(count($dataArray)-1)."</br>";
    for($i=0;$i<10;$i++){
    	print($dataArray[rand(1,count($dataArray))]);
    	print("</br>");
    }
}
?>


</body>

</html>