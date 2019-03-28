<?php
/*
Main View file.  

- Use "View" and "File Import" links to either view existing items or import a new file

- TSV shoud have 6 fields

- to import via CLI, use cli.php and pass the filename as the argument. 
Usage:
	# php cli.php 'data.txt'

*/
include("Coffee.php");

$cob = new coffeeObj();

if($_REQUEST['t'] === 'import'){
$pageForm.= <<< THIS_PAG0
<form action="" method="post" enctype="multipart/form-data">

<b>Browse</b><br>
<label for="file">Filename:</label>
<input type="file" name="file" id="file" size=80/>
<br>
<br>

<input type="submit" name="submit" value="Submit" />
</form>
THIS_PAG0;

}

if($_REQUEST['t'] === 'import' && $_POST && $_FILES){

$importResult = $cob->importData($_FILES);

$fullPage = '<h1>Upload Successful: Ready to push import up to API</h1>';

	foreach($importResult as $job){

	
$fullPage.=  <<< THIS_PAG0
<ul class="list-group">
	<li class="list-group-item active"><b>id:</b> {$job['id']}</li>
	<li class="list-group-item"><b>name:</b> {$job['name']}</li>
	<li class="list-group-item"><b>size:</b> {$job['size']}</li>
	<li class="list-group-item"><b>syrup:</b> {$job['syrup']}</li>
	<li class="list-group-item"><b>sugar:</b> {$job['sugar']}</li>
	<li class="list-group-item"><b>milk:</b> {$job['milk']}</li>
</ul>
THIS_PAG0;

$pageForm = '';

	}


}else if($_REQUEST['t']==='view'){

$jsonObj = $cob->coffeeRequest('Badi+Jones');

$fullPage = '<span id=topoflist><h1>Available Coffee</h1></span>';


if(trim($jsonObj['is_success']) === '1'){
	foreach($jsonObj['data'] as $job){

// we don't need the form here
$pageForm = '';
$ajaxSection = <<< ENDAJAX
<script>
$.ajax({
    type: 'GET', 
    url: 'https://developer-test.engagednation.com/api/coffee/types/Badi Jones', 
    data: { get_param: 'value' }, 
    dataType: 'json',
    success: function (data) { 

    	$('#topoflist').html('<h1>Existing Items</h1>');
    	
        $.each(data.data, function(index, element) {
           
var coffeelist = '<ul class="list-group topoflist"><li class="list-group-item active"><b>id:</b> ' + element.id + '</li><li class="list-group-item"><b>name:</b> ' + element.name + '</li><li class="list-group-item"><b>size:</b> ' + element.size + '</li><li class="list-group-item"><b>syrup:</b> ' + element.syrup + '</li><li class="list-group-item"><b>sugar:</b> ' + element.sugar + '</li><li class="list-group-item"><b>milk:</b> ' + element.milk + '</li></ul>';           
           
            $('body').append(coffeelist);
            
        });
    }
});

</script>
ENDAJAX;

	}
	
	
	
}else{

$fullPage = "";
}



}

?><!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<a href=?t=view>View Existing Coffee</a> | <a href=?t=import>Import Coffee TSV</a>
    <title>Coffee Inventory!</title>
</head>
<body>


<?=$pageForm?>

<?=$fullPage?>

<hr>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



<?=$ajaxSection ?>

</body>
</html>