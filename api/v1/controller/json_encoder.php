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
          $data => new ArrayObject(),
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
          $data => $resultArray,
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

 ?>
