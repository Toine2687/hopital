<?php

require_once __DIR__ . '/../../config/regex.php';
require_once __DIR__ . '/../../helpers/connect.php';
require_once __DIR__ . '/../../models/Patient.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

        if (empty($error)) {
            // si pas doublon
            if (Patient::checkDouble($mail) == NULL) {
                // enregistrement en bdd
                //=== Instanciation ===
                $patient = new Patient($lastname, $firstname, $birthDate, $mail, $phone);
                $isAdded = $patient->add();
                if ($isAdded) {
                    $msg['add'] = '👍 Patient ajouté';
                }
            } else {
                $msg['add'] = 'Erreur pendant l\'ajout';
            }
        }
    }
} catch (\Throwable $th) {
    var_dump($th);
}

include __DIR__ . '/../../views/templates/header.php';
include __DIR__ . '/../../views/patients/add.php';
include __DIR__ . '/../../views/templates/footer.php';
