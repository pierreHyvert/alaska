<?php $title = 'Admin';
$page = 'adminView';
$description = '';
//$postToEdit = postToArray();
 ?>

 <?php ob_start(); ?>


admin


 <?php $content = ob_get_clean(); ?>
 <?php require('template.php'); ?>
