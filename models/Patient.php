<?php

require_once __DIR__ . '/Singleton.php';


class Patient
{
    private int $id;
    private string $lastname;
    private string $firstname;
    private string $birthdate;
    private ?string $phone;
    private string $mail;

    //constructor
    public function __construct(string $lastname = '', string $firstname = '', string $birthdate = '', string $mail = '', string $phone = null)
    {
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->birthdate = $birthdate;
        $this->mail = $mail;
        $this->phone = $phone;
    }

    //getters & setters
    public function set_id($id)
    {
        $this->id = $id;
    }
    public function get_id(): int
    {
        return $this->id;
    }

    public function set_lastname($lastname)
    {
        $this->lastname = $lastname;
    }
    public function get_lastname(): string
    {
        return $this->lastname;
    }

    public function set_firstname($firstname)
    {
        $this->firstname = $firstname;
    }
    public function get_firstname(): string
    {
        return $this->firstname;
    }

    public function set_birthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }
    public function get_birthdate()
    {
        return $this->birthdate;
    }

    public function set_phone($phone)
    {
        $this->phone = $phone;
    }
    public function get_phone()
    {
        return $this->phone;
    }

    public function set_mail($mail)
    {
        $this->mail = $mail;
    }
    public function get_mail()
    {
        return $this->mail;
    }

    public function add()
    {
        // $db = connect();
        $instance = Singleton::getInstance();
        $db = $instance->sConnect();
        $sql = "INSERT INTO `patients` (`lastname`,`firstname`, `birthdate`,`mail`,`phone`) 
        VALUES (:lastname,:firstname,:birthdate,:mail,:phone)";
        $sth = $db->prepare($sql);
        $sth->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        // NB : à typer quand ce n'est pas un string
        $sth->bindValue(':firstname', $this->firstname);
        $sth->bindValue(':birthdate', $this->birthdate);
        $sth->bindValue(':mail', $this->mail);
        $sth->bindValue(':phone', $this->phone);
        return ($sth->execute());
    }

    public static function checkDouble($mail)
    {
        $db = connect();
        $sql = "SELECT `mail` FROM `patients` WHERE `mail`=:mail";
        $sth = $db->prepare($sql);
        $sth->bindValue(':mail', $mail);
        $sth->execute();
        $fetch = $sth->fetch();
        return $fetch;
    }
    // ---------------ANCIENNE VERSION SANS PAGINATION-------------
    public static function getAllSimple()
    {
        $db = connect();
        $sql = "SELECT * FROM `patients`;";
        $sth = $db->query($sql);
        $fetch = $sth->fetchAll();
        return $fetch;
    }

    public static function getAll($limit, $start)
    {
        $db = connect();
        $sql = "SELECT * FROM `patients` ORDER BY `lastname` LIMIT :limit OFFSET :start; ;";
        $sth = $db->prepare($sql);
        $sth->bindValue(':limit', $limit, PDO::PARAM_INT);
        $sth->bindValue(':start', $start, PDO::PARAM_INT);
        $sth->execute();
        $fetch = $sth->fetchAll();

        return $fetch;
    }

    public static function get($id)
    {
        $db = connect();
        $sql = "SELECT * FROM `patients` WHERE `id` = :id;";
        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $id);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Patient');
        $fetch = $sth->fetch();
        return $fetch;
    }

    public function update($id)
    {
        $db = connect();
        $sql = "UPDATE `patients` SET 
        `lastname` = :lastname,
        `firstname` = :firstname,
        `birthdate` = :birthdate,
        `mail` = :mail,
        `phone` = :phone
        WHERE `patients`.`id` = :id;";
        $sth = $db->prepare($sql);
        // ======== bindValue à typer quand ce n'est pas un string
        $sth->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $sth->bindValue(':id', $id);
        $sth->bindValue(':firstname', $this->firstname);
        $sth->bindValue(':birthdate', $this->birthdate);
        $sth->bindValue(':mail', $this->mail);
        $sth->bindValue(':phone', $this->phone);
        return $sth->execute();
    }
    public static function getAllSelfAppointments($id)
    {
        $db = connect();
        $sql = "SELECT `patients`.`id`,`appointments`.`dateHour`
        FROM `appointments` 
        INNER JOIN `patients` 
        ON `appointments`.`idPatients` = `patients`.`id`
        WHERE `patients`.`id` = :id;";
        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $id);
        $sth->execute();
        $fetch = $sth->fetchAll();
        return $fetch;
    }
    public static function delete($id)
    {
        $db = connect();
        $sql = "DELETE FROM `appointments` WHERE `idPatients` = :id;
        DELETE FROM `patients` WHERE `id` = :id;";
        // Copyright Nathan
        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $id);
        return $sth->execute();
    }

    public static function getAllFiltered($search)
    {
        $search = '%' . $search . '%';

        $db = connect();
        $sql = 'SELECT * FROM `patients` WHERE `lastname` LIKE :search OR `firstname` LIKE :search;';
        $sth = $db->prepare($sql);
        $sth->bindValue(':search', $search);
        $sth->execute();
        $fetch = $sth->fetchAll();
        return $fetch;
    }

    public static function count()
    {
        $db = connect();
        $sql = 'SELECT count(id) FROM `patients`;';
        $foundRows = $db->query($sql);
        $totalEltsCount = $foundRows->fetchColumn();
        return $totalEltsCount;
    }
    
    public static function last(){
        $db = connect();
        $sql = 'SELECT LAST_INSERT_ID() FROM `patients`;';
        $sth = $db->query($sql);
        $sth->execute();
        $lastId = $sth->fetch();
        return $lastId;
    }
}
