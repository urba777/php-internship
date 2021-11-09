<?php
use classes\Appointment;
use classes\Input;
require_once 'config.php';
require_once 'classes/Appointment.php';
require_once 'classes/Input.php';
require_once 'db/DB.php';
require_once 'export.php';
require_once 'import.php';

echo "------------\n";
echo "Commands:\n";
echo " add - to register new appointment. \n";
echo " list - shows all appointments. \n";
echo " date - shows a list of everybody registered for a particular date. \n";
echo " edit - To edit appointment. \n";
echo " delete - To delete appointment. \n";
echo " export - Get all apointments list .csv file. \n";
echo " import - Import appointments list .csv file to database. \n";
echo "------------\n";

global $argv;
$command = null;
if (isset($argv[1])) {
    $command = $argv[1];
}

switch ($command) {
    case 'list':
        listAppointments();
        break;
    case 'date':
        echo "Enter date (For example 2021-11-30): ";
        $dateHandle = fopen("php://stdin", "r");
        $date = fgets($dateHandle);
        Input::validateDateInputForSpecificDate(trim($date));
        break;
    case 'add':
        addAppointment();
        break;
    case 'edit':
        editAppointment();
        break;
    case 'delete':
        deleteAppointment();
        break;
    case 'export':
        exportListToCsv();
        break;
    case 'import':
        importAppointmentAsCsv();
        break;
}

function listAppointments()
{
    echo "ALL APPOINTMENTS: \n";
    $appointments = Appointment::getAppointments();
    foreach ($appointments as $appointment) {
        echo sprintf('id: %s name: %s email: %s phone: %s id_number: %s date: %s %s', $appointment->id, $appointment->name, $appointment->email, $appointment->phone, $appointment->id_number, $appointment->date, PHP_EOL);
    }
    echo "export - TO DOWNLOAD this appointment list as .csv FILE.";
}

function listAppointmentsByDate($date)
{
    $appointments = Appointment::getAppointmentsByDate($date);
    foreach ($appointments as $appointment) {
        echo sprintf('id: %s name: %s email: %s phone: %s id_number: %s date: %s %s', $appointment->id, $appointment->name, $appointment->email, $appointment->phone, $appointment->id_number, $appointment->date, PHP_EOL);
    }
}

function addAppointment()
{
    $name = '';
    $email = '';
    $phone = '';
    $id_number = '';
    $date = '';

    echo "Register for appointment: \n";
    echo "Enter name: ";
    $nameHandle = fopen("php://stdin", "r");
    $name = fgets($nameHandle);
    Input::nameValidation(trim($name));

    echo "Enter email: ";
    $emailHandle = fopen("php://stdin", "r");
    $email = fgets($emailHandle);
    Input::emailValidation(trim($email));

    echo "Enter phone number: +370";
    $phoneHandle = fopen("php://stdin", "r");
    $phone = fgets($phoneHandle);
    Input::phoneNumberValidation(trim($phone));

    echo "Enter National identification number: ";
    $id_numberHandle = fopen("php://stdin", "r");
    $id_number = fgets($id_numberHandle);
    Input::idNumberValidation(trim($id_number));

    echo "Enter date (For example 2021-11-30 15:30): ";
    $dateHandle = fopen("php://stdin", "r");
    $date = fgets($dateHandle);
    Input::dateValidation(trim($date) . ':00');

    $appoinment = new Appointment();
    $appoinment->name = trim($name);
    $appoinment->email = trim($email);
    $appoinment->phone = trim($phone);
    $appoinment->id_number = trim($id_number);
    $appoinment->date = trim($date);
    $appoinment->add();
    echo 'REGISTRATION SUCCESSFUL!';
}

function editAppointment()
{
    echo "EDIT APPOINTMENT.\n";
    echo "Enter appointment ID: ";
    $inputHandle = fopen("php://stdin", "r");
    $id = fgets($inputHandle);
    Input::validateId(trim($id));
    $appointment = new Appointment(trim($id));
    $name = '';
    $email = '';
    $phone = '';
    $id_number = '';
    $date = '';

    echo "YOUR APPOINTMENT: \n";
    echo sprintf('id: %s name: %s email: %s phone: %s id_number: %s date: %s %s', $appointment->id, $appointment->name, $appointment->email, $appointment->phone, $appointment->id_number, $appointment->date, PHP_EOL);

    echo "Name: " . $appointment->name . ". Change it? Type yes/no: ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    if (trim($line) == 'yes' || trim($line) == 'YES') {
        echo "Enter new name: ";
        $inputHandle = fopen("php://stdin", "r");
        $name = fgets($inputHandle);
        Input::nameValidation(trim($name));
        echo "Name updated.\n";
    } else {
        $name = $appointment->name;
    }

    echo "Email: " . $appointment->email . ". Change it? Type yes/no: ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    if (trim($line) == 'yes' || trim($line) == 'YES') {
        echo "Enter new email: ";
        $inputHandle = fopen("php://stdin", "r");
        $email = fgets($inputHandle);
        Input::emailValidation(trim($email));
        echo "Email updated.\n";
    } else {
        $email = $appointment->email;
    }

    echo "Phone: " . $appointment->phone . ". Change it? Type yes/no: ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    if (trim($line) == 'yes' || trim($line) == 'YES') {
        echo "Enter new phone: ";
        $inputHandle = fopen("php://stdin", "r");
        $phone = fgets($inputHandle);
        Input::phoneNumberValidation(trim($phone));
        echo "Phone updated.\n";
    } else {
        $phone = $appointment->phone;
    }

    echo "National identification number: " . $appointment->id_number . ". Change it? Type yes/no: ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    if (trim($line) == 'yes' || trim($line) == 'YES') {
        echo "Enter new National identification number: ";
        $inputHandle = fopen("php://stdin", "r");
        $id_number = fgets($inputHandle);
        Input::idNumberValidation(trim($id_number));
        echo "National identification number updated.\n";
    } else {
        $id_number = $appointment->id_number;
    }

    echo "Date: " . $appointment->date . ". Change it? Type yes/no: ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    if (trim($line) == 'yes' || trim($line) == 'YES') {
        echo "Enter new date (For example 2021-11-30 15:30): ";
        $inputHandle = fopen("php://stdin", "r");
        $date = fgets($inputHandle);
        Input::dateValidation(trim($date) . ':00');
        echo "Date updated.\n";
    } else {
        $date = $appointment->date;
    }

    $appointment->name = trim($name);
    $appointment->email = trim($email);
    $appointment->phone = trim($phone);
    $appointment->id_number = trim($id_number);
    $appointment->date = trim($date);
    $appointment->save();
    echo "EDIT SUCCESSFUL!";
}

function deleteAppointment()
{
    echo "DELETE APPOINTMENT.\n";
    echo "Enter appointment ID: ";
    $inputHandle = fopen("php://stdin", "r");
    $id = fgets($inputHandle);
    Input::validateId(trim($id));
    $appointment = new Appointment(trim($id));
    $appointment->delete();
    echo "DELETE SUCCESSFUL!";
}