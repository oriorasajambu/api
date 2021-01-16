<?php

  require_once "connection.php";
  require_once "json_encoder.php";
  require_once "upload.php";

  if(
    isset($_POST['username']) &&
    isset($_POST['idr']) &&
    isset($_POST['coin'])
  ){

    $username = $_POST['username'];
    $role = $_POST['role'];
    $idr = $_POST['idr'];
    $coin = $_POST['coin'];
    $bukti_pembayaran = UploadFile();

    if($bukti_pembayaran["status"] == 1){
      $statement = $connection->prepare(
        "INSERT INTO tb_topup
        VALUES (NULL, ?, ?, ?, ?, current_timestamp())"
      );
      $statement->bind_param(
        "siis",
        $username, $idr, $coin, $bukti_pembayaran['message']
      );

      if($statement->execute()){
        $query = $role == "guru" ?
        "UPDATE tb_guru SET coin = coin + ? WHERE username = ?" :
        "UPDATE tb_siswa SET coin = coin + ? WHERE username = ?";
        $statement = $connection->prepare($query);
        $statement->bind_param(
          "is",
          $coin, $username
        );
        $statement->execute() ?
          GetStatement($statement) :
          GetStatement($statement);
      }
      else GetStatement($statement);

      $statement->close();
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

 ?>
