<?php

require_once __DIR__ . '/../../helpers/connect.php';
require_once __DIR__ . '/../../models/Patient.php';
require_once __DIR__ . '/../../models/Appointment.php';

$appointments = Appointment::listAppointments();

include __DIR__ . '/../../views/templates/header.php';
include __DIR__ . '/../../views/appointments/list.php';
include __DIR__ . '/../../views/templates/footer.php';
