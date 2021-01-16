<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(isset($_POST['id_soal'])){

    $id_soal = $_POST['id_soal'];

    $statement = $connection->prepare("SELECT
    	*
    FROM
    	`tb_solusi`
    WHERE
    	id_soal = ?
    ORDER BY
    	answered_at
    ASC");

    $statement->bind_param("i", $id_soal);
    $statement->execute();

    $result = $statement->get_result();

    GetJSON($result, "data", "list");

  }

  $connection->close();
 ?>
