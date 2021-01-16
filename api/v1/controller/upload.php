<?php

  function UploadFile(){
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $fileOK = 0;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $message = "";
    
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check === false) {
      $message = "File is not an image.";
      $fileOK = 0;
    }
    else if (file_exists($target_file)) {
      $message = "Sorry, file already exists.";
      $fileOK = 2;
    }

    else if ($_FILES["file"]["size"] > 500000) {
      $message = "Sorry, your file is too large.";
      $fileOK = 3;
    }

    else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
      $message = "Sorry, only JPG, JPEG, PNG files are allowed.";
      $fileOK = 4;
    }
    else $fileOK = 1;

    $result = array();
    switch ($fileOK) {
      case 1:
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
          $message = htmlspecialchars( basename( $_FILES["file"]["name"] ));
        else $message = "Sorry, there was an error uploading your file.";
        $upload = array('status' => 1, 'message' => $message);
        $result = array_merge($result, $upload);
        break;
      default:
        $upload = array('status' => 0, 'message' => $message);
        $result = array_merge($result, $upload);
        break;
    }
    return $result;
  }
?>
