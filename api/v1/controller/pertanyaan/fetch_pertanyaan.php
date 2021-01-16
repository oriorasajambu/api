<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(isset($_POST['username'])){

    $username = $_POST['username'];

    $query = "SELECT
    	a.id_soal,
      pertanyaan,
      status,
      COUNT(b.id_soal) as count
    FROM
    	tb_pertanyaan as a
      LEFT JOIN tb_solusi as b ON b.id_soal = a.id_soal
    WHERE
    	a.username = ?
    GROUP BY a.id_soal";

    if($statement = $connection->prepare($query)){
      $statement->bind_param("s", $username);
      $statement->execute();

      $result = $statement->get_result();

      GetJSON($result, "data", "list");
    }

  }
  $connection->close();

 ?>
