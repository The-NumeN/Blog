<?php

class Database {
    private $host = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "blog";
    public $connection;

    public function __construct() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("Connection failed: " .$this->connection->connect_error);
        }
    }
}

class Article {
    public $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getAllArticles() {
        $query = "SELECT * FROM Articles";
        $result = $this->db->connection->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $articles[] = $row;
            }
            return $articles;
        } else {
            return [];
        }
    }

    public function getArticleDetails($articleId) {
        $query = "SELECT * FROM Articles WHERE id_article = $articleId";
        $result = $this->db->connection->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return [];
        }
    }
        
    public function updateArticle($articleId, $newTitle, $newText) {
        $query = "UPDATE Articles SET Titre = '$newTitle', Texte = '$newText' WHERE id_article = $articleId";
        return $this->db->connection->query($query);
    }
    public function deleteArticle($articleId) {
        $query = "DELETE FROM Articles WHERE id_article = $articleId";
        return $this->db->connection->query($query);
    }
}

class Commentaire {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    
    public function addComment($articleId, $userId, $texteCommentaire) {
        $query = "INSERT INTO Commentaires (id_article, id_utilisateur, text_comm, date_heure)
                  VALUES ($articleId, $userId, '$texteCommentaire', NOW())";

        return $this->db->connection->query($query);
    }

    public function getAllCommentsWithUser($articleId) {
        $query = "SELECT commentaires.*, utilisateurs.pseudo AS user_pseudo 
              FROM commentaires
              LEFT JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id_utilisateur
              WHERE commentaires.id_article = $articleId
              ORDER BY commentaires.date_heure DESC";
        $result = $this->db->connection->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $comments[] = $row;
            }
            return $comments;
        } else {
            return [];
        }
    }
        public function deleteComment($commentId) {
            $query = "DELETE FROM Commentaires WHERE id_commentaire = $commentId";
            return $this->db->connection->query($query);
    }
    
    public function deleteCommentsForArticle($articleId) {
        $query = "DELETE FROM Commentaires WHERE id_article = $articleId";
        return $this->db->connection->query($query);
    }
    
    public function getCommentDetails($commentId) {
        $query = "SELECT * FROM Commentaires WHERE id_commentaire = $commentId";
        $result = $this->db->connection->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return [];
        }
    }
    
}

class Utilisateur {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getUserByUsername($username) {
        $query = "SELECT * FROM Utilisateurs WHERE pseudo = '$username'";
        $result = $this->db->connection->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return;
        }
    }

    public function addUser($pseudo, $passwd, $mail) {
        $passwdHashed = password_hash($passwd, PASSWORD_DEFAULT);
        $query = "INSERT INTO Utilisateurs (pseudo, passwd, mail) VALUES ('$pseudo', '$passwdHashed', '$mail')";
        return $this->db->connection->query($query);
    }
}
