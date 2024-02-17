<?php

include 'src\model\Donation.php';
class DonationDAO
{

    private $db;

    public function __construct()
    {
        $this->db = new DB();
        $this->db->getConnection();
        $this->db->selectDB();
    }


    public function addDonation($donation)
    {
        $donor_name = $donation->getDonorName();
        $amount = $donation->getAmount();
        $charity_id = $donation->getCharityId();

        $sql = "INSERT INTO Donations(`donor_name`, `amount`, `charity_id`) VALUES ('$donor_name', '$amount', '$charity_id')";
        $this->db->conn->query($sql);

        echo "donation of $donor_name was successful \n";
    }

    public function printDonations()
    {
        $sqlDonations = "SELECT * FROM Donations";
        $resultDonations = $this->db->conn->query($sqlDonations);
        var_dump($resultDonations);
        if ($resultDonations->num_rows > 0) {
            // Output data of each row
            while ($row = $resultDonations->fetch_assoc()) {
                echo "Donation ID: " . $row["id"] . ", Donor Name: " . $row["donor_name"] . ", Amount: " . $row["amount"] . ", Charity ID: " . $row["charity_id"] . "<br>";
            }
        } else {
            echo "No results in Donations table";
        }
    }
}
