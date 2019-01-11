<?php
namespace Alaska\Model;

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
        $theComment = $db->prepare('SELECT id, id_chapter, author, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, content, flags, likes FROM comments WHERE id = ?');
        $theComment->execute(array($commentId));
        return $theComment;
    }

    public function flagComment($comment_id, $flags){
        $db = $this->dbConnect();
        $theComment = $db->prepare('UPDATE comments SET flags = ? WHERE id = ?');
        $replacedComment = $theComment->execute(array($flags, $comment_id));
        return $replacedComment;
    }

    public function checkFlags($comment_id, $user_id){
      $db = $this->dbConnect();
      $theFlags = $db->prepare('SELECT id FROM flags WHERE comment_id = :comment_id AND user_id = :user_id');
      $theFlags-> execute(array(
        'comment_id' => $comment_id,
        'user_id' => $user_id)) or die(print_r($theFlags->errorInfo()));
      $theFlag = $theFlags->fetch();
      $theFlag = $theFlag['id'];
      return $theFlag;
    }


    public function flagsManagement($comment_id, $user_id){
        $theFlag = $this->checkFlags($comment_id, $user_id);
          if ($theFlag == null){
            $db = $this->dbConnect();
            $theNewFlag = $db->prepare('INSERT INTO flags(comment_id, user_id) VALUES (:comment_id, :user_id)');
            $newFlag = $theNewFlag->execute(array(
              'comment_id' => $comment_id,
              'user_id' => $user_id)) or die(print_r($theNewFlag->errorInfo()));
              return('flagged');
          }
          elseif ($theFlag>0){
            $db = $this->dbConnect();
            $theNewFlag = $db->prepare('DELETE FROM flags WHERE id = ?');
            $newFlag = $theNewFlag->execute(array($theFlag)) or die(print_r($theNewFlag->errorInfo()));
            return('unflagged');
          }
    }

    public function deleteComment($comment_id, $post_id, $author, $comment){
        $db = $this->dbConnect();
        // TODO : requete ---> $theComment = $db->prepare('UPDATE comments SET post_id = ?, author = ?, comment = ? , comment_date = NOW() WHERE id = ?');
        $replacedComment = $theComment->execute(array($post_id, $author, $comment, $comment_id));
        return $replacedComment;
    }
}
