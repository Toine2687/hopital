<section id="update" class="hidden">
    <h2 class="m-auto text-center mt-5">Modification du patient</h2>
    <form method="post" class="d-flex flex-column col-10 m-auto border border-secondary mt-5 p-5 pb-3 rounded rounded-3 bg-light" novalidate>
        <fieldset class="mb-3 col-10 m-auto">

            <label for="lastname" class="form-label">Nom</label>
            <input value="<?= $patient->get_lastname() ?>" type="text" id="lastname" name="lastname" required maxlength="25" class="form-control" pattern="<?= NAME_PATTERN ?>">
            <?php echo "<p>" . ($error['lastname'] ?? '') . "</p>" ?>

            <label for="firstname" class="form-label">Prénom</label>
            <input value="<?= $patient->get_firstname() ?>" type=" text" id="firstname" name="firstname" required maxlength="25" class="form-control" pattern="<?= NAME_PATTERN ?>">
            <?php echo "<p>" . ($error['firstname'] ?? '') . "</p>" ?>
        </fieldset>
        <fieldset class="mb-3 col-10 m-auto justify-center">

            <label for="birthDate" class="form-label">Date de naissance</label>
            <input value="<?= $patient->get_birthdate() ?>" type=" date" name="birthDate" id="birthDate" required min="1910-01_01" max="<?php date('Y-m-d') ?>" class="form-control">
            <?php echo "<p>" . ($error['birthDate'] ?? '') . "</p>" ?>

            <label for="phone" class="form-label">Téléphone</label>
            <input value="<?= $patient->get_phone() ?>" type=" tel" name="phone" id="phone" maxlength="25" class="form-control">

            <label for="mail" class="form-label">E-Mail</label>
            <input value="<?= $patient->get_mail() ?>" type=" email" autocomplete="email" name="mail" id="mail" required maxlength="100" class="form-control">
            <?php echo "<p>" . ($error['mail'] ?? '') . "</p>" ?>
        </fieldset>
        <?= "<p class=\"warnMsg\">" . ($msg['add'] ?? '') . "</p>" ?>
        <button class="btn btn-outline-success m-3 align-self-end" type="submit">Modifier</button>
    </form>
</section>

