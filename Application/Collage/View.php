<?php
namespace Camagru\Collage;

class View extends \Camagru\BaseView
{
    public function getPage($collage)
    {
        $page["title"] = "Коллаж";
        $info = $collage->getInfo();
        $comments = $collage->getComments();
        if (empty($info)) {
            $page["src"] = "Application/Collage/pages/empty.php";
            return $page;
        }
        $page["src"] = "Application/Collage/pages/collage.php";
        $page["id"] = $info["id"];
        $page["login"] = $info["login"];
        $page["date"] = $info["date"];
        $page["img_src"] = $info["src"];
        $page["like_count"] = $info["likes"];
        $page["comment_count"] = $info["comments"];
        $page["comments"] = $comments;
        
        return $page;
    }
}