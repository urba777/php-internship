<?php
use classes\Appointment;

require_once 'config.php';
require_once 'classes/Appointment.php';
require_once 'db/DB.php';

function importAppointmentAsCsv()
{
    if (isset($_GET['import'])) {
        echo "Enter file's name: import_appointments.csv (FILE MUST BE IN MAIN DIRECTORY): ";
        $handle = fopen("php://stdin", "r");
        $result = fgets($handle);

        if (trim($result) == 'import_appointments.csv') {
            $file = fopen(trim($result), 'r');
            $appointment = new Appointment();
            while (($column = fgetcsv($file, 10000, ',')) !== FALSE) {
                $appointment->name = $column[0];
                $appointment->email = $column[1];
                $appointment->phone = $column[2];
                $appointment->id_number = $column[3];
                $appointment->date = $column[4];
                $appointment->add();
            }
            echo "csv File uploaded.\n";
        }
        if (trim($result) != 'import_appointments.csv') {
            echo "ERROR. WRONG FILE NAME. TRY AGAIN. ITS NAME MUST BE import_appointments.csv \n";
            exit();
        }
    }
}
    
