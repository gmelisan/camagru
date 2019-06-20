<?php
namespace Camagru\Gallery;

class View extends \Camagru\BaseView
{
    public function getPage($gallery)
    {
        $page["title"] = "Галлерея";
        $page["src"] = "Application/Gallery/pages/gallery.php";
        $page["items"] = $gallery->getItems();
        $page["page"] = $gallery->getPage();
        $page["total_pages"] = $gallery->getTotalPages();
        $sort = $gallery->getSort();
        $sort = $this->getStrSort($sort);
        $order = $gallery->getOrder();
        $page["html_sort"] = "sort=$sort&order=$order";
        return $page;
    }

    private function getStrSort($sort) /* same in controller */
    {
        switch ($sort) {
            case \Camagru\Model\Gallery::SORT_TIME:
                return "time";
            case \Camagru\Model\Gallery::SORT_USER:
                return "user";
            case \Camagru\Model\Gallery::SORT_LIKE:
                return "likes";
            case \Camagru\Model\Gallery::SORT_COMMENT:
                return "comments";
        }
    }
}
