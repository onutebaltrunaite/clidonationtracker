<?php

class Validations
{

    public static function isValidEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public static function isValidName($name)
    {
        if (empty($name) || is_numeric($name)) {
            return false;
        } else {
            return true;
        }
    }

    public static function isValidId($id)
    {
        $charitydao = new CharityDAO();
        $charities_arr = $charitydao->getCharities();

        if ($id !== 0) {
            for ($i = 0; $i < count($charities_arr); $i++) {
                if ($id == $charities_arr[$i]->getId()) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function charityNameAlreadyExists($input_name)
    {
        $charitydao = new CharityDAO();
        $charities_arr = $charitydao->getCharities();

        if ($input_name) {
            for ($i = 0; $i < count($charities_arr); $i++) {
                if ($input_name == $charities_arr[$i]->getName()) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function isValidAmount($amount)
    {
        if (is_numeric($amount) && $amount > 0) {
            // Number format: (number, decimal places, decimal separator, thousands separator)
            //Rounds the number if it contains more than 2 digits after the decimal point
            $amount = number_format($amount, 2, '.', '');
            return $amount;
        } else {
            return false;  // Not a valid currency amount
        }
    }
}
