<?php
use classes\Appointment;
require_once 'config.php';
require_once 'classes/Appointment.php';
require_once 'db/DB.php';

//validations
$validations = [];
$errorBorderColor = 'rgb(173, 5, 5)';
$nameBorderColor = 'white'; $emailBorderColor = 'white';
$phoneBorderColor = 'white'; $idNumberBorderColor = 'white';
if (isset($_POST['name']) && $_POST['name'] == '') {
        $validations[] = "You must enter your name!";
        $nameBorderColor = 'rgb(173, 5, 5)';
} elseif (isset($_POST['name']) && is_numeric($_POST['name'])) {
        $validations[] = "Name must be letters!";
        $nameBorderColor = 'rgb(173, 5, 5)';
}
if (isset($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    if ($_POST['email'] == '') {
        $validations[] = "You must enter your email!";
        $emailBorderColor = $errorBorderColor;
    } else {
        $validations[] = "Invalid email format!";
        $emailBorderColor = $errorBorderColor;
    }
} 
if (isset($_POST['phone']) && !is_numeric($_POST['phone'])) {
    if ($_POST['phone'] == '') {
        $validations[] = 'You must enter your phone number!';
        $phoneBorderColor = $errorBorderColor;
    } else {
        $validations[] = 'Phone number must be numbers!';
        $phoneBorderColor = $errorBorderColor;
    }
} 
if (isset($_POST['id_number']) && !is_numeric($_POST['id_number'])) {
    if ($_POST['id_number'] == '') {
        $validations[] = 'You must enter national identification number!';
        $idNumberBorderColor = $errorBorderColor;
    } else {
        $validations[] = 'National identification number must be numbers!';
        $idNumberBorderColor = $errorBorderColor;
    }
}

$appointment = new Appointment();
if (isset($_POST['name']) && is_numeric($_POST['phone']) 
    && is_numeric($_POST['id_number']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) 
    && $_POST['name'] != '' && !is_numeric($_POST['name'])) {
    $appointment->name=$_POST['name'];
    $appointment->email=$_POST['email'];
    $appointment->phone=$_POST['phone'];
    $appointment->id_number=$_POST['id_number'];
    $appointment->date=$_POST['date'];
    $appointment->add();
    header("Location: index");
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mohave:wght@400;500&display=swap" rel="stylesheet">
<meta charset="UTF-8">
<link href="styles/style.css" rel="stylesheet" type="text/css">
<title>Deividas Urbanavičius</title>
</head>
<body>
<div class="registerForm">
	<h1>Register for appointment</h1>
    <form method="post" action="appointment_register">
    	<span class="inputTitle">Name</span>
    	<input style="border-color:<?=$nameBorderColor?>" type='text' name="name" placeholder="Name" value="<?=(isset($_POST['name'])) ? $_POST['name'] : ''?>"></input>
    	<span class="inputTitle">Email</span>
    	<input style="border-color:<?=$emailBorderColor?>" type='text' name="email" placeholder="your@email.com" value="<?=(isset($_POST['email'])) ? $_POST['email'] : ''?>"></input>
    	<span class="inputTitle">Phone Number (+370)</span>
    	<input style="border-color:<?=$phoneBorderColor?>" type='text' name="phone" placeholder="Phone Number (61234567)" maxlength="8" value="<?=(isset($_POST['phone'])) ? $_POST['phone'] : ''?>"></input>
    	<span class="inputTitle">National identification number</span>
    	<input style="border-color:<?=$idNumberBorderColor?>" type='text' name="id_number" maxlength="11" value="<?=(isset($_POST['id_number'])) ? $_POST['id_number'] : ''?>"></input> 
    	<span class="inputTitle">Date and Time</span>
    	<input type='datetime-local' name="date"  value="<?=(isset($_POST['date'])) ? $_POST['date'] : ''?>" required></input>
    	<button class='myButton' type="submit">SUBMIT</button>
    </form>
    <h1>Import appointments</h1>
    <form method="post" action="import" enctype="multipart/form-data">
    	<input type="file" name='file' accept=".csv" required>
    	<button class='myButton importCsv' type="submit" name="import">Import CSV</button>
    	<a class="myButton" href="index">GO BACK</a>
    </form>
    <?php foreach ($validations as $validate) {?>
    <h2><?=$validate?></h2>
    <?php }?>
</div>
</body>
</html>