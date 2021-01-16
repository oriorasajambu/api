<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['username']) &&
    isset($_POST['id_mata_pelajaran']) &&
    isset($_POST['pertanyaan'])
  ){

    $username = $_POST['username'];
    $id_mata_pelajaran = $_POST['id_mata_pelajaran'];
    $pertanyaan = $_POST['pertanyaan'];

    $statement = $connection->prepare(
      "INSERT INTO tb_pertanyaan VALUES (NULL, ?, ?, ?, '0', NULL)"
    );
    $statement->bind_param(
      "sis",
      $username, $id_mata_pelajaran, $pertanyaan
    );
    $statement->execute() ?
      GetStatement($statement) :
      GetStatement($statement);
    $statement->close();

  }

  $connection->close();

 ?>
