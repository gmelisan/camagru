<?php
namespace Camagru\Collage;

class Controller
{
    public function action($collage)
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        } else {
            $id = -1;
        }
        return $collage->build($id);
    }
}