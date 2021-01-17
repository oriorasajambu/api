<?php

  if(isset($_GET['task'])){
    $requestPart = explode('/', $_GET['task']);
    $task = strtolower($requestPart[0]);
    $username = isset($requestPart[1]) ? strtolower($requestPart[1]) : NULL ;
  }

  $path = "topup";

  switch ($task) {
    case 'insert':
      require_once "$path/insert_topup.php";
      break;
    case 'show':
      require_once "$path/fetch_topup.php";
      break;
    default:
      require_once "$path/fetch_topup.php";
      break;
  }

 ?>
