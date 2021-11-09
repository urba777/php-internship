<?php
use classes\Appointment;

require_once 'config.php';
require_once 'classes/Appointment.php';
require_once 'db/DB.php';

if (isset($_POST['import'])) {
    $fileName = $_FILES['file']['tmp_name'];
    
    if($_FILES['file']['size'] > 0) {
        $file = fopen($fileName, 'r');
        
        $appointment = new Appointment();
        while(($column = fgetcsv($file, 10000, ',')) !== FALSE) {
            $appointment->name=$column[0];
            $appointment->email=$column[1];
            $appointment->phone=$column[2];
            $appointment->id_number=$column[3];
            $appointment->date=$column[4];
            $appointment->add();
        }
        
        header("Location: index");
    }
}
    
