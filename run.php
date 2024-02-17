<?php
include '.\src\data\DB.php';
include '.\src\cli\Menu.php';
include '.\src\data\CsvImport.php';
include '.\src\data\TestData.php';

//Create database, if not exists
$db = new DB();
$db->getConnection();
if ($db->selectDB() == false) {
    $db->createDatabase();
}


//Populate with test data, if they don't already exist
$testData = new TestData();
$testData->populateTestData();

$db->closeConn();

//Check if csv path is provided as argument
if ($argc > 1) {
    $csvFile = $argv[1];
    echo "Path to csv file detected. Starting to import Charities to the database... \n";
    $csvImport = new CsvImport();
    $csvImport->importCharitiesFromCsv($csvFile);
}

//Show the main menu
$mn = new Menu();
$mn->mainMenu();
