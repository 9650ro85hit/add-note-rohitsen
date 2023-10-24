<?php
$conn = mysqli_connect('localhost','root','','crud_store');

if(mysqli_connect_error()){
 die("Connection deny due to : ".mysqli_connect_error());
}




// define("UPLOAD_SRC",$_SERVER['DOCUMENT_ROOT']."/crud/fileupload/");

define('UPLOAD_SRC', $_SERVER['DOCUMENT_ROOT']."/PHP_practics/crud/store/uploads_files/");


define("FETCH_SRC","http://127.0.0.1/PHP_practics/crud/store/uploads_files/");
// define("FETCH_SR","http://localhost/PHP_PRACTICS/crud/uploads_files/")

?>