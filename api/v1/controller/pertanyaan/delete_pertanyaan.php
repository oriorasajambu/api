<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['id_soal'])
  ){

    $id_soal = $_POST['id_soal'];

    $statement = $connection->prepare(
      "DELETE
      FROM `tb_pertanyaan`
      WHERE `tb_pertanyaan`.`id_soal` = ?"
    );
    $statement->bind_param(
      "i",
      $id_soal
    );

    $statement->execute() ?
      GetStatement($statement) :
      GetStatement($statement);

    $statement->close();
  }

  $connection->close();
 ?>
