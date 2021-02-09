<?php

  require_once "connection.php";
  require_once "json_encoder.php";
  require_once "upload.php";

  if(
    isset($_POST['id_soal']) &&
    isset($_POST['username']) &&
    isset($_POST['solusi'])
  ){

    $id_soal = $_POST['id_soal'];
    $username = $_POST['username'];
    $solusi = $_POST['solusi'];
    $gambar = UploadFile();

    if($gambar['status'] == 1)
    {
      $statement = $connection->prepare(
        "INSERT INTO tb_solusi VALUES (NULL, ?, ?, ?, ?, current_timestamp())"
      );
      $statement->bind_param(
        "isss",
        $id_soal, $username, $solusi, $gambar['message']
      );

      $statement->execute() ?
        GetStatement($statement) :
        GetStatement($statement);
      $statement->close();
    }
    else
    {
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

 ?>
