<?php

  require_once "connection.php";
  require_once "json_encoder.php";
  require_once "upload.php";

  if(
    isset($_POST['username']) &&
    isset($_POST['id_mata_pelajaran']) &&
    isset($_POST['pertanyaan']) &&
    isset($_POST['coin'])
  ){

    $username = $_POST['username'];
    $id_mata_pelajaran = $_POST['id_mata_pelajaran'];
    $pertanyaan = $_POST['pertanyaan'];
    $coin = $_POST['coin'];
    $gambar = UploadFile();

    if($gambar['status'] == 1){
      $statement = $connection->prepare(
        "INSERT INTO tb_pertanyaan VALUES (NULL, ?, ?, ?, ?, ?, '0', NULL)"
      );
      $statement->bind_param(
        "siiss",
        $username, $id_mata_pelajaran, $coin, $pertanyaan, $gambar['message']
      );
      $statement->execute() ?
        GetStatement($statement) :
        GetStatement($statement);
      $statement->close();
    }
    else {
      $code = http_response_code();
      $message = GetMessage($code);
      $json = array(
        'http_code'=>$code,
        'message'=>$message,
        'status'=>$gambar['status'],
        'error'=>$gambar['message']
      );
      echo json_encode($json);
    }

  }

  $connection->close();

 ?>
