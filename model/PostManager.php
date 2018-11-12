<?php
namespace Alaska\Model;
require_once('model/Manager.php');

class PostManager extends Manager{

    public function getPosts() {
        $db = $this -> dbConnect();
        // TODO : requete ---> $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    public function getPost($postId) {
        $db = $this -> dbConnect();
        // TODO : requete ---> $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function addPost() {
        $db = $this -> dbConnect();
        // TODO : requete ---> $req = $db->query('INSERT ....');

        return $req;              
    }
    
     public function editPost() {
        $db = $this -> dbConnect();
        // TODO : requete ---> $req = $db->query('INSERT ....');

        return $req;              
    }
    
    
    
    public function deletePost($postId){
         $db = $this -> dbConnect();
        // TODO : requete ---> $req = $db->query('DELETE ....');

        return $req;             
    }
}
