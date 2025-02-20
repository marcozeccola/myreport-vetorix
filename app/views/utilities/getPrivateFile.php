<?php

$link =  APPROOT. "/private/".$data["type"]."/". $data["id"]."/".$data["file"];

$file_out = $link; // file to return

if (file_exists($file_out)) {
     $image_info = filesize($file_out);

     $type = mime_content_type($file_out);

     //Set the content-type header as appropriate
     header('Content-Type: ' . $type);

     //Set the content-length header
     header('Content-Length: ' . filesize($file_out));
     
     //Write the files bytes to the client
     readfile($file_out); 
} 
?>