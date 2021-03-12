<?php namespace Foostart\Crawler\Scripts;


class Site
{
    public function getContentByURL($url) {
        try {
            $content = file_get_contents($url);
            return $content;
        } catch (\Exception $e) {
            return NULL;
        }
    }

    public function getValues($pattern, $content) {
        $values = [];
        preg_match_all($pattern, $content, $matches);

        if (!empty($matches[1])) {
            $values = $matches[1];
        }
        return $values;
    }

    public function getValue($pattern, $content) {
        preg_match_all($pattern, $content, $matches);

        $value = 0;
        if (!empty($matches[1]) && !empty($matches[1][0])) {
            $value = $matches[1][0];
        }

        return intval($value);
    }
}
