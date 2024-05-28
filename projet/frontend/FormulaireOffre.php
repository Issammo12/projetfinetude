
    <form action="../../auth/update_annonce.php" method="post">
        <div class="profile-container">
                <h1>Entrer les informations de votre offre à publier:</h1>
                <input type="text" name="titre"  placeholder="Entrer le titre de l'offre:"/>
                <textarea name="description" placeholder="Entrer la description :"></textarea>
                <input type="text" name="duration" placeholder="Entrer la durée du stage :" required/>
                <input type="text" name="skills_required" placeholder="Entrer vos compétences désirées  :" required/>
                <input type="submit" value="Publier" id='button' />
        </div>
    </form>
