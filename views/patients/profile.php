<section id="patientProfileSection">
    <h1 id="patientName" class="m-auto text-center mt-5"><?= $patient->get_firstname() . " " . $patient->get_lastname() ?></h1>
    <div class="profContainer">
        <img class="profImg" src="public/assets/img/userProfile.png" alt="">
        <div class="profData">
            <p>Né(e) le <?= $patient->get_birthdate() ?></p>
            <p>Contact :</p>
            <p>Tel : <?= $patient->get_phone()  ?></p>
            <p>Mail : <?= $patient->get_mail()  ?></p>
            <p class="patientId">Patient #<?= $patient->get_id() ?></p>
        </div>
        <div class="modifiers">
            <i id="modifyPic" class="fa-solid fa-pen"></i>
            <a href="/controllers/patients/profileCtrl.php?id=<?= $id ?>&delete=true">LLLLL<i id="deletePatient" class="fa-solid fa-trash"></i></a>
        </div>

    </div>
</section>