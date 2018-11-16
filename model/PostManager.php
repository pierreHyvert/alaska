<?php
namespace Alaska\Model;
require_once('model/Manager.php');

class PostManager extends Manager{

    public function getPosts() {
        $db = $this -> dbConnect();
        $req = $db->query('SELECT id, number_chapter, title, author, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS post_date_fr, id_image, excerpt, likes FROM chapters ORDER BY number_chapter ASC');
        return $req;
    }

    public function getPost($postId) {
        $db = $this -> dbConnect();
        $req = $db->prepare('SELECT number_chapter, title, author, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') AS post_date_fr, id_image, excerpt, likes FROM chapters WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function addPost() {
        $db = $this -> dbConnect($number_chapter, $title, $author, $post_date, $id_image, $content, $excerpt);
        $post = $db->prepare('INSERT INTO chapters (number_chapter, title, author, post_date, id_image, content, excerpt, is_visible) VALUES(:number_chapter, :title, :author, :post_date, :id_image, :content, :excerpt, :is_visible)');
        $affectedLines = $post-> execute(array(
          'number_chapter' => $number_chapter,
          'title' => $title,
          'author' => $author,
          'post_date' => $post_date,
          'id_image' => $id_image,
          'content' => $content,
          'excerpt' => $excerpt
        ));
        return $affectedLines;
    }

     public function editPost($number_chapter, $title, $author, $post_date, $id_image, $content, $excerpt, $post_id) {
        $db = $this -> dbConnect();
        $post = $db->prepare('UPDATE chapters SET number_chapter = :number_chapter, title = :title, author = :author, post_date = :post_date, id_image = :id_image, content = :content, excerpt = :excerpt, is_visible = :is_visible WHERE id = :id');
        $affectedLines = $post-> execute(array(
          'number_chapter' => $number_chapter,
          'title' => $title,
          'author' => $author,
          'post_date' => $post_date,
          'id_image' => $id_image,
          'content' => $content,
          'excerpt' => $excerpt,
          'is_visible' => $is_visible,
          'id' => $post_id
        ));
        return $affectedLines;
    }



    public function deletePost($postId){
        $db = $this -> dbConnect();
        $req = $db->query('DELETE FROM chapters WHERE id = ?');
        $req->execute(array($postId));
        return $req;
    }
}
