<?php
include 'src\model\Charity.php';

class CharityDAO
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
        $this->db->getConnection();
        $this->db->selectDB();
    }

    function getCharities()
    {
        $sql = "SELECT * FROM Charity";
        $resultCharities = $this->db->conn->query($sql);
        $charities = [];

        if ($resultCharities->num_rows > 0) {
            // Output data of each row
            while ($row = $resultCharities->fetch_assoc()) {
                $charities[] = new Charity($row["name"], $row["representative_email"], $row["id"]);
            }
        } else {
            echo "No results in Charity table \n";
        }

        return $charities;
    }

    public function printCharities()
    {
        $charities = $this->getCharities();

        foreach ($charities as $charity) {
            echo $charity;
        };
    }

    public function addCharity($charity)
    {
        $name = $charity->getName();
        $representative_email = $charity->getRepresentativeEmail();

        $sql = "INSERT INTO Charity(`name`, `representative_email`) VALUES ('$name', '$representative_email');";
        $this->db->conn->query($sql);
        echo "Charity $name added successfully.\n";
    }


    public function editCharity($id, $charity)
    {
        $name = $charity->getName();
        $representative_email = $charity->getRepresentativeEmail();

        $sql = "UPDATE Charity
                    SET `name` = '$name', `representative_email` = '$representative_email'
                    WHERE `id` = '$id';
                    ";

        $this->db->conn->query($sql);
        echo "charity id $id updated successfully \n";
    }

    public function deleteCharity($id)
    {
        $sql = "DELETE FROM Charity WHERE `id` = '$id';";

        $this->db->conn->query($sql);
        echo "charity id $id deleted successfully \n";
    }
}
