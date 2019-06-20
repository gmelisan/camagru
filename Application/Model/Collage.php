<?php
namespace Camagru\Model;

class Collage
{
    private $pdo;
    private $info;
    private $comments;

    public function __construct($pdo, $info = [], $comments = [])
    {
        $this->pdo = $pdo;
        $this->info = $info;
        $this->comments = $comments;
    }

    public function getInfo()
    {
        return $this->info;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function build($id)
    {
        $info = $this->dbGetInfo($id);
        $comments = $this->dbGetComments($id);
        return new Collage($this->pdo, $info, $comments);
    }

    public function toggleLike()
    {

    }

    public function comment($id, $user, $text)
    {
        $query = "";
    }

    private function dbGetInfo($id)
    {
        $query = "SELECT\n"
            . "	collages.id,\n"
            . "    users.login,\n"
            . "    `date`,\n"
            . "    `src`,\n"
            . "    (SELECT COUNT(*) FROM likes WHERE collages.id = likes.collage_id) AS `likes`,\n"
            . "    (SELECT COUNT(*) FROM comments WHERE collages.id = comments.collage_id) AS `comments`\n"
            . "FROM\n"
            . "    collages\n"
            . "INNER JOIN users ON collages.user_id = users.id\n"
            . "WHERE collages.id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([":id" => $id]);
        $info = $stmt->fetch();
        return $info;
    }

    private function dbGetComments($id)
    {
        $sort = "date";
        $order = "asc";
    
        $query = "SELECT\n"
            . "    users.login,\n"
            . "    `date`,\n"
            . "    `text`\n"
            . "FROM\n"
            . "    comments\n"
            . "INNER JOIN users ON users.id = comments.user_id\n"
            . "WHERE\n"
            . "    collage_id = :id\n"
            . "ORDER BY $sort $order";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([":id" => $id]);
        $comments = $stmt->fetchAll();
        return $comments;
    }
}
