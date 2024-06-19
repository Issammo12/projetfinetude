
<?php include("../../database.php"); ?>
<div class="bareRecherche">
    <form action="" method="post">
        <select class="select" name="ville">
            <option disabled selected>Choisir la ville</option>
            <?php
            $sql = "SELECT DISTINCT ville_entreprise FROM entreprise";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) { ?>
                    <option value="<?php echo htmlspecialchars($row["ville_entreprise"]); ?>"><?php echo htmlspecialchars($row["ville_entreprise"]); ?></option>
                <?php }
            }
            ?>
        </select>
        <select class="select" name="duration">
            <option disabled selected>Choisir la duration</option>
            <?php
            $sql = "SELECT DISTINCT duration FROM offredestage";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) { ?>
                    <option value="<?php echo htmlspecialchars($row["duration"]); ?>"><?php echo htmlspecialchars($row["duration"]); ?></option>
                <?php }
            }
            ?>
        </select>
        <select class="select" name="skills">
            <option disabled selected>Choisir les competences</option>
            <?php
            $sql = "SELECT DISTINCT skills_required FROM offredestage";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) { ?>
                    <option value="<?php echo htmlspecialchars($row["skills_required"]); ?>"><?php echo htmlspecialchars($row["skills_required"]); ?></option>
                <?php }
            }
            ?>
        </select>
        <button type="submit" class="bar" name="submit">Rechercher</button>
    </form>
</div>
<div class="annonces">
    <?php
    include_once("../../database.php");
    if (isset($_POST["submit"])) {
        $ville = isset($_POST["ville"]) ? $_POST["ville"] : '';
        $duration = isset($_POST["duration"]) ? $_POST["duration"] : '';
        $skills = isset($_POST["skills"]) ? $_POST["skills"] : '';

        if ($ville !== '' || $duration !== '' || $skills !== '') {
            $sql = "SELECT * FROM offredestage o JOIN entreprise e ON o.entreprise_id = e.entreprise_id WHERE 1=1";
            if ($ville !== '') {
                $sql .= " AND e.ville_entreprise = '" . mysqli_real_escape_string($conn, $ville) . "'";
            }
            if ($duration !== '') {
                $sql .= " AND o.duration = '" . mysqli_real_escape_string($conn, $duration) . "'";
            }
            if ($skills !== '') {
                $sql .= " AND o.skills_required = '" . mysqli_real_escape_string($conn, $skills) . "'";
            }
            $result = mysqli_query($conn, $sql) or die("Error: " . mysqli_error($conn));

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class='annonce'>
                        <div class='parag'>
                            <h3><?php echo htmlspecialchars($row["titre"]); ?></h3>
                            <div class='info'>
                                <div id='nom'><?php echo htmlspecialchars($row["nom_complet"]); ?></div>
                                <div id='ville'><?php echo htmlspecialchars($row["ville_entreprise"]); ?></div>
                                <div id='duration'><?php echo htmlspecialchars($row["duration"]); ?></div>
                            </div>
                        </div>
                        <?php $entreprise_id = $row["entreprise_id"]; ?>
                        <div class='boutons'>
                            <form action='../../auth/traitement_candidature.php?entreprise_id=<?php echo $entreprise_id; ?>' method='post'>
                                <input type='hidden' name='offre_id' value='<?php echo $row["offre_id"]; ?>'>
                                <button type='submit' name='submit'>Postuler</button>
                            </form>
                            <form action='../../pages/Stagiere/Detail.page.php' method='post'>
                                <input type='hidden' name='offre_id' value='<?php echo $row["offre_id"]; ?>'>
                                <button type='submit' name='submitD'>Details</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "Aucune annonce disponible";
            }
        }
    } else {
        $sql = "SELECT * FROM offredestage o JOIN entreprise e ON o.entreprise_id = e.entreprise_id";
        $result = mysqli_query($conn, $sql) or die("Error: " . mysqli_error($conn));
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class='annonce'>
                    <div class='parag'>
                        <h3><?php echo htmlspecialchars($row["titre"]); ?></h3>
                        <div class='info'>
                            <div id='nom'><?php echo htmlspecialchars($row["nom_complet"]); ?></div>
                            <div id='ville'><?php echo htmlspecialchars($row["ville_entreprise"]); ?></div>
                            <div id='duration'><?php echo htmlspecialchars($row["duration"]); ?></div>
                        </div>
                    </div>
                    <?php $entreprise_id = $row["entreprise_id"]; ?>
                    <div class='boutons'>
                        <form action='../../auth/traitement_candidature.php?entreprise_id=<?php echo $entreprise_id; ?>' method='post'>
                            <input type='hidden' name='offre_id' value='<?php echo $row["offre_id"]; ?>'>
                            <button type='submit' name='submit'>Postuler</button>
                        </form>
                        <form action='../../pages/Stagiere/Detail.page.php' method='post'>
                            <input type='hidden' name='offre_id' value='<?php echo $row["offre_id"]; ?>'>
                            <button type='submit' name='submitD'>Details</button>
                        </form>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "Aucune annonce disponible";
        }
    }
    ?>
</div>
