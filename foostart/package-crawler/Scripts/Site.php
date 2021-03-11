<?php namespace Foostart\Crawler\Scripts;


class Site
{
    public function getContentByURL($url) {
        $content = file_get_contents($url);
        return $content;
    }

}
