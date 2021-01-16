<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(
    isset($_POST['id_mata_pelajaran'])
  ){

    $id_mata_pelajaran = $_POST['id_mata_pelajaran'];

    $query =
    "DELETE FROM tb_mata_pelajaran
    WHERE id_mata_pelajaran = ?";

    $statement = $connection->prepare($query);

    $statement->bind_param(
      "i",
      $id_mata_pelajaran
    );

    $statement->execute() ?
      GetStatement($statement) :
      GetStatement($statement);

    $statement->close();

  }

  $connection->close();

 ?>
