<?php
namespace classes;

use DateTime;
require_once 'index.php';

class Input
{

    public function __construct()
    {}

    public static function nameValidation($variable)
    {
        if ($variable == '') {
            echo "YOU MUST ENTER YOUR NAME. \n---\n";
            exit();
        }
        if (is_numeric($variable)) {
            echo "NAME CAN'T BE NUMBERS. \n---\n";
            
            exit();
        }
        if (strlen($variable) > 32) {
            echo "NAME IS TOO LONG. MAX 32 SYMBOLS. \n---\n";
            exit();
        }
    }

    public static function emailValidation($variable)
    {
        if (! filter_var($variable, FILTER_VALIDATE_EMAIL)) {
            if ($variable == '') {
                echo "YOU MUST ENTER EMAIL. \n\n";     
                exit();
            } else {
                echo "INVALID EMAIL FORMAT. \n---\n";   
                exit();
            }
        }
    }

    public static function phoneNumberValidation($variable)
    {
        if ($variable == '') {
            echo "YOU MUST ENTER PHONE NUMBER. \n---\n";
            exit();
        }
        if (! is_numeric($variable)) {
            echo "PHONE NUMBER MUST BE NUMBERS. \n---\n";
            exit();
        }
        if (strlen($variable) > 8) {
            echo "PHONE NUMBER IS TOO LONG. MAX 8 SYMBOLS. \n---\n"; 
            exit();
        }
    }

    public static function idNumberValidation($variable)
    {
        if ($variable == '') {
            echo "YOU MUST ENTER NATIONAL IDENTIFICATION NUMBER. \n---\n";  
            exit();
        }
        if (! is_numeric($variable)) {
            echo "NATIONAL IDENTIFICATION NUMBER MUST BE NUMBERS. \n---\n";
            exit();
        }
        if (strlen($variable) > 11) {
            echo "PHONE NUMBER IS TOO LONG. MAX 11 SYMBOLS. \n---\n";  
            exit();
        }
    }

    public static function dateValidation($variable)
    {

        function validateDate($date, $format = 'Y-m-d H:i:s')
        {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }
        if (validateDate($variable) === FALSE) {
            echo "WRONG DATE FORMAT. PLEASE ENTER YEAR-MONTH-DAY HOUR:MINUTE. \n \n"; 
            exit();
        }
        if ($variable == '') {
            echo "YOU MUST ENTER DATE. \n---\n";
            exit();
        }
    }

    public static function validateDateInputForSpecificDate($variable)
    {
        echo $variable." ALL APPOINTMENTS:\n";
        $appointmentsByDate = Appointment::getAppointmentsByDate($variable);
        if ($appointmentsByDate == []) {
            echo "THERE ARE NO APPOINTMENTS FOR THE SELECTED DATE. \n---\n";
        }
        function forSpecificDateInput($date, $format = 'Y-m-d')
        {
            $b = DateTime::createFromFormat($format, $date);
            return $b && $b->format($format) === $date;
        }
        if ($variable == '') {
            echo "YOU MUST ENTER DATE. \n---\n";
        }
        if (forSpecificDateInput($variable) === FALSE) {
            echo "WRONG DATE FORMAT. PLEASE ENTER YEAR-MONTH-DAY. \n \n";
        }
        listAppointmentsByDate($variable);
    }

    public static function validateId($id)
    {
        if (! is_numeric($id)) {
            echo "IT MUST BE A NUMBER";
            exit();
        }
    }
}

?>