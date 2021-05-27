<?php
require('inc/function.php');
// traitement du formulaire
$errors = array();
// formulaire est soumis
if(!empty($_POST['submitted'])) {
  // Faille XSS
  $nom = trim(strip_tags($_POST['nom']));
  $prenom = trim(strip_tags($_POST['prenom']));
  $message = trim(strip_tags($_POST['message']));
  /////////////////////////
  // Validation
  /////////////////////////
  // NOM renseigné , min 3 caractéres , max de 50 caracteres
  if(!empty($nom)) {
    if(mb_strlen($nom) < 3) {
      $errors['nom'] = 'Min 3 caractères';
    }elseif(mb_strlen($nom) > 50) {
      $errors['nom'] = 'Max 50 caractères';
    } else {
      // pas d'error pour ce champ
    }
  } else {
    $errors['nom'] = 'Veuillez renseigner ce champ';
  }
  // prenom
  if(!empty($prenom)) {
    if(mb_strlen($prenom) < 3) {
      $errors['prenom'] = 'Min 3 caractères';
    }elseif(mb_strlen($prenom) > 60) {
      $errors['prenom'] = 'Max 60 caractères';
    }
  } else {
    $errors['prenom'] = 'Veuillez renseigner ce champ';
  }


  // message
  if(!empty($message)) {
    if(mb_strlen($message) < 10) {
      $errors['message'] = 'Min 10 caractères';
    }elseif(mb_strlen($message) > 500) {
      $errors['message'] = 'Max 500 caractères';
    }
  } else {
    $errors['message'] = 'Veuillez renseigner ce champ';
  }

}
include('inc/header.php'); ?>
  <div class="wrap">
    <form action="" method="post">
      <!-- NOM* -->
      <label for="nom">Nom *</label>
      <input type="text" id="nom" name="nom" value="<?php if(!empty($_POST['nom'])) { echo $_POST['nom']; } ?>">
      <span class="error"><?php if(!empty($errors['nom'])) { echo $errors['nom']; } ?></span>
      <!-- PRENOM* => input type="text" min 3 max 60 -->
      <label for="prenom">Prenom *</label>
      <input type="text" id="prenom" name="prenom" value="<?php if(!empty($_POST['prenom'])) { echo $_POST['prenom']; } ?>">
      <span class="error"><?php if(!empty($errors['prenom'])) { echo $errors['prenom']; } ?></span>

      <!-- Message* => textarea  min 10 max 500 -->
      <label for="message">Message *</label>
      <textarea name="message"><?php if(!empty($_POST['message'])) { echo $_POST['message']; } ?></textarea>
      <span class="error"><?php if(!empty($errors['message'])) { echo $errors['message']; } ?></span>

      <input type="submit" name="submitted" value="Envoyer">
    </form>
  </div>
<?php include('inc/footer.php');
