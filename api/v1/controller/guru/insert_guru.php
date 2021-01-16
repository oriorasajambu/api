<?php

  require_once "connection.php";
  require_once "json_encoder.php";
  require_once "upload.php";

  if(
    isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST['nama']) &&
    isset($_POST['universitas']) &&
    isset($_POST['semester']) &&
    isset($_POST['id_mata_pelajaran'])
  ){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $universitas = $_POST['universitas'];
    $semester = $_POST['semester'];
    $id_mata_pelajaran = $_POST['id_mata_pelajaran'];
    $bukti_pembayaran = UploadFile();

    if($bukti_pembayaran["status"] == 1){
      $statement = $connection->prepare(
        "INSERT INTO tb_login VALUES (?, ?, current_timestamp(), 'guru')"
      );
      $statement->bind_param(
        "ss",
        $username, $password
      );

      if($statement->execute()){
        $statement->close();
        $statement = $connection->prepare(
          "INSERT INTO tb_guru
          VALUES (?, ?, ?, ?, ?, ?, '0')"
        );
        $statement->bind_param(
          "ssssis",
          $username, $nama, $universitas, $semester, $id_mata_pelajaran, $bukti_pembayaran['message']
        );

        $statement->execute() ?
          GetStatement($statement) :
          GetStatement($statement);

        $statement->close();
      }
      else GetStatement($statement);
    }
    else {
      echo $bukti_pembayaran["message"];
    }


  }

  $connection->close();
 ?>
