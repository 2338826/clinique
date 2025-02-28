<h3>Liste des patients de la clinique :</h3>

<!-- Formulaire pour choisir la clinique -->
<form method="GET" action="patientController.php">
    <label for="nomClinique">Sélectionnez une clinique :</label>
    <select name="nomClinique" id="nomClinique" onchange="this.form.submit()">
        <?php
        foreach ($listeClinique as $clinique) {
            $selectedClinique = (isset($_GET["nomClinique"]) && $_GET["nomClinique"] == $clinique->getNom()) ? "selected" : "";
            echo "<option value='" . $clinique->getNom() . "' $selectedClinique>" . $clinique->getNom() . "</option>";
        }
        ?>
    </select>
    <input type="hidden" name="action" value="afficherListePatient">
</form>

<h4>Patients de la clinique : <?php echo $_GET["nomClinique"] ?? "Aucune clinique sélectionnée"; ?></h4>

<table>
    <tr>
        <th>NoDossier</th>
        <th>NoAssurance Maladie</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Adresse</th>
        <th>Ville</th>
        <th>Province</th>
        <th>Code Postal</th>
        <th>Téléphone</th>
        <th>Courriel</th>
        <th>Actions</th>
    </tr>
    <!--Formulaire pour la modification et la suppression de cliniques... -->
    <form method="">
        <?php
        foreach ($listePatient as $patient) {
            echo "<tr>";
            echo "<td> " . $patient->getNoDossier() . "</td>";
            echo "<td> " . $patient->getNoAssuranceMaladie() . "</td>";
            echo "<td> " . $patient->getNom() . "</td>";
            echo "<td> " . $patient->getPrenom() . "</td>";
            echo "<td> " . $patient->getAdresse() . "</td>";
            echo "<td> " . $patient->getVille() . "</td>";
            echo "<td> " . $patient->getProvince() . "</td>";
            echo "<td> " . $patient->getCodePostal() . "</td>";
            echo "<td> " . $patient->getTelephone() . "</td>";
            echo "<td> " . $patient->getCourriel() . "</td>";
            echo '<td><input value="Modifier" onclick="document.getElementById(\'noDossier\').value =\'' . $patient->getNoDossier() . '\'; this.form.action=\'PatientController.php\'; this.form.method=\'GET\'; submit();" type="button"></td>';
            echo '<td><input value="Supprimer" type="button" onclick="if (confirm(\'Voulez-vous vraiment supprimer le patient : ' . $patient->getNoDossier() . '\')) { document.getElementById(\'noDossier\').value = \'' . $patient->getNoDossier() . '\'; this.form.action =\'PatientController.php?action=supprimerPatient\'; this.form.method = \'POST\'; submit();}"></td>';
            echo "</tr>";

        }
        ?>
        <input type="hidden" name="action" value="formulaireModifierPatient">
        <input type="hidden" id="nomClinique" name="nomClinique" value="<?php echo $_GET["nomClinique"] ?>">
        <input type="hidden" name="noDossier" id="noDossier">

    </form>
</table>

<br>
<b>Ajouter un patient :</b>
<br><br>

<!-- Formulaire pour l'ajout de patients -->
<form method="POST" action="patientController.php?action=ajouterPatient">
    <input type="hidden" name="nomClinique" value="<?php echo $_GET['nomClinique']; ?>">
    <table>
        <tr>
            <td>
                <label>NoDossier</label>
            </td>
            <td>
                <input name="noDossier" required />
            </td>
        </tr>
        <tr>
            <td>
                <label>NoAssurance Maladie</label>
            </td>
            <td>
                <input name="noAssuranceMaladie" required />
            </td>
        </tr>
        <tr>
            <td>
                <label>Nom</label>
            </td>
            <td>
                <input name="nom" required />
            </td>
        </tr>
        <tr>
            <td>
                <label>Prénom</label>
            </td>
            <td>
                <input name="prenom" required />
            </td>
        </tr>
        <tr>
            <td>
                <label>Adresse</label>
            </td>
            <td>
                <input name="adresse" required />
            </td>
        </tr>
        <tr>
            <td>
                <label>Ville</label>
            </td>
            <td>
                <input name="ville" required />
            </td>
        </tr>
        <tr>
            <td>
                <label>Province</label>
            </td>
            <td>
                <input name="province" required />
            </td>
        </tr>
        <tr>
            <td>
                <label>Code Postal</label>
            </td>
            <td>
                <input name="codePostal" required />
            </td>
        </tr>
        <tr>
            <td>
                <label>Téléphone</label>
            </td>
            <td>
                <input name="telephone" required />
            </td>
        </tr>
        <tr>
            <td>
                <label>Courriel</label>
            </td>
            <td>
                <input name="courriel" required />
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td><input type="submit" value="Ajouter" style="width:100px" /></td>
        </tr>
    </table>
</form>