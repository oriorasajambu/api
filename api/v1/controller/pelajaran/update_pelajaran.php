<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['mata_pelajaran']) &&
    isset($_POST['nama_mata_pelajaran']) &&
    isset($_POST['coin']) &&
    isset($_POST['id_mata_pelajaran'])
  ){

    $mata_pelajaran = $_POST['mata_pelajaran'];
    $nama_mata_pelajaran = $_POST['nama_mata_pelajaran'];
    $coin = $_POST['coin'];
    $id_mata_pelajaran = $_POST['id_mata_pelajaran'];

    $query =
    "UPDATE tb_mata_pelajaran
    SET mata_pelajaran = ?, nama_mata_pelajaran = ?, coin = ?
    WHERE id_mata_pelajaran = ?";

    $statement = $connection->prepare($query);

    $statement->bind_param(
      "ssii",
      $mata_pelajaran, $nama_mata_pelajaran, $coin, $id_mata_pelajaran
    );

    $statement->execute() ?
      GetStatement($statement) :
      GetStatement($statement);

    $statement->close();

  }

  $connection->close();

 ?>
