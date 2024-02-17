<?php
class Donation
{

    private $id;
    private $donor_name;
    private $amount;
    private $charity_id;
    private $time_at;

    public function __construct($donor_name, $amount, $charity_id, $time_at = null, $id = null)
    {
        $this->id = $id;
        $this->donor_name = $donor_name;
        $this->amount = $amount;
        $this->charity_id = $charity_id;
        $this->time_at = $time_at;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDonorName()
    {
        return $this->donor_name;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getCharityId()
    {
        return $this->charity_id;
    }

    public function getTimeAt()
    {
        return $this->time_at;
    }

    public function __toString()
    {
        return "Donation ID: " . $this->id . ", Donor Name: " . $this->donor_name . ", Amount: " . $this->amount . ", Charity ID: " . $this->charity_id . ", Time: " . $this->time_at;
    }
}
