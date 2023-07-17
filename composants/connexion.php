<?php

require_once("database.php");
require_once("header.php");

if(!empty($_POST)){

  if(isset($_POST["pseudo"], $_POST["password"])){

    $sql = "SELECT * FROM users WHERE pseudo = :pseudo";
    $query = $db->prepare($sql);
    $query->bindParam(":pseudo", $_POST["pseudo"], PDO::PARAM_STR);
    $query->execute();

    $user = $query->fetch();

    if(!$user){

      ?>

      <h2 class="error">Erreur lors de la tentative de connexion</h2>

      <?php

    } else {

      if(!password_verify($_POST["password"], $user["password"])){

        ?>

        <h2 class="error">Le pseudo et / ou le mot de passe sont incorrects.</h2>

        <?php

      } else {

        session_start();

        $_SESSION = [
          "id" => $user["id"],
          "pseudo" => $user["pseudo"]
        ];

        header("Location: jeu.php");
        exit();

      }

    }

  }

}

?>

<form method="POST" class="form-account">
  <h2 class="form-title">Connexion</h2>
  <div class="bloc-form">
    <input type="text" name="pseudo" placeholder="Votre pseudo" required>
  </div>
  <div class="bloc-form">
    <input type="password" name="password" placeholder="Mot de passe" required>
  </div>
  <div class="bloc-form">
    <button type="submit" class="btn-login">Me connecter</button>
  </div>
  <div class="bloc-form">
    <button class="btn-create" onClick="window.location.href = 'inscription.php'">Besoin d'un compte ?</button>
  </div>
</form>