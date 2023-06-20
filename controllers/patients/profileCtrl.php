<?php
require_once __DIR__ . '/../../config/regex.php';
require_once __DIR__ . '/../../helpers/connect.php';
require_once __DIR__ . '/../../models/Patient.php';

$id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
// Récupération du patient cliqué sur list
try {
    $patient = Patient::get($id);
    if (!$patient) {
        throw new Exception('Patient introuvable');
    }
} catch (\Throwable $th) {
    // possibilité d'inclure un message d'erreur sur une page dédiée à ranger dans templates
    // penser à inclure le footer etc.
    var_dump($th);
}

// Verifs avant update
try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // ====NOM===
        $lastname = trim(filter_input(INPUT_POST, "lastname",  FILTER_SANITIZE_SPECIAL_CHARS));
        if (empty($lastname)) {
            $error['lastname'] = 'Le nom est manquant';
        } else {
            $lastname = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . NAME_PATTERN . '/')));
            if ($lastname == false) {
                $error['lastname'] = 'Erreur sur votre nom';
            }
        }

        // ====PRENOM===
        $firstname = trim(filter_input(INPUT_POST, "firstname",  FILTER_SANITIZE_SPECIAL_CHARS));
        if (empty($firstname)) {
            $error['firstname'] = 'Le prénom est manquant';
        } else {
            $firstname = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . NAME_PATTERN . '/')));
            if ($firstname == false) {
                $error['firstname'] = 'Erreur sur votre prénom';
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
            $newPatient = new Patient($lastname, $firstname, $birthDate, $mail, $phone);
            $newPatient->update($patient->get_id());
        }
    }
} catch (\Throwable $th) {
    var_dump($th);
}

if (isset($_GET['delete'])) {
    $del = $_GET['delete'];

    if ($del) {
        Patient::delete($id);
        header('location: /controllers/patients/listCtrl.php');
    }
}
//-------------- Suppression
// AFFICHAGE COMMENTAIRE OK OU NON
// $patient = Patient::get($_GET['mail']);
// $isAdded = $patient->add();
// if ($isAdded) {
//     $msg['add'] = '👍 Patient ajouté';
// } else {
//     $msg['add'] = 'Erreur pendant l\'ajout';
// }

$selfAppointments = Patient::getAllSelfAppointments(intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

include __DIR__ . '/../../views/templates/header.php';
include __DIR__ . '/../../views/patients/profile.php';
include __DIR__ . '/../../views/patients/appointments.php';

include __DIR__ . '/../../views/patients/update.php';


include __DIR__ . '/../../views/templates/footer.php';
