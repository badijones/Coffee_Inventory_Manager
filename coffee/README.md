# Coffee Inventory Manager


## Coffee.php

Coffee object that can be used to ingest a TSV file of available coffee types into the API


**getCoffeeData():** Opens and reads coffee data in TSV format
```bash
$coffeeObj->getCoffeeData($tempfile);
```

**importData():** Handles uploaded TSV files using the $_FILES variable
```bash
$coffeeObj->importData($files);
```
**coffeeRequest():** Handles the connection to our coffee API CRUD service.

```bash
$coffeeObj->coffeeRequest($addOnQuery);
```


## Usage

```php
include("Coffee.php");
$coffeeObj = new coffeeObj();

$currentInventory = $coffeeObj->coffeeRequest($addOnQuery);

print_r($currentInventory);
```