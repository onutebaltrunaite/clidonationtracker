<?php

include 'src\dao\CharityDAO.php';
include 'src\dao\DonationDAO.php';
include 'src\validations\Validations.php';
class Menu
{
    private $charitydao;
    private $donationdao;

    public function mainMenu()
    {
        $this->charitydao = new CharityDAO();
        $this->donationdao = new DonationDAO();

        while (true) {
            echo "------------------\n";
            echo "CLI MENU\n";
            echo "------------------\n";
            echo "1. View Charities\n";
            echo "2. Add Charity\n";
            echo "3. Edit Charity\n";
            echo "4. Delete Charity\n";
            echo "5. Add Donations\n";
            echo "6. Import Charities from .csv file \n";
            echo "7. Exit\n";
            echo "------------------\n";
            echo "Enter your choice: ";
            $handle = fopen("php://stdin", "r");
            $line = fgets($handle);
            switch (trim($line)) {
                case '1':
                    echo "You chose to View Charities (1).\n";
                    $this->charitydao->printCharities();
                    break;
                case '2':
                    echo "You chose to Add Charity (2).\n";
                    $name = $this->askName("Enter the name of the charity: \n");
                    $representative_email = $this->askEmail();

                    if (!Validations::charityNameAlreadyExists($name)) {
                        $charity = new Charity($name, $representative_email, null);
                        $this->charitydao->addCharity($charity);
                    } else {
                        echo "Charity already exists. Cannot be added.";
                    }

                    break;
                case '3':
                    echo "You chose to Edit Charity (3).\n";
                    $this->charitydao->printCharities();
                    $id = $this->askId("Choose one of the charities above to edit: \n");
                    $name = $this->askName("Enter new name of the charity: \n");
                    $representative_email = $this->askEmail();
                    if (!Validations::charityNameAlreadyExists($name)) {
                        $charity = new Charity($name, $representative_email, null);
                        $this->charitydao->editCharity($id, $charity);
                    } else {
                        echo "Charity name already exists. Cannot be updated.";
                    }

                    break;
                case '4':
                    echo "You chose to Delete Charity (4).\n";
                    $this->charitydao->printCharities();
                    $id = $this->askId("Choose one of the charities above to delete: \n");
                    $this->charitydao->deleteCharity($id);
                    break;
                case '5':
                    echo "You chose to Add Donation (5).\n";
                    $this->charitydao->printCharities();
                    $charity_id = $this->askId("Choose the id of one of the above charities to donate to. \n ");
                    $donor_name = $this->askName("Enter the donor name: \n");
                    $amount = $this->askAmount("Enter the amount you want to donate: \n");
                    $donation = new Donation($donor_name, $amount, $charity_id, null, null);
                    $this->donationdao->addDonation($donation);
                    break;
                case '6':
                    echo "You chose to Import Charities from .csv file (6).\n";
                    $path = $this->askCsvPath();
                    $csv = new CsvImport();
                    $csv->importCharitiesFromCsv($path);
                    break;
                case '7':
                    echo "Exit program (7).\n";
                    exit;
                default:
                    echo "Invalid option. Please choose a valid command.\n";
                    break;
            }
        }
    }

    function askEmail()
    {

        while (true) {
            echo "Enter the representative email: \n";
            $representative_email = trim(fgets(STDIN));

            if (Validations::isValidEmail($representative_email)) {
                return $representative_email;
            }

            echo "Email must not be empty and must conform to the format: something@something.com/org/etc \n";
        }
    }

    function askAmount($message)
    {

        while (true) {
            echo $message;
            $amount = trim(fgets(STDIN));

            if (Validations::isValidAmount($amount)) {
                return $amount;
            }

            echo "Invalid amount. Amount can be a positive number with maximum two digits after the decimal point. \n";
        }
    }

    function askName($message)
    {

        while (true) {
            echo $message;
            $name = trim(fgets(STDIN));

            if (Validations::isValidName($name)) {
                return $name;
            }

            echo "Name must not be empty and must not contain only numbers. \n";
        }
    }

    function askId($message)
    {
        while (true) {
            echo $message;

            $id = trim(fgets(STDIN));

            if (is_numeric($id) && Validations::isValidId($id)) {
                return $id;
            }

            echo "Invalid ID. Please choose an ID from the list. \n";
        }
    }

    function askCsvPath()
    {
        echo "Enter the path to your csv file. Example: C:\\users\\user\\test.csv \nIf you place your csv file under the resources folder of this project, you can type as path: ./resources/yourfile.csv \n";
        $path = trim(fgets(STDIN));

        return $path;
    }
}
