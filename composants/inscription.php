<?php

require_once("database.php");

if(!empty($_POST["pseudo"]) && !empty($_POST["password"]) && !empty($_POST["confirm_password"])){

  $pseudo = htmlspecialchars($_POST["pseudo"]);
  $password = htmlspecialchars($_POST["password"]);
  $confirm_password = htmlspecialchars($_POST["confirm_password"]);
  
  if($password === $confirm_password){
    
    $check_pseudo = "SELECT COUNT(*) AS count FROM users WHERE pseudo = :pseudo";
    $query_check = $db->prepare($check_pseudo);
    $query_check->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
    $query_check->execute();
    $result = $query_check->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] == 0) {

      $password = password_hash($password, PASSWORD_ARGON2ID);

      $create_account = "INSERT INTO users (pseudo, password) VALUES (:pseudo, :password)";

      $create_query = $db->prepare($create_account);
      $create_query->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
      $create_query->bindParam(":password", $password, PDO::PARAM_STR);

      $create_query->execute();

      if($create_query->execute()){

        ?>

        <h2 class="success">Compte créé !</h2>

        <?php

      } else {

        ?>

        <h2 class="error">Erreur lors de la création du compte !</h2>

        <?php

      } 

    } else {
      echo "error";
    }

  }

}

?>

<form method="POST">
  <input type="text" name="pseudo" placeholder="Pseudo" required>
  <input type="password" name="password" placeholder="Mot de passe" required>
  <input type="password" name="confirm_password" placeholder="Re" required>
  <button type="submit">Créer mon compte</button>
</form>