<?php namespace Foostart\Crawler\Scripts;


class Site
{
    public function getContentByURL($url) {
        $content = file_get_contents($url);
        return $content;
    }

    public function getValues($pattern, $content) {
        $values = [];
        preg_match_all($pattern, $content, $matches);

        if (!empty($matches[1])) {
            $values = $matches[1];
        }
        return $values;
    }

}
