<?php

// -------------------Dépendances-------------------------

require_once __DIR__ . '/../config/regex.php';
require_once __DIR__ . '/../helpers/connect.php';
require_once __DIR__ . '/../models/Patient.php';
require_once __DIR__ . '/../models/Appointment.php';
require_once __DIR__ . '/../models/Singleton.php';


try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // -------------------------Contrôles Patient-----------------

        // ====NOM===
        $lastname = trim(filter_input(INPUT_POST, "lastname",  FILTER_SANITIZE_SPECIAL_CHARS));
        if (empty($lastname)) {
            $error['lastname'] = 'Le nom est manquant';
        } else {
            $lastname = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . NAME_PATTERN . '/')));
            if ($lastname == false) {
                $error['lastname'] = 'Erreur sur le nom';
            }
        }

        // ====PRENOM===
        $firstname = trim(filter_input(INPUT_POST, "firstname",  FILTER_SANITIZE_SPECIAL_CHARS));
        if (empty($firstname)) {
            $error['firstname'] = 'Le prénom est manquant';
        } else {
            $firstname = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . NAME_PATTERN . '/')));
            if ($firstname == false) {
                $error['firstname'] = 'Erreur sur le prénom';
            }
        }

        // ===== BIRTHDATE ======
        $birthDate = filter_input(INPUT_POST, "birthDate",  FILTER_SANITIZE_NUMBER_INT);
        if (empty($birthDate)) {
            $error['birthDate'] = 'La date de naissance est manquante';
        } else if ($birthDate < date('Y-m-d', strtotime('-100 years')) || $birthDate > date('Y-m-d', strtotime('-1 days'))) {
            $error['birthDate'] = 'Date de naissance incohérente';
        }

        // ====== PHONE =========
        $phone = trim(filter_input(INPUT_POST, "phone",  FILTER_SANITIZE_NUMBER_INT));

        // ======= MAIL =======
        $mail =  filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL);
        if (empty($mail)) {
            $error['mail'] = 'L\'adresse mail est manquante';
        } else if (strlen($mail) > 100) {
            $error['mail'] = 'L\'adresse mail est incorrecte';
        }

        // --------------------------Contrôles Appointment-----------------------------

        // ===== Date et heure ======
        $date = filter_input(INPUT_POST, "date",  FILTER_SANITIZE_NUMBER_INT);
        $time = filter_input(INPUT_POST, "time",  FILTER_SANITIZE_SPECIAL_CHARS);
        $dateHour = $date . ' ' . $time;
        if (empty($dateHour)) {
            $error['dateHour'] = 'Date et/ou horaire manquants';
        } else if ($date < date('Y-m-d', strtotime('now')) || $date > date('Y-m-d', strtotime('+300 days'))) {
            $error['dateHour'] = 'Date et/ou horaire incohérents';
        } else if (in_array($time, MINUTESRANGE)) {
            $dateHour = date('Y-m-d H:i:s');
        } 

        // --------------------------Execution-----------------------------


        if (empty($error)) {
            try {
                $db = connect();
                $db->beginTransaction();
                // si pas doublon
                if (Patient::checkDouble($mail) == NULL) {
                    $patient = new Patient($lastname, $firstname, $birthDate, $mail, $phone);
                    $isAdded = $patient->add();
                }
                
                $id = $db->lastInsertId();

                $appointment = new Appointment($dateHour, $id);
                $isSet = $appointment->addAppointment();
                $db->commit();
            } catch (\PDOException $e) {
                $db->rollBack();
            }
            if ($isAdded & $isSet) {
                $msg['add'] = '👍 Patient ajouté & rendez-vous enregistré';
            } else {
                $msg['add'] = 'Erreur pendant l\'ajout';
            }
        }

        // -------------------------Patient-----------------

    }
} catch (\Throwable $th) {
    var_dump($th);
}

// ------------------------ Vues

include __DIR__ . '/../views/templates/header.php';
include __DIR__ . '/../views/addBoth.php';
include __DIR__ . '/../views/templates/footer.php';
