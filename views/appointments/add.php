<section id="addAppointment">
    <h1 class="m-auto text-center mt-5">Prise de rendez-vous</h1>

    <form method="post" class="d-flex flex-column col-10 m-auto border border-secondary mt-5 p-5 pb-3 rounded rounded-3 bg-light" novalidate>
        <fieldset class="mb-3 col-4 m-auto">

            <label for="dateHour" class="form-label">Date et horaire</label>
            <!-- <input type="datetime-local" id="dateHour" name="dateHour" required class="form-control" value="<?= date("Y-m-d 08:00") ?>"> -->
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

            <label for="patient" class="form-label">Patient : </label>
            <select name="idPatient" id="patient" class="form-select">
                <option value="select" disabled selected>Selectionnez un patient</option>
                <?php
                foreach ($patients as $patient) {
                    echo '<option value="' . $patient->id . '">' . $patient->firstname . ' ' . $patient->lastname . '</option>';
                }
                ?>

            </select>
            <?php echo "<p>" . ($error['id'] ?? '') . "</p>" ?>

        </fieldset>

        <?= "<p class=\"warnMsg\">" . ($msg['add'] ?? '') . "</p>" ?>
        <button class="btn btn-outline-success m-3 align-self-end" type="submit">Valider</button>
    </form>
</section>