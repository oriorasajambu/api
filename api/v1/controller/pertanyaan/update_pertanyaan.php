<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['id_soal']) &&
    isset($_POST['id_mata_pelajaran']) &&
    isset($_POST['pertanyaan']) &&
    isset($_POST['status'])
  ){

    $id_soal = $_POST['id_soal'];
    $id_mata_pelajaran = $_POST['id_mata_pelajaran'];
    $pertanyaan = $_POST['pertanyaan'];
    $status = $_POST['status'];

    $statement = $connection->prepare(
      "UPDATE `tb_pertanyaan`
      SET `id_mata_pelajaran` = ?, `pertanyaan` = ?, `status` = ?
      WHERE `tb_pertanyaan`.`id_soal` = ?"
    );

    $statement->bind_param(
      "isii",
      $id_mata_pelajaran, $pertanyaan, $status, $id_soal
    );

    $statement->execute() ?
      GetStatement($statement) :
      GetStatement($statement);

    $statement->close();
  }

  $connection->close();

 ?>
