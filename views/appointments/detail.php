<section id="patientProfileSection">
    <h1 class="m-auto text-center mt-5"> Rendez-vous #<?= $_GET["id"]  ?> </h1>
    <div class="profContainer">
        <img class="profImg" src="public/assets/img/appointmentPic.jpg" alt="rendez-vous">
        <div class="profData">
            <p>Rendez-vous avec <?= $appointment->firstname . " " . $appointment->lastname  ?> </p>
            <p>Date et horaire : <?= $appointment->dateHour ?></p>
            <div class="modifiers">
                <i id="modifyAppointment" class="fa-solid fa-pen"></i>
                <a href="http://hopital.localhost/controllers/appointements/detailCtrl.php?id=<?= $id ?>&delete=true"><i id="deleteAppointment" class="fa-solid fa-trash"></i></a>
            </div>
            <p> <?= $msg['deleted'] ?? '' ?> </p>
        </div>
    </div>
</section>