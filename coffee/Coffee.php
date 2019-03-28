<?php   


/*
Coffee Object.  Contains all functionality

*/
class coffeeObj {


function getCoffeeData($tempfile){
$newCoffeeArray = array();
$cct = 0;

//Open import - begin consolidation loop:
$fp = fopen($tempfile,'r') or die ("can't open file");
	while ($s = fgets($fp,1024)) {
	
	if( preg_match('#^([^\n\r\t]*)\t([^\n\r\t]*)\t([^\n\r\t]*)\t([^\n\r\t]*)\t([^\n\r\t]*)\t([^\n\r\t]*)$#', $s, $matches) ){
	
	
	$confields = explode("\t",$s);

	
	if(sizeof($confields) === 6){



	$coffee_id = trim($confields[0]);


		$newCoffeeArray[$cct]["id"] = $confields[0];
		$newCoffeeArray[$cct]["name"] = $confields[1];
		$newCoffeeArray[$cct]["size"] = $confields[2];
		$newCoffeeArray[$cct]["syrup"] = $confields[3];
		$newCoffeeArray[$cct]["sugar"] = $confields[4];
		$newCoffeeArray[$cct]["milk"] = $confields[5];

		$cct ++;

	
	}
	
	

	}else{
	
				echo "no match";

	}

}
fclose($fp) or die("can't close file");

return $newCoffeeArray;;


}





function importData($files){


$newCoffeeArray = array();
$cct = 0;


$uploadedFileName = $files["file"]["name"];
$uploadedFileType = $files["file"]["type"];
$uploadedFileSize = $files["file"]["size"];
$uploadedFileTmp = $files["file"]["tmp_name"];
$uploadedFileError = $files["file"]["error"];


	if (  ($uploadedFileType == "text/plain") ||  ($uploadedFileType == "text/csv")
	|| ($uploadedFileType == "application/octet-stream")){


		if ($uploadedFileError > 0){
			echo "Return Code: " . $uploadedFileError . "<br />";
		}else{


		
			echo "<b>Upload:</b> " . $uploadedFileName . "<br />";
			//echo "Type: " . $uploadedFileType . "<br />";
			echo "Size: " . ($uploadedFileSize / 1024) . " Kb<br />";
			//echo "Temp file: " . $uploadedFileTmp . "<br />";
	
	

//Open import - begin consolidation loop:
$fp = fopen($uploadedFileTmp,'r') or die ("can't open file");
	while ($s = fgets($fp,1024)) {
	
	if( preg_match('#^([^\n\r\t]*)\t([^\n\r\t]*)\t([^\n\r\t]*)\t([^\n\r\t]*)\t([^\n\r\t]*)\t([^\n\r\t]*)$#', $s, $matches) ){
	
	
	$confields = explode("\t",$s);

	
	if(sizeof($confields) === 6){



	$coffee_id = trim($confields[0]);


		$newCoffeeArray[$cct]["id"] = $confields[0];
		$newCoffeeArray[$cct]["name"] = $confields[1];
		$newCoffeeArray[$cct]["size"] = $confields[2];
		$newCoffeeArray[$cct]["syrup"] = $confields[3];
		$newCoffeeArray[$cct]["sugar"] = $confields[4];
		$newCoffeeArray[$cct]["milk"] = $confields[5];

		$cct ++;

	
	}
	
	
	
	
	}else{
	
				echo "no match";

	}
		

		



}

return $newCoffeeArray;;





fclose($fp) or die("can't close file");



/* end else */
		  
		}
		
		
/* end valid file */
	  }else{
	  echo "Invalid file";
	  print_r($files);
	  }
  
  
  


}


function coffeeRequest($addOnQuery){

	$host = 'http://developer-test.engagednation.com';

	// build path
	$applicantName = 'Badi%20Jones';

	$path = "/api/coffee/types/{$applicantName}";
	
	// initiate curl
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $host . $path );
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept:application/json'));
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($ch);
	$headers = curl_getinfo($ch);

	// close curl
	curl_close($ch);

	// return XML data
	if ($headers['http_code'] != '200') {
	 echo "An error has occurred.";
	 print_r($headers);
	return false;
	} else {


 return json_decode($data,true);

	}

}









}


