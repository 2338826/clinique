<form method="POST" action="CliniqueController.php?action=modifierClinique">
    <table>
        <tr>
            <td>
                <label>Nom</label>
            </td>
            <td>
                <input name="nom" readonly value="<?php echo $clinique->getNom(); ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Adresse</label>
            </td>
            <td>
                <input name="adresse" required value="<?php echo $clinique->getAdresse(); ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Ville</label>
            </td>
            <td>
                <input name="ville" required value="<?php echo $clinique->getVille(); ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Province</label>
            </td>
            <td>
                <input name="province" required value="<?php echo $clinique->getProvince(); ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <label>CodePostal</label>
            </td>
            <td>
                <input name="codePostal" required value="<?php echo $clinique->getCodePostal(); ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Telephone</label>
            </td>
            <td>
                <input name="telephone" required value="<?php echo $clinique->getTelephone(); ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Courriel</label>
            </td>
            <td>
                <input name="courriel" required value="<?php echo $clinique->getCourriel(); ?>" />
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <input type="submit" value="Modifier" style="width:100px" />
            </td>
            <td>
                <input type="submit" value="Annuler" style="width: 100px" />
            </td>
        </tr>
    </table>

</form>