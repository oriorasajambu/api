<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['id_solusi']) &&
    isset($_POST['solusi'])
  ){

    $solusi = $_POST['solusi'];
    $id_solusi = $_POST['id_solusi'];

    $statement = $connection->prepare(
      "UPDATE tb_solusi
      SET solusi = ?, answered_at = current_timestamp()
      WHERE id_solusi = ?"
    );
    $statement->bind_param(
      "si",
      $solusi, $id_solusi
    );

    $statement->execute() ?
      GetStatement($statement) :
      GetStatement($statement);

    $statement->close();
  }

 ?>
