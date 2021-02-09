<?php

  if(isset($_GET['task'])){
    $requestPart = explode('/', $_GET['task']);
    $task = strtolower($requestPart[0]);
    $username = isset($requestPart[1]) ? strtolower($requestPart[1]) : NULL ;
  }

  $path = "siswa";

  switch ($task) {
    case 'insert':
      require_once "$path/insert_siswa.php";
      break;
    case 'delete':
      require_once "$path/delete_siswa.php";
      break;
    case 'update':
      require_once "$path/update_siswa.php";
      break;
    case 'show':
      require_once "$path/fetch_siswa.php";
      break;
    default:
      require_once "$path/fetch_siswa.php";
      break;
  }

 ?>
