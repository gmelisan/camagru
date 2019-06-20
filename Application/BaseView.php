<?php
namespace Camagru;

abstract class BaseView
{
    abstract public function getPage($model);

    protected function preparePage($page)
    {
        $new = [];
        foreach ($page as $key => $val) {
            if (is_string($val)) {
                $new[$key] = htmlspecialchars($val);
            } else {
                $new[$key] = $val;
            }
        }
        return $new;
    }
}
