<?php
namespace Alaska\Model;


class PostManager extends Manager{

    public function getPosts() {
        $db = $this -> dbConnect();
        $req = $db->query('SELECT id, number_chapter, title, author, DATE_FORMAT(post_date, \'%d/%m/%Y\') AS post_date_fr, id_image, content, excerpt, likes, is_visible FROM chapters ORDER BY number_chapter ASC');
        return $req;
    }

    public function getPost($post_id) {
        $db = $this -> dbConnect();
        $req = $db->prepare('SELECT id, number_chapter, title, author, DATE_FORMAT(post_date, \'%d/%m/%Y\') AS post_date_fr, id_image, content, excerpt, likes, is_visible FROM chapters WHERE id = ?');
        $req->execute(array($post_id));
        $post = $req->fetch();
        return $post;
    }

    public function getPostAdmin($post_id) {
        $db = $this -> dbConnect();
        $req = $db->prepare('SELECT id, number_chapter, title, author, post_date, id_image, content, excerpt, likes, is_visible FROM chapters WHERE id = ?');
        $req->execute(array($post_id));
        $post = $req->fetch();
        return $post;
    }

    public function getVisiblePosts() {
        $db = $this -> dbConnect();
        $req = $db->query('SELECT id, number_chapter, title, author, DATE_FORMAT(post_date, \'%d/%m/%Y\') AS post_date_fr, id_image, content, excerpt, likes, is_visible FROM chapters WHERE is_visible = "on" ORDER BY number_chapter ASC');
        return $req;
    }

    public function getPostInfos($posts, $post_id) {
      $allPosts = [];
      $i = 0;
      $post_index = 0;
      $prev_index = 0;
      $next_index = 0;
      while ($post = $posts->fetch()){
        if ($post['id'] == $post_id){
          $post_index = $i;}
        $allPosts[] = $post;
        $i++;
      }
      if($post_index == 0){
        $prev_index = $i-1;
        $next_index = $post_index + 1;
      }
      elseif($post_index == $i-1){
        $prev_index = $post_index - 1;
        $next_index = 0;
      }
      else{
        $prev_index = $post_index - 1;
        $next_index = $post_index + 1;
      }
      $the_good_post = $allPosts[$post_index];
      $previous_post = $allPosts[$prev_index];
      $next_post = $allPosts[$next_index];
      $the_good_post['prevChapId'] = $previous_post['id'];
      $the_good_post['prevChapTitle'] = $previous_post['title'];
      $the_good_post['nextChapId'] = $next_post['id'];
      $the_good_post['nextChapTitle'] = $next_post['title'];
      return $the_good_post;
    }

    public function addPost($number_chapter, $title, $author, $post_date, $id_image, $content, $excerpt, $is_visible ) {
        $db = $this -> dbConnect();
        $date_field = date('Y-m-d',strtotime($post_date));
        $post = $db->prepare("INSERT INTO chapters (number_chapter, title, author, post_date, id_image, content, excerpt, likes, is_visible) VALUES(:number_chapter, :title, :author, :post_date, :id_image, :content, :excerpt, 0, :is_visible)");
        $affectedLines = $post-> execute(array(
          'number_chapter' => $number_chapter,
          'title' => $title,
          'author' => $author,
          'post_date' => $date_field,
          'id_image' => $id_image,
          'content' => $content,
          'excerpt' => $excerpt,
          'is_visible' => $is_visible
        )) or die(print_r($post->errorInfo()));

        return $affectedLines;
    }

     public function updatePost($post_id, $number_chapter, $title, $author, $post_date, $id_image, $content, $excerpt, $is_visible) {
       $date_field = date('Y-m-d',strtotime($post_date));
        $db = $this -> dbConnect();
        $post = $db->prepare('UPDATE chapters SET number_chapter = :number_chapter, title = :title, author = :author, post_date = :post_date, id_image = :id_image, content = :content, excerpt = :excerpt, is_visible = :is_visible WHERE id = :id');
        $affectedLines = $post-> execute(array(
          'number_chapter' => $number_chapter,
          'title' => $title,
          'author' => $author,
          'post_date' => $date_field,
          'id_image' => $id_image,
          'content' => $content,
          'excerpt' => $excerpt,
          'is_visible' => $is_visible,
          'id' => $post_id
        ));
        return $affectedLines;
    }


    public function likePost($post_id, $likes){
        $db = $this->dbConnect();
        $thePost = $db->prepare('UPDATE chapters SET likes = ? WHERE id = ?');
        $replacedPost = $thePost->execute(array($likes, $post_id));
        return $replacedPost;
    }


    public function checkLikes($post_id, $user_id){
      $db = $this->dbConnect();
      $theLikes = $db->prepare('SELECT id FROM likes WHERE post_id = :post_id AND user_id = :user_id');
      $theLikes-> execute(array(
        'post_id' => $post_id,
        'user_id' => $user_id)) or die(print_r($theLikes->errorInfo()));
      $theLike = $theLikes->fetch();
      $theLike = $theLike['id'];
      return $theLike;
    }


    public function likesManagement($post_id, $user_id){
        $theLike = $this->checkLikes($post_id, $user_id);
          if ($theLike == null){
            $db = $this->dbConnect();
            $theNewLike = $db->prepare('INSERT INTO likes(post_id, user_id) VALUES (:post_id, :user_id)');
            $newLike = $theNewLike->execute(array(
              'post_id' => $post_id,
              'user_id' => $user_id)) or die(print_r($theNewLike->errorInfo()));
              return('liked');
          }
          elseif ($theLike>0){
            $db = $this->dbConnect();
            $theNewLike = $db->prepare('DELETE FROM likes WHERE id = ?');
            $newLike = $theNewLike->execute(array($theLike)) or die(print_r($theNewLike->errorInfo()));
            return('unliked');
          }
    }



    public function deletePost($postId){
        $db = $this -> dbConnect();
        $req = $db->prepare('DELETE FROM chapters WHERE id = ?');
        $req->execute(array($postId));
        return $req;
    }
}
