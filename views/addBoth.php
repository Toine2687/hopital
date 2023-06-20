<section id="add">
    <h1 class="m-auto text-center mt-5">Ajout Patient & Rendez-vous</h1>
    <form method="post" class="d-flex flex-column col-8 m-auto border border-secondary mt-5 p-5 pb-3 rounded rounded-3 bg-light" novalidate>

        <!-- // ------------------Fieldset Patient -->

        <fieldset class="mb-3 col-8 m-auto">
            <legend>Identité du Patient</legend>

            <label for="lastname" class="form-label">Nom</label>
            <input type="text" id="lastname" name="lastname" required maxlength="25" class="form-control" pattern="<?= NAME_PATTERN ?>">
            <?php echo "<p>" . ($error['lastname'] ?? '') . "</p>" ?>

            <label for="firstname" class="form-label">Prénom</label>
            <input type="text" id="firstname" name="firstname" required maxlength="25" class="form-control" pattern="<?= NAME_PATTERN ?>">
            <?php echo "<p>" . ($error['firstname'] ?? '') . "</p>" ?>
        </fieldset>
        <fieldset class="mb-3 col-8 m-auto justify-center">

            <label for="birthDate" class="form-label">Date de naissance</label>
            <input type="date" name="birthDate" id="birthDate" required min="1910-01_01" max="<?php date('Y-m-d') ?>" class="form-control">
            <?php echo "<p>" . ($error['birthDate'] ?? '') . "</p>" ?>

            <label for="phone" class="form-label">Téléphone</label>
            <input type="tel" name="phone" id="phone" maxlength="25" class="form-control">

            <label for="mail" class="form-label">E-Mail</label>
            <input type="email" autocomplete="email" name="mail" id="mail" required maxlength="100" class="form-control">
            <?php echo "<p>" . ($error['mail'] ?? '') . "</p>" ?>
        </fieldset>

        <!-- // ------------------Fieldset Appointment -->

        <fieldset class="mb-3 col-8 m-auto">
            <legend>Rendez-vous</legend>

            <label for="dateHour" class="form-label">Date et horaire</label>
            <input type="date" class="form-control" name="date" id="date" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" max="<?= Date('Y-m-d', strtotime('+300 days')) ?>">
            <select name="time" class="form-control" id="time">
                <?php
                for ($i = 8; $i <= 18; $i++)
                    foreach (MINUTESRANGE as $minutesRangeEl) {
                        echo '<option>' . $i . ':' . $minutesRangeEl . '</option>';
                    }
                ?>
            </select>
            <?php echo "<p>" . ($error['dateHour'] ?? '') . "</p>" ?>

        </fieldset>

        <?= "<p class=\"warnMsg\">" . ($msg['add'] ?? '') . "</p>" ?>

        <!-- // ------------------Validation -->

        <button class="btn btn-outline-success m-3 align-self-end" type="submit">Valider</button>
    </form>
</section>