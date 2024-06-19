<?php
    include_once('../../database.php');
    session_start();

    // Vérifiez si l'utilisateur est connecté
    if (!isset($_SESSION['client_id'])) {
        header("Location: ../auth/login.php"); // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
        exit();
    }

    // Récupérez l'identifiant de l'utilisateur connecté
    $client_id = $_SESSION['client_id'];

    // Requête SQL pour récupérer les informations de l'utilisateur à partir de la base de données
    $sql = "SELECT * FROM clients WHERE client_id = $client_id";
    $result = $conn->query($sql);

    // Vérifiez s'il y a des données retournées
    if ($result->num_rows > 0) {
        // Parcourez les données et affichez-les dans les champs du formulaire
        while($row = $result->fetch_assoc()) {
            $nom_complet = $row['nom_complet'];
            $telephone = $row['telephone'];
            $adresse = $row['adresse'];
            $ville = $row['ville'];
            $université = $row['université'];
            $NiveauScolaire = $row['NiveauScolaire'];
        }
    }
?>


    
    <div class="profile-container">
        <form action="../../auth/update_clients.php" method="post">
            <h1>Modifier votre profil :</h1>
            <div class="line">
                <input type="text" name="nom_complet" placeholder="Entrer votre nom_complet:" value="<?php echo $nom_complet; ?>" />
                <input type="text" name="telephone" placeholder="Entrer votre telephone:" value="<?php echo $telephone; ?>"  />
            </div>
            <div class="line">
                <input type="text" name="adresse" placeholder="Entrer votre adresse:" value="<?php echo $adresse; ?>" />
                <input type="text" name="ville" placeholder="entrer votre ville:" value="<?php echo $ville; ?>" />
            </div>
            <div class="line">
                <input type="text" name="université" placeholder="entrer votre université:" value="<?php echo $université; ?>" />
                <input type="text" name="NiveauScolaire" placeholder="entrer votre NiveauScolaire:" value="<?php echo $NiveauScolaire; ?>" />
                
            </div>
            <div class="line">
               <input type="file" name="cv" id="fileButton">
               <label for="fileButton">Inserer votre CV</label>
            </div>
            <input type="submit" value="Modifier" id='button' />
        </form>        
    </div>