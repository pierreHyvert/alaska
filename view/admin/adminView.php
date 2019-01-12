<?php $title = 'Admin';
$page = 'adminView';
$description = '';
ob_start(); ?>


     <div id="adminPostList">
       <h3 class="bleu-clair-text">Liste des chapitres</h3>
       <?php
       while ($data = $posts->fetch())
         { ?>
         <article class="card-panel <?php if($data['is_visible'] != "on"){echo('notPublished');} ?>" id="<?= $data['id'] ?>">
           <img src="img/slide1.jpg" width='100'/>
               <p class="">
                 <a href="index.php?action=post&id=<?= htmlspecialchars($data['id']) ?>">
                   <span class="slide-chap bleu-clair-text">Chapitre <?= htmlspecialchars($data['number_chapter']) ?> - </span><?= htmlspecialchars($data['title']) ?>
                 </a>
               </p>
                 <span class="nbreLikes"><?= htmlspecialchars($data['likes']) ?> <i class="material-icons ">thumb_up</i></span>
                 <a href="index.php?action=editPost&id=<?= htmlspecialchars($data['id']) ?>" class="waves-effect deep-orange btn right">Editer le chapitre</a>
         </article>
         <?php
         } ?>

  <a href="index.php?action=addPost" class="btn-floating btn-large waves-effect waves-light red right"><i class="material-icons">add</i></a>

     </div>
   


 <?php $content = ob_get_clean(); ?>
 <?php require('templateAdmin.php'); ?>
