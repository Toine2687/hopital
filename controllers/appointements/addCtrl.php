<?php

require_once __DIR__ . '/../../helpers/connect.php';
require_once __DIR__ . '/../../models/Patient.php';
require_once __DIR__ . '/../../models/Appointment.php';
require_once __DIR__ . '/../../models/Singleton.php';

$patients = Patient::getAllSimple();
// $minutesRange = array('00', '15', '30', '45');


try {
    // ----------------------------------------VERIFS
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

        // ====ID===
        $id = (filter_input(INPUT_POST, "idPatient",  FILTER_SANITIZE_NUMBER_INT));
        if (empty($id)) {
            $error['id'] = 'Précisez l\'identité du patient';
        } else {
            $isExist = Patient::get($id);
            if (!$isExist) {
                $error['id'] = 'Identité du patient incohérente';
            }
        }

        if (empty($error)) {
            $appointment = new Appointment($dateHour, $id);
            $appointment->addAppointment();
            $msg['add'] = '👍 Rendez-vous enregistré';
        }
    }
} catch (\Throwable $th) {
    var_dump($th);
}


include __DIR__ . '/../../views/templates/header.php';
include __DIR__ . '/../../views/appointments/add.php';
include __DIR__ . '/../../views/templates/footer.php';
