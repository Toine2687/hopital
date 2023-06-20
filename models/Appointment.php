<?php

require_once __DIR__ . '/Patient.php';


class Appointment
{
    private int $id;
    private string $dateHour;
    private int $idPatients;

    public function __construct(string $dateHour, int $idPatients = NULL)
    {
        $this->dateHour = $dateHour;
        $this->idPatients = $idPatients;
    }

    //getters & setters

    function set_id($id)
    {
        $this->id = $id;
    }
    function get_id()
    {
        return $this->id;
    }

    function set_dateHour($dateHour)
    {
        $this->dateHour = $dateHour;
    }
    function get_dateHour()
    {
        return $this->dateHour;
    }

    function set_idPatients($idPatients)
    {
        $this->idPatients = $idPatients;
    }
    function get_idPatients()
    {
        return $this->idPatients;
    }

    public function addAppointment()
    {
        $db = connect();
        $sql = "INSERT INTO `appointments` (`dateHour`,`idPatients`) 
                VALUES (:dateHour,:idPatients)";
        $sth = $db->prepare($sql);
        $sth->bindValue(':dateHour', $this->dateHour);
        $sth->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        return ($sth->execute());
    }

    public static function listAppointments():array
    {
        $db = connect();
        $sql = "SELECT `appointments`.`id`, `patients`.`firstname`,
                `patients`.`lastname`, `appointments`.`dateHour` 
                FROM `appointments` 
                INNER JOIN `patients` 
                ON `appointments`.`idPatients` = `patients`.`id`;";
        $sth = $db->query($sql);
        $fetch = $sth->fetchAll();
        return $fetch;
    }

    public static function detailAppointment($id)
    {
        $db = connect();
        $sql = "SELECT `appointments`.`id`, `patients`.`firstname`,
        `patients`.`lastname`, `appointments`.`dateHour` 
        FROM `appointments` 
        INNER JOIN `patients` 
        ON `appointments`.`idPatients` = `patients`.`id` 
        WHERE `appointments`.`id`=:id";
        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $id);
        $sth->execute();
        $fetch = $sth->fetch();
        return $fetch;
    }

    public static function updateAppointment($id, $dateHour)
    {
        $db = connect();
        $sql = "UPDATE `appointments` SET 
        `datehour` = :dateHour
        WHERE `id` = :id;";
        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $id);
        $sth->bindValue(':dateHour', $dateHour);
        $sth->execute();
    }

    public static function delete($id){
        $db = connect();
        $sql = "DELETE FROM `appointments`
        WHERE `id` = :id;";
        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $id);
        return $sth->execute();
    }
}
