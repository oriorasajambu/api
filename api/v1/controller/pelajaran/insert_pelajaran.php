<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['mata_pelajaran']) &&
    isset($_POST['nama_mata_pelajaran']) &&
    isset($_POST['coin'])
  ){

    $mata_pelajaran = $_POST['mata_pelajaran'];
    $nama_mata_pelajaran = $_POST['nama_mata_pelajaran'];
    $coin = $_POST['coin'];

    $query =
    "INSERT INTO tb_mata_pelajaran VALUES (NULL, ?, ?, ?, current_timestamp())";

    $statement = $connection->prepare($query);

    $statement->bind_param(
      "ssi",
      $mata_pelajaran, $nama_mata_pelajaran, $coin
    );

    $statement->execute() ?
      GetStatement($statement) :
      GetStatement($statement);

    $statement->close();

  }

  $connection->close();

 ?>
