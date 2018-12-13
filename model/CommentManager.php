<?php
namespace Alaska\Model;
require_once('model/Manager.php');

class CommentManager extends Manager {

    public function getComments($postId) {
        $db = $this->dbConnect();
         $comments = $db->prepare('SELECT id, author, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, content, flags, likes FROM comments WHERE id_chapter = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        return $comments;
    }

    public function postComment($postId, $author, $comment) {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(id_chapter, author, comment_date, content) VALUES(?, ?, NOW(), ?)');
        $affectedLines = $comments->execute(array($postId, $author, $comment));
        return $affectedLines;
    }

    public function getComment($commentId){
        $db = $this->dbConnect();
        // TODO : requete ---> $theComment = $db->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $theComment->execute(array($commentId));

        return $theComment;
    }

    public function deleteComment($comment_id, $post_id, $author, $comment){
        $db = $this->dbConnect();
        // TODO : requete ---> $theComment = $db->prepare('UPDATE comments SET post_id = ?, author = ?, comment = ? , comment_date = NOW() WHERE id = ?');

        $replacedComment = $theComment->execute(array($post_id, $author, $comment, $comment_id));
        return $replacedComment;
    }
}
