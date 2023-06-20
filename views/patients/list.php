<section>
    <h1 class="m-auto text-center mt-5">Patients</h1>
    <div class="container d-flex flex-column mt-5">
        <form method="POST" id="searchDiv" class="input-group mb-1">
                <input class="form-control border border-success" type="text" name="search" id="search" placeholder="Rechercher un patient">
                <button type="submit" class=" btn btn-outline-success"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <table>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Mail</th>
                <th>Téléphone</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            foreach ($patients as $patient) {
                echo '<tr>
                <td>' . $patient->id . '</td>
                <td>' . $patient->lastname . '</td>
                <td>' . $patient->firstname . '</td>
                <td>' . $patient->birthdate . '</td>
                <td><a href="mailto:' . $patient->mail . '">' . $patient->mail . '</a></td>
                <td><a href="tel:' . $patient->phone . '">' . $patient->phone . '</a></td>
                <td> <a href="/controllers/patients/profileCtrl.php?id=' . $patient->id . '">🔍</a></td>
                <td> <a href="/controllers/patients/profileCtrl.php?id=' . $patient->id . '&delete=true"><i class="fa-solid fa-trash"></a></td>
                </tr>';
            }
            ?>

        </table>
            <div id="pageNav" class="col-12 d-flex justify-content-end mt-2">
                <?php  
                if ($page >1){
                    echo '<p><a href="?page='.($page-1).'">Préc.</a><p>';
                }
                for ($i=1; $i < $pagesCount ; $i++) { 
                    echo '<p><a href="?page='.($i).'">Page '.$i.'</a><p>';
                }
                if ($page < $pagesCount){
                    echo '<p><a href="?page='.($page+1).'">Suiv.</a><p>';
                }
                ?>
                
            </div>
            

    </div>


</section>