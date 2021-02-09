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
      "UPDATE tb_pertanyaan
      SET id_mata_pelajaran = ?, pertanyaan = ?, status = ?
      WHERE tb_pertanyaan.id_soal = ?"
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

  else if(
    isset($_POST['id_soal']) &&
    isset($_POST['id_solusi']) &&
    isset($_POST['username']) &&
    isset($_POST['coin'])
  ){
    $id_soal = $_POST['id_soal'];
    $id_solusi = $_POST['id_solusi'];
    $username = $_POST['username'];
    $coin = $_POST['coin'];

    $query = "UPDATE tb_pertanyaan
    SET status = '1', id_solusi = ?
    WHERE tb_pertanyaan.id_soal = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param(
      "ii",
      $id_solusi, $id_soal
    );
    if($statement->execute()){
      $query = "UPDATE tb_guru SET coin = coin + ? WHERE username = ?";
      $statement = $connection->prepare($query);
      $statement->bind_param(
        "is",
        $coin, $username
      );
      $statement->execute() ?
        GetStatement($statement) :
        GetStatement($statement);
    }

    $statement->close();
  }

  $connection->close();

 ?>
