<section class="selfAppointments container d-flex flex-column"">
    <h2 class=" m-auto text-center mt-5">Rendez-vous</h2>
    <table>
        <tr>
            <th>Date et horaire</th>
        </tr>
        <?php
        foreach ($selfAppointments as $selfAppointment) {
            echo '<tr><td>' . $selfAppointment->dateHour . '</td></tr>';
        }
        ?>
    </table>
</section>