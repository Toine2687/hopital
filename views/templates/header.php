<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Theme Hospital</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-success-subtle">
            <div class="container-fluid">
                <a class="navbar-brand" href="../../controllers/homeCtrl.php">Theme Hospital</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../../controllers/patients/addCtrl.php">Ajout Patient</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../controllers/patients/listCtrl.php?page=1">Patients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../controllers/appointements/addCtrl.php">Prise de RDV</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../controllers/appointements/listCtrl.php">Rendez-vous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../controllers/addBothCtrl.php">Ajout Patient & Rendez-vous</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>