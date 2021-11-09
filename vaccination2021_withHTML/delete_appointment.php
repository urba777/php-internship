<?php
use classes\Appointment;
require_once 'config.php';
require_once 'classes/Appointment.php';
require_once 'db/DB.php';

$id = $_GET['id'];

$deleteAppointment = new Appointment($id);
$deleteAppointment->delete();
Header("location: index");