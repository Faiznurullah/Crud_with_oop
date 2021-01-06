<?php
include 'model.php';
$hapus = new database();
$id = $_REQUEST['id'];
$delete = $hapus->delete($id);

if($delete){
  header('location: read.php');
}

?>
