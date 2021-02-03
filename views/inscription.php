<section><h2> Inscription </h2>
<form action="index.php?action=inscription" method="post">
 
   <fieldset>
       <legend>Vos coordonnées</legend>

       <p><label for="nom">Nom :</label>
       <input type="text" name="nom"/></p>

       <p><label for="prenom">Prénom :</label>
       <input type="text" name="prenom"/></p>
 
      <p> <label for="telephone">Numéro de téléphone :</label>
       <input type="telephone" name="telephone"/></p>
       
      <p> <label for ="email">E-mail :</label>
       <input type="text" name="email"></p>
       
      <p> <label for="codepostale">Code Postale :</label>
       <input type="text" name="codepostale"> </p>
       
       <p><label for="numerocompte">Numéro de compte :</label>
       <input type="text" name="numerocompte"></p>

       <p><label for="motdepasse">Mot de passe :</label>
       <input type="password" name="motdepasse"></p>

       <p><label for="motdepasse2">Confirmez votre mot de passe :</label>
        <input type="password" name="motdepasse2"></p>

   </fieldset>


   <p><input type="submit" name="inscrire" value="S'inscrire"></p>

   <?php echo $notification; ?>

   <p><a href="index.php?action=accueil">Retour à la page d'accueil</a></p>
   </form>
 </section>