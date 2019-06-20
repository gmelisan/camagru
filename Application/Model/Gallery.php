<?php
namespace Camagru\Model;

class Gallery
{
    const SORT_USER = 3; /* by creator's name */
    const SORT_TIME = 4; /* by creation time */
    const SORT_LIKE = 5; /* by likes count */
    const SORT_COMMENT = 6; /* by comments count */

    private $pdo;
    private $items;
    private $page;
    private $total_pages;
    private $sort;
    private $order;
    private $limit;

    public function __construct(
        $pdo,
        $items = [],
        $page = 1,
        $sort = self::SORT_TIME,
        $order = "desc",
        $limit = 6
    ) {
        $this->pdo = $pdo;
        $this->items = $items;
        $this->page = $page;
        $this->sort = $sort;
        $this->order = $order;
        $this->limit = $limit;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getSort()
    {
        return $this->sort;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function build(
        $page = 1, /* current page number */
        $sort = self::SORT_TIME,
        $order
    ) {
        $offset = ($page - 1) * $this->limit;

        /* additional check just for sure */
        if ($order != "asc" && $order != "desc") {
            $order = "asc"; 
        }
        $str_sort = $this->getSortStr($sort);
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
            . "ORDER BY $str_sort $order \n"
            . "LIMIT :offset, :limit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":offset", (int)$offset, \PDO::PARAM_INT);
        $stmt->bindValue(":limit", (int)$this->limit, \PDO::PARAM_INT);
        $stmt->execute();
        $items = $stmt->fetchAll();
        return new Gallery($this->pdo, $items, $page, $sort, $order);
    }

    public function getTotalPages()
    {
        $query = "SELECT COUNT(*) FROM collages";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $res = $stmt->fetch();
        return $res[0] / $this->limit + 1;
    }

    private function getSortStr($sort)
    {
        switch ($sort) {
            case self::SORT_USER:
                return "login";
            case self::SORT_TIME:
                return "date";
            case self::SORT_LIKE:
                return "likes";
            case self::SORT_COMMENT:
                return "comments";
        }
    }

}
