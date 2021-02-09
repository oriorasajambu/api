<?php

  function GetJSON($result, $data="data", $type="object")
  {
    $resultArray = array();
    if($result->num_rows > 0){
      if($type == "object")
      {
        $row = $result->fetch_assoc();
        $code = http_response_code();
        $message = GetMessage($code);
        $array = array(
          $data => $row,
          'http_code' => $code,
          'message' => $message,
          'count' => $result->num_rows,
        );
        echo json_encode($array);
      }
      else {
        while ($row = $result->fetch_assoc()) {
          array_push($resultArray, $row);
        }
        $code = http_response_code();
        $message = GetMessage($code);
        $array = array(
          $data => $resultArray,
          'http_code' => $code,
          'message' => $message,
          'count' => $result->num_rows
        );
        echo json_encode($array);
      }
    }
    else {
      if($type == "object"){
        $code = http_response_code();
        $message = GetMessage($code);
        $array = array(
          $data => NULL,
          'http_code' => $code,
          'message' => $message,
          'count' => $result->num_rows
        );
        echo json_encode($array);
      }
      else {
        $code = http_response_code();
        $message = GetMessage($code);
        $array = array(
          $data => NULL,
          'http_code' => $code,
          'message' => $message,
          'count' => $result->num_rows
        );
        echo json_encode($array);
      }
    }
  }

  function GetStatement($statement)
  {
    $result = array();
    $code = http_response_code();
    $message = GetMessage($code);
    $error = $statement->error != "" ? $statement->error : NULL;
    $status = $statement->affected_rows;
    $json = array(
      'http_code'=>$code,
      'message'=>$message,
      'status'=>$status,
      'error'=>$error
    );
    $result = array_merge($result, $json);
    echo json_encode($result);
  }

  function SendNotification($title, $message, $receiver)
  {
    $url = "https://fcm.googleapis.com/fcm/send";
    $header = [
        'authorization: key=AAAAFSLFMTs:APA91bFwhAsgY91wLXZRhiRYPk95SA6TaEWGV7-6YeE2Se-nlnSvtgiOAtI2_3gzk586ckiTFqPhn5dBGEe1FyUW3DsbKz-724dufh7IzXjiu3vUnoO5eudvQdlPZzLh5eND6gr80cJX',
        'content-type: application/json'
    ];

    $data = [
        'title' =>$title,
        'body' => $message
    ];

    $fcmNotification = [
        'to'   => $receiver,
        'data' => $data
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $result = curl_exec($ch);
    curl_close($ch);

    echo $result;
  }
 ?>
