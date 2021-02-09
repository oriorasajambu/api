<?php

  require_once "connection.php";
  require_once "json_encoder.php";

  if(isset($_POST['username'])){

    $username = $_POST['username'];

    $query = "SELECT
    	a.id_soal,
      pertanyaan,
      a.gambar,
      coin,
      status,
      a.id_solusi,
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
  else if(isset($_POST['id_mata_pelajaran'])){
    $id_mata_pelajaran = $_POST['id_mata_pelajaran'];

    $query = "SELECT
      a.id_soal,
      a.username as penanya,
      pertanyaan,
      a.gambar,
      coin,
      status,
      b.username as penjawab,
      solusi,
      answered_at
      FROM `tb_pertanyaan` as a
      LEFT JOIN tb_solusi as b ON b.id_soal = a.id_soal
      WHERE a.id_mata_pelajaran = ? AND status = 0";

    if($statement = $connection->prepare($query)){
      $statement->bind_param("i", $id_mata_pelajaran);
      $statement->execute();
      $result = $statement->get_result();

      GetJSON($result, "data", "list");
    }
  }
  else if(isset($_POST['id_soal'])) {
    $id_soal = $_POST['id_soal'];

    $query = "SELECT * FROM `tb_pertanyaan` as a WHERE a.id_soal = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param("i", $id_soal);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();

    $query = "SELECT * FROM `tb_solusi` WHERE id_soal = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param("i", $id_soal);
    $statement->execute();
    $result = $statement->get_result();
    $jawaban = array();
    while ($row2 = $result->fetch_assoc()) {
      array_push($jawaban, $row2);
    }
    $row["jawaban"] = $jawaban;
    echo json_encode($row);
  }
  $connection->close();

  "SELECT * FROM `tb_pertanyaan` as a
LEFT JOIN tb_solusi as b ON b.id_soal = a.id_soal
WHERE a.id_soal = 25"
 ?>
