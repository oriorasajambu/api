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
    isset($_POST['id_mata_pelajaran']) &&
    isset($_POST['token'])
  ){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $universitas = $_POST['universitas'];
    $semester = $_POST['semester'];
    $id_mata_pelajaran = $_POST['id_mata_pelajaran'];
    $token = $_POST['token'];
    $bukti_pembayaran = UploadFile();

    if($bukti_pembayaran["status"] == 1){
      $statement = $connection->prepare(
        "INSERT INTO tb_login VALUES (?, ?, current_timestamp(), 'guru', ?)"
      );
      $statement->bind_param(
        "sss",
        $username, $password, $token
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
      $code = http_response_code();
      $message = GetMessage($code);
      $json = array(
        'http_code'=>$code,
        'message'=>$message,
        'status'=>$bukti_pembayaran['status'],
        'error'=>$bukti_pembayaran['message']
      );
      echo json_encode($json);
    }

  }

  $connection->close();
 ?>
