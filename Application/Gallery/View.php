<?php
namespace Gallery;

class View {
    public function getPage($gallery) {
        $page["title"] = "Галлерея";
        $page["src"] = "Application/Gallery/pages/gallery.php";
        return $page;
    }
}