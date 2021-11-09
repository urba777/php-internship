<?php
use classes\Appointment;
require_once 'config.php';
require_once 'classes/Appointment.php';
require_once 'db/DB.php';

parse_str(implode('&', array_slice($argv, 1)), $_GET);

function exportListToCsv()
{
    if (isset($_GET['export'])) {
        $output = fopen("appointments" . time() . ".csv", 'x');
        fputcsv($output, array(
            'id',
            'name',
            'email',
            'phone',
            'id_number',
            'date'
        ));
        $result = Appointment::getAppointments();
        foreach ($result as $row) {
            fputcsv($output, (array) $row);
        }
        fclose($output);
        if (! $output === FALSE) {
            echo "EXPORTING APPOINTMENTS...";
            echo "\n--------\n appointments" . time() . ".csv FILE SUCCESSFULLY EXPORTED TO MAIN DIRECTORY.\n--------\n";
        }
    }
}

