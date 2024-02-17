<?php

class TestData
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
        $this->db->getConnection();
        $this->db->selectDB();
    }

    function populateTestData()
    {
        $charities = [
            ['SaveTheDogs', 'savethedogs@gmail.com'],
            ['SaveTheCats', 'savethecats@gmail.com'],
            ['SaveTheWhales', 'savethewhales@gmail.com']
        ];

        $donations = [
            ['Bob the Dog', '149.90'],
            ['Jack the Dog', '50'],
            ['Cats in Boots', '9999'],
            ['Birute the Whale', '10']
        ];

        $charity_ids = [];

        // Insert charities
        foreach ($charities as $charity) {
            list($name, $email) = $charity;

            // Check if the charity already exists
            $sql = "SELECT * FROM Charity WHERE `name` = '$name' AND `representative_email` = '$email'";
            $result = $this->db->conn->query($sql);

            if ($result->num_rows == 0) {
                // Charity does not exist, so insert it
                $sql = "INSERT INTO Charity(`name`, `representative_email`) VALUES ('$name', '$email')";
                $this->db->conn->query($sql);

                //Get the id of the newly inserted Charity
                $sql2 = "SELECT * FROM Charity WHERE `name` = '$name' AND `representative_email` = '$email'";
                $result2 = $this->db->conn->query($sql2);
                $row = $result2->fetch_assoc();

                $charity_ids[] = $row['id'];
            }
        }

        // Insert donations
        if (!empty($charity_ids)) {
            $idcounter = 0;
            foreach ($donations as $donation) {
                list($donor_name, $amount) = $donation;

                if ($idcounter == count($charity_ids)) {
                    $idcounter--;
                }

                $sql = "INSERT INTO Donations(`donor_name`, `amount`, `charity_id`) VALUES ('$donor_name', '$amount', '$charity_ids[$idcounter]')";
                $this->db->conn->query($sql);

                $idcounter++;
            }
            echo "Test data populated successfully \n";
        }
    }
}
