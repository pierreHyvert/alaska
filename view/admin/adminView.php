<?php $title = 'Admin';
$page = 'adminView';
$description = '';
//$postToEdit = postToArray();
 ?>

 <?php ob_start(); ?>


<a href="index.php?action=addPost">Ajouter un chapitre</a>


 <?php $content = ob_get_clean(); ?>
 <?php require('template.php'); ?>
