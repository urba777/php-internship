<?php
namespace classes;

use db\DB;

class Appointment {
    public $id;
    public $name;
    public $email;
    public $phone;
    public $id_number;
    public $date;
    
    public function __construct($id = null) {
        if ($id != null) {
           $ps = DB::get()->prepare("SELECT *, DATE_FORMAT(date, '%Y-%m-%dT%H:%i') as date FROM appointment WHERE id=?");
           $ps->execute([$id]);
           $data = $ps->fetch(\PDO::FETCH_ASSOC);
           $this->id = $data['id'];
           $this->name = $data['name'];
           $this->email = $data['email'];
           $this->phone = $data['phone'];
           $this->id_number = $data['id_number'];
           $this->date = $data['date'];
        }
    }
    
    public function add() {
        $result = DB::get()->prepare("INSERT INTO appointment (name, email, phone, id_number, date) VALUES (?, ?, ?, ?, ?)");
        $result->execute([$this->name, $this->email, $this->phone, $this->id_number, $this->date]);
    }
    
    public function delete(){
        $result = DB::get()->prepare("DELETE FROM appointment WHERE id=?");
        $result->execute([$this->id]);
    }
    
    public static function getAppointments() {
        $result = DB::get()->query("SELECT * FROM appointment");
        $appointments = [];
        foreach ($result->fetchAll() as $appointment) {
            $appointments[] = new Appointment($appointment['id']);
        }
        return $appointments;
    }
    
    public static function getAppointmentsByDate($date) {
        $result = DB::get()->prepare("SELECT * FROM appointment WHERE DATE(date)=? ORDER BY date ASC");
        $result->execute([$date]);
        $appointments = [];
        foreach ($result->fetchAll() as $appointment) {
            $appointments[] = new Appointment($appointment['id']);
        }
        return $appointments;
    }
    
    public function save() {
        $ps = DB::get()->prepare("UPDATE appointment SET name=?, email=?, phone=?, id_number=?, date=? WHERE id=?");
        $ps->execute([$this->name, $this->email, $this->phone, $this->id_number, $this->date, $this->id]);
    }
    
}


 ?>