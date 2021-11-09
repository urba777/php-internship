<?php
use classes\Appointment;
require_once 'config.php';
require_once 'classes/Appointment.php';
require_once 'db/DB.php';

?>

<!DOCTYPE html>
<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mohave:wght@400;500&display=swap" rel="stylesheet">
<link href="styles/style.css" rel="stylesheet" type="text/css">
<meta charset="UTF-8">
<title>Deividas Urbanavičius</title>
</head>
<body>
<h1>All appointments</h1>
	<table>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Email</th>
			<th>Phone Number</th>
			<th>National identification number</th>
			<th>Date and Time</th>
			<th>Action</th>
		</tr>
		<?php 
		foreach (Appointment::getAppointments() as $appointment) {
		?>
		<tr>
			<td><?=$appointment->id?></td>
			<td><?=$appointment->name?></td>
			<td><?=$appointment->email?></td>
			<td>+370<?=$appointment->phone?></td>
			<td><?=$appointment->id_number?></td>
			<td><?=date("Y-m-d\ H:i", strtotime($appointment->date))?></td>
			<td class="actionButtons">
				<a class='myButton' href="appointment_edit?id=<?=$appointment->id?>">Edit</a>
				<a class='myButton' href="delete_appointment?id=<?=$appointment->id?>">Delete</a>
			</td>
		</tr>
		<?php
		}
		?>
	</table>
	<div class="registerAndExportButtons">
		<a class='myButton' href="appointment_register">Register</a>
		<form action="exportEverything" method="post">
			<button class="myButton" type="submit" name="exportEverything">Export csv</button>
		</form>
	</div>
	<form method="post">
		<h1>Appointments by selected date</h1>
		<input type="date" name="date" required>
		<button class='myButton' type="submit">SUBMIT</button>
	</form>
	<?php if (isset($_POST['date'])) {
	    $appointmentsByDate = Appointment::getAppointmentsByDate($_POST['date']);
        if ($appointmentsByDate == []) {
    ?>
		<h2>There are no appointments for the selected date</h2>
		<?php } else {?>
    	<table>
    		<tr>
    			<th>ID</th>
    			<th>Name</th>
    			<th>Email</th>
    			<th>Phone Number</th>
    			<th>National identification number</th>
    			<th>Date and Time</th>
    			<th>Action</th>
    		</tr>
    		<?php foreach ($appointmentsByDate as $appointment) {?>
    		<tr>
    			<td><?=$appointment->id?></td>
    			<td><?=$appointment->name?></td>
    			<td><?=$appointment->email?></td>
    			<td>+370<?=$appointment->phone?></td>
    			<td><?=$appointment->id_number?></td>
    			<td><?=date("Y-m-d\ H:i", strtotime($appointment->date))?></td>
    			<td class="actionButtons">
    				<a class='myButton' href="appointment_edit?id=<?=$appointment->id?>">Edit</a>
    				<a class='myButton' href="delete_appointment?id=<?=$appointment->id?>">Delete</a>
    			</td>
    		</tr>
    		<?php }?>
    	</table>
    <form method="post" action="export?date=<?=$_POST['date']?>">
		<button class='myButton' type="submit" name="export">Export csv</button>
	</form>
	<?php }
	}?>
</body>
</html>