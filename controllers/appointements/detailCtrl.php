<?php
require_once __DIR__ . '/../../config/regex.php';
require_once __DIR__ . '/../../helpers/connect.php';
require_once __DIR__ . '/../../models/Patient.php';
require_once __DIR__ . '/../../models/Appointment.php';


$id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
// ---------------- Récupération du rdv cliqué sur liste
// try {
$appointment = Appointment::detailAppointment($id, intval(filter_input(INPUT_GET, 'dateHour', FILTER_SANITIZE_NUMBER_INT)));
//     if (!$appointment) {
//         throw new Exception('Rendez-vous introuvable');
//     }
// } catch (\Throwable $th) {
//     var_dump($th);
// }
//---------------- verifs avant update
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

    if (empty($error)) {
        $newAppointment = Appointment::updateAppointment($id, $dateHour);
        //actualisation
        $appointment = Appointment::detailAppointment(intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)), intval(filter_input(INPUT_GET, 'dateHour', FILTER_SANITIZE_NUMBER_INT)));
        $msg['updated'] = '👍 Rendez-vous mis à jour';
    }
}
//-------------- Suppression
if (isset($_GET['delete'])) {
    $del = $_GET['delete'];

    if ($del) {
        Appointment::delete($id);
        header('location: /controllers/appointements/listCtrl.php');
    }
}


include __DIR__ . '/../../views/templates/header.php';
include __DIR__ . '/../../views/appointments/detail.php';
include __DIR__ . '/../../views/appointments/update.php';
include __DIR__ . '/../../views/templates/footer.php';
