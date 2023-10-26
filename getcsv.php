<?php

function csvToJson($csvPath) {
    $csvData = [];

    if (($handle = fopen($csvPath, 'r')) !== false) {
        while (($row = fgetcsv($handle)) !== false) {
            $csvData[] = $row;
        }
        fclose($handle);
    }

    // Assuming the first row of the CSV contains the column headers
    $headers = array_shift($csvData);

    $jsonArray = [];

    foreach ($csvData as $row) {
        $jsonArrayItem = [];
        for ($i = 0; $i < count($row); $i++) {
            $jsonArrayItem[$headers[$i]] = $row[$i];
        }
        $jsonArray[] = $jsonArrayItem;
    }

    return json_encode($jsonArray);
}

// Path to your local CSV file
$csvPath = 'C:/CODING/SMT5/Alpro2/UTS/coba/datapribadi.csv';

$jsonData = csvToJson($csvPath);

// Set the content type to JSON
header('Content-Type: application/json');

// Output the JSON data
echo $jsonData;
?>
