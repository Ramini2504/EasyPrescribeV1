<?php

  $con = new PDO("mysql:host=localhost;dbname=medicine", 'root', '');

if (isset($_GET["search"])) {
  $str = $_GET["search"];
  $sth = $con->prepare("SELECT DISTINCT Medics FROM `medics` WHERE Medics LIKE :search");
  $sth->bindValue(":search", "%$str%");
  $sth->execute();

  $suggestions = array();
  while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $suggestions[] = $row["Medics"];
  }

  header('Content-Type: application/json');
  echo json_encode($suggestions);
}
?>

