<?php

  if(isset($_GET['task'])){
    $requestPart = explode('/', $_GET['task']);
    $task = strtolower($requestPart[0]);
  }

  $path = "solusi";

  switch ($task) {
    case 'insert':
      require_once "$path/insert_solusi.php";
      break;
    case 'delete':
      require_once "$path/delete_solusi.php";
      break;
    case 'update':
      require_once "$path/update_solusi.php";
      break;
    default:
      require_once "$path/fetch_solusi.php";
      break;
  }

 ?>
