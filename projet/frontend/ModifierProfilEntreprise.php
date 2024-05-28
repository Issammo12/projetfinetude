<?php
    include_once('../../database.php');
    session_start();

    
    if (!isset($_SESSION['entreprise_id'])) {
        header("Location: ../auth/login.php"); 
        exit();
    }

    
    $entreprise_id = $_SESSION['entreprise_id'];

    
    $sql = "SELECT * FROM entreprise WHERE entreprise_id = $entreprise_id";
    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            $nom_complet = $row['nom_complet'];
            $telephone_entreprise = $row['telephone_entreprise'];
            $adresse = $row['adresse'];
            $ville_entreprise = $row['ville_entreprise'];
            $domaine=$row['domaine'];
            $Raison=$row['Raison'];
           
        }
    }
?>
    <div class="profile-container">
        <form action="../../auth/update_entreprise.php" method="post">
            <h1>Modifier votre profil :</h1>
            <div class="line">
                <input type="text" name="nom_complet"   placeholder="Saisir votre nom:" value="<?php echo $nom_complet; ?>">
                <input type="text" name="Raison"   placeholder="Saisir votre raison:" value="<?php echo $nom_complet; ?>">
            </div>
            <div class="line">
                <input type="text" name="adresse"   placeholder="Saisir votre adresse:" value="<?php echo $adresse; ?>">
                <input type="text" name="ville_entreprise"  placeholder="Saisir votre ville:"  value="<?php echo $ville_entreprise; ?>">
            </div>
            <div class="line">
                <input type="text" name="domaine"  placeholder="Saisir votre domaine d'activité:" value="<?php echo $domaine; ?>"  >
                <input type="text" name="telephone_entreprise" placeholder="Entrer votre telephone:" value="<?php echo $telephone_entreprise; ?>"  />
            </div>
            <input type="submit" value="Modifier" id='button' />
        </form>        
    </div>
