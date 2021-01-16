<?php

  if(isset($_GET['task'])){
    $requestPart = explode('/', $_GET['task']);
    $task = strtolower($requestPart[0]);
    $username = isset($requestPart[1]) ? strtolower($requestPart[1]) : NULL ;
  }

  $path = "guru";

  switch ($task) {
    case 'insert':
      require_once "$path/insert_guru.php";
      break;
    case 'delete':
      require_once "$path/delete_guru.php";
      break;
    case 'update':
      require_once "$path/update_guru.php";
      break;
    case 'show':
      require_once "$path/fetch_guru.php";
      break;
    default:
      require_once "$path/fetch_guru.php";
      break;
  }

 ?>
