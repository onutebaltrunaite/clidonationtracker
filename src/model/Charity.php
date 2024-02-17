<?php
class Charity
{

    private $id;
    private $name;
    private $representative_email;

    public function __construct($name, $representative_email, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->representative_email = $representative_email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRepresentativeEmail()
    {
        return $this->representative_email;
    }

    public function __toString()
    {
        return "Charity ID: " . $this->getId() . ", Name: " . $this->getName() . ", Representative email: " . $this->getRepresentativeEmail() . "\n";
    }
}
