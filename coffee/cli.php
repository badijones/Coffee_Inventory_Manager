<?php   

/*
Coffee Object.  Contains all functionality

Usage:

# php cli.php 'data.txt'

*/

if(! preg_match('#^([a-z_\s0-9.-]+)+\.(txt|tsv|txt|csv)$#', $argv[1], $matches) ){

	exit("\nfile name valid\n\n");
}else{
$fileToImport = $argv[1];

}



include("Coffee.php");


$cob = new coffeeObj();

if (file_exists($fileToImport)  ) {



$importResult = $cob->getCoffeeData($fileToImport);

echo "Ready to push import up to API:\n";

print_r($importResult);



}else{
echo "test";

}

?>