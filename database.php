<?php

$userdb = "clickrush";
$passworddb = "Titine19!";

try {

  $db = new PDO('mysql:host=mysql-clickrush.alwaysdata.net;dbname=clickrush_database', $userdb, $passworddb);

} catch (PDOException $e) {

  print "Erreur :" . $e->getMessage() . "<br/>";
  die;
  
}