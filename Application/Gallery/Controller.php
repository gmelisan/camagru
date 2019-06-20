<?php
namespace Camagru\Gallery;

class Controller
{
    public function action($gallery)
    {
        $page = (isset($_GET["page"]) ? $_GET["page"] : 1);
        if ($page <= 0) {
            $page = 1;
        }
        $sort = $this->getSort();
        $order = $this->getOrder();
        return $gallery->build($page, $sort, $order);
    }

    private function getSort() { /* same in view */
        if (isset($_GET["sort"])) {
            switch ($_GET["sort"]) {
                case "time":
                    return \Camagru\Model\Gallery::SORT_TIME;
                case "user":
                    return \Camagru\Model\Gallery::SORT_USER;
                case "likes":
                    return \Camagru\Model\Gallery::SORT_LIKE;
                case "comments":
                    return \Camagru\Model\Gallery::SORT_COMMENT;
            }
        }
        return \Camagru\Model\Gallery::SORT_TIME; /* actual default */
    }
    private function getOrder()
    {
        if (isset($_GET["order"])) {
            if ($_GET["order"] == "asc") {
                return "asc";
            } elseif ($_GET["order"] == "desc") {
                return "desc";
            }
        }
        return "desc"; /* actual default */
    }
}
