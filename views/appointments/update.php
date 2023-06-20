<section id="updateAppointment" class="hidden">
    <h2 class="m-auto text-center mt-5">Modification du rendez-vous</h2>
    <form method="post" class="d-flex flex-column col-10 m-auto border border-secondary mt-5 p-5 pb-3 rounded rounded-3 bg-light" novalidate>
        <fieldset class="mb-3 col-10 m-auto">
            <p>Initialement prévu le <?= $appointment->dateHour ?>. </p>
            <input type="date" class="form-control" name="date" id="date" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" max="<?= Date('Y-m-d', strtotime('+300 days')) ?>">
            <select name="time" class="form-control" id="time">
                <?php
                for ($i = 8; $i <= 18; $i++)
                    foreach (MINUTESRANGE as $minutesRangeEl) {
                        echo '<option>' . $i . ':' . $minutesRangeEl . '</option>';
                    }
                ?>
            </select>
            <?php echo "<p>" . ($error['firstname'] ?? '') . "</p>" ?>
        </fieldset>
        <?= "<p class=\"warnMsg\">" . ($msg['updated'] ?? '') . "</p>" ?>
        <button class="btn btn-outline-success m-3 align-self-end" type="submit">Modifier</button>
    </form>
</section>