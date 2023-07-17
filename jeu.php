<?php
require_once("composants/database.php");
require_once("composants/header.php");
session_start();

if(isset($_POST["hidden"])) {
  $score = $_POST["hidden"];
  $id = $_SESSION["id"];
  $player = $_SESSION["pseudo"];

  if($score != 0){
    $sql = "INSERT INTO leaderboard(`player`, `score`) VALUES (:player, :score)";
    $query = $db->prepare($sql);
    $query->bindParam(":player", $player, PDO::PARAM_STR);
    $query->bindParam(":score", $score, PDO::PARAM_INT);
    $query->execute();
    
    header("Location: jeu.php");
    exit();
  }
}
?>

<div class="container-game">
  <p id="valeur">0</p>
  <button class="click" type="button">Click me !</button>
</div>

<form id="myForm" method="POST" class="form-account">
  <input type="hidden" name="hidden" value="0">
  <button type="submit" class="btn-login">Envoyer mon score</button>
</form>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var bouton = document.querySelector(".click");
    var valeurParagraphe = document.getElementById("valeur");
    var compteur = 0;

    bouton.onclick = function() {
      compteur++;
      valeurParagraphe.textContent = compteur;
      document.querySelector("input[name='hidden']").value = compteur;
    };
  });
</script>

<?php

require_once("composants/leaderboard.php");

?>