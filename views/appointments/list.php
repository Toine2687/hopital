<section>
    <h1 class="m-auto text-center mt-5">Rendez-vous</h1>
    <div class="container d-flex flex-column">
        <table>
            <tr>
                <th>RDV #</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date et horaire</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            foreach ($appointments as $appointment) {
                echo '<tr>
                <td>' . $appointment->id . '</td>
                <td>' . $appointment->firstname . '</td>
                <td>' . $appointment->lastname . '</td>
                <td>' . $appointment->dateHour . '</td>
                <td> <a href="/controllers/appointements/detailCtrl.php?id=' . $appointment->id . '">🔍</a></td>
                <td> <a href="/controllers/appointements/detailCtrl.php?id=' . $appointment->id . '&delete=true"><i class="fa-solid fa-trash"></i></a></td>
                </tr>';
            }
            ?>
        </table>
    </div>