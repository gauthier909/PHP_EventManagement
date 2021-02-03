<section>
<h2>Mon Compte</h2><br>
<form enctype="multipart/form-data" action="index.php?action=my_account" method="post">
  Mon nom : <input type="text" name="last_name" value=<?php echo $user_info->html_last_name() ?>><br>
  Mon prénom : <input type="text" name="first_name" value=<?php echo $user_info->html_first_name() ?>><br>
  Numéro de téléphone : <input type="text" name="num_phone" value=<?php echo $user_info->html_num_phone() ?>><br>
  Mon adresse mail : <input type="text" name="e_mail" value=<?php echo $user_info->html_e_mail() ?>><br>
  Mon adresse : <input type="text" name="address" value=<?php echo $user_info->html_address() ?>><br>
  Mon numéro de compte : <input type="text" name="num_account" value=<?php echo $user_info->html_num_account() ?>><br>
  Nouveau mot de passe : <input type="password" name="password" value=><br>
  Ma photo de profil : <input type="file" name="photo" value=><br>
  <?php echo $notification ?>
  <input type="submit" name="update" value="Modifier"><br>
</form>
<h2>Ma photo de profil</h2>
<?php if (is_null($user_info->html_photo())||!file_exists($user_info->html_photo())) { ?>
<img class="photo" src="<?php echo CHEMIN_VUES ?>images/blank.png" alt="image générique" />
<?php } else { ?>
<img class="photo" src="<?php echo $user_info->html_photo() ?>" alt="<?php echo $user_info->html_last_name() ?>" />
<?php } ?>
<h2>Plan d'entrainement suivi:</h2>
<h3><?php echo $follow->html_name() ?></h3>
</section>