<?php
$title = htmlspecialchars($post_infos['title']);
$page = 'postView';
$description = htmlspecialchars($post_infos['excerpt']);
$image=$post_infos['id_image'];
$imagefb=substr($post_infos['id_image'], 1);
$urlCourante = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

ob_start(); ?>
    <div class="row">
        <div class="col m8 offset-m2 s10 offset-s1">
            <div class="section no-pad-bot m8 offset-m2 s10 offset-s1" id="index-banner">
                <h2 class="bleu-fonce-text">
                    <span style="font-size:0.5em">Chapitre <?= $post_infos['number_chapter'] ?></span><br> <?= $post_infos['title'] ?>
                </h2>
                <div class="infos">
                    <p class="left bold">par
                        <?= $post_infos['author'] ?>
                    </p>
                    <p class="italic">&nbsp;le
                        <?= $post_infos['post_date_fr'] ?>
                    </p>
                    <p class=""><a href="index.php">Retour à la liste des chapitres</a></p>
                    <p class="clearfix"></p>
                </div>
                <div class="contenu">
                    <img src="<?= $image ?>" alt="image d'illustration du chapitre" />
                    <?= $post_infos['content'] ?>
                </div>

                <div id="liker">
                    <?php if ($_SESSION['user_id']){
                        $likeButton = liker($post_infos['id'], $_SESSION['user_id']);
                        echo $likeButton;}
                      ?>
                </div>
                <!-- Load Facebook SDK for JavaScript -->
                <div id="fb-root"></div>
                <script>
                    (function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>

                <!-- Your share button code -->
                <div class="fb-share-button" data-href="<?= $urlCourante ?>" data-layout="button_count">
                </div>

                <div id="nav-chapitres">
                    <div class="prev-chapitre left"><a href="index.php?action=post&id=<?= $post_infos['prevChapId'] ?>" title="chapitre  du roman Allez simple pour l'Alaska">Chapitre précédent (<?= $post_infos['prevChapTitle'] ?>)</a></div>
                    <div class="next-chapitre right"><a href="index.php?action=post&id=<?= $post_infos['nextChapId'] ?>" title="chapitre  du roman Allez simple pour l'Alaska">Chapitre suivant (<?= $post_infos['nextChapTitle'] ?>)</a></div>
                </div>

                <div class="commentaires">
                    <h3>Commentaires</h3>
                    <?php

if(!isset($_SESSION['connected'])){
          ?>
                    <div class="aComment information"><p>Vous devez être connecté pour commenter. <a href="index.php?action=user" title="accéder au formulaire de connexion"> Se connecter</a></p></div>
                        <?php
}
elseif(isset($_SESSION['blacklisted']) AND ($_SESSION['blacklisted'] == true)){ ?>
                    <div class="aComment alert"><p>Il semblerait que vous soyez blacklisté, sans doute car certains de vos commentaires ont été signalés comme inappropriés par d'autres lecteurs.Vous ne pouvez plus poster de commentaires.</p></div>
                            <?php }
elseif($_SESSION['connected'] AND ($_SESSION['blacklisted'] == false)){ ?>
                            <form action="index.php?action=addComment&amp;id=<?= $post_infos['id'] ?>" method="post">
                                <div>
                                    <label for="author">Auteur</label><br />
                                    <input type="text" id="author" name="author" />
                                </div>
                                <div>
                                    <label for="comment">Commentaire</label><br />
                                    <textarea id="comment" name="comment" ></textarea>
                                </div>
                                <div>
                                    <input type="submit" />
                                </div>
                            </form>
                            <?php
                          }
        while ($comment = $comments->fetch())
        {
          ?>
            <div class="aComment" id="comment-<?= $comment['id'] ?>">
                <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le
                    <?= $comment['comment_date_fr'] ?>
                </p>
                <p>
                    <?= nl2br(htmlspecialchars($comment['content'])) ?>
                </p>
                <?php if($_SESSION['connected'] AND ($_SESSION['blacklisted'] == false)){ ?>
                <div id="flagger">
                    <?php if ($_SESSION['user_id']){
                      $flagButton = flagger($comment['id'], $_SESSION['user_id']);
                      echo $flagButton;
                      }
                    ?>
                </div>
              <?php } ?>
            </div>
            <?php
        }
        $comments->closeCursor();
        ?>
                </div>
            </div>
        </div>
    </div>
    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>
