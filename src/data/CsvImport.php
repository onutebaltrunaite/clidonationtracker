<?php

class CsvImport
{

    function importCharitiesFromCsv($filename)
    {
        $charitydao = new CharityDAO();

        // Open the file
        $file = fopen($filename, 'r');

        // Check if the file opened successfully
        if (!$file) {
            echo "Error: Unable to open the file.\n";
            return;
        }

        // Read and discard the first line (csv headers)
        fgetcsv($file);

        // Read the file line by line
        while (($line = fgetcsv($file)) !== FALSE) {

            $charity = new Charity($line[0], $line[1], null);
            $charitydao->addCharity($charity);
        }

        // Close the file
        fclose($file);
    }
}
