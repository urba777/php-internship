<?php
use classes\Appointment;
require_once 'config.php';
require_once 'classes/Appointment.php';
require_once 'db/DB.php';

if (isset($_POST['exportEverything'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=appointments.csv');
    $output = fopen("php://output", 'w');
    fputcsv($output, array('id', 'name', 'email', 'phone', 'id_number', 'date'));
    $result = Appointment::getAppointments();
    foreach ($result as $row) {
        fputcsv($output, (array) $row);
    }
    fclose($output);
}

