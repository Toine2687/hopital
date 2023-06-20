<?php

require_once __DIR__ . '/../../helpers/connect.php';
require_once __DIR__ . '/../../models/Patient.php';

//------------------------------------Affichage paginé
$page = intval(filter_input(INPUT_GET, "page",  FILTER_SANITIZE_NUMBER_INT));
$limit = 5;
$start = ($page - 1) * $limit;
$patients = Patient::getAll($limit, $start);

//----------------------------------Compte de pages nécessaires
$Eltnb = Patient::count();
$pagesCount = ceil($Eltnb / $limit);

// -----------------------------------Si recherche
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = $_POST['search'];
    $patients = Patient::getAllFiltered($search);
}

include __DIR__ . '/../../views/templates/header.php';
include __DIR__ . '/../../views/patients/list.php';
include __DIR__ . '/../../views/templates/footer.php';
