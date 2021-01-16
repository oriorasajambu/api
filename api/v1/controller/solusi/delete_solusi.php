<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['id_solusi']) &&
    isset($_POST['username'])
  ){

    $id_solusi = $_POST['id_solusi'];
    $username = $_POST['username'];

    $statement = $connection->prepare(
      "DELETE
      FROM tb_solusi
      WHERE id_solusi = ? AND username = ?"
    );
    $statement->bind_param(
      "is",
      $id_solusi, $username
    );

    $statement->execute() ?
      GetStatement($statement) :
      GetStatement($statement);

    $statement->close();
  }

 ?>
