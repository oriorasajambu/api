<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['id_soal']) &&
    isset($_POST['username']) &&
    isset($_POST['solusi'])
  ){

    $id_soal = $_POST['id_soal'];
    $username = $_POST['username'];
    $solusi = $_POST['solusi'];

    $statement = $connection->prepare(
      "INSERT INTO tb_solusi VALUES (NULL, ?, ?, ?, current_timestamp())"
    );
    $statement->bind_param(
      "iss",
      $id_soal, $username, $solusi
    );

    $statement->execute() ?
      GetStatement($statement) :
      GetStatement($statement);

    $statement->close();
  }

 ?>
