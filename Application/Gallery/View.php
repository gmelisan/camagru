<?php
namespace Gallery;

class View {
    public function getPage($gallery) {
        $page["src"] = "Application/Gallery/pages/gallery.php";
        return $page;
    }
}