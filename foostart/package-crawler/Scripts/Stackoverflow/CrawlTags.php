<?php namespace Foostart\Crawler\Scripts\Stackoverflow;

use Foostart\Crawler\Scripts\Site;

class CrawlTags extends Site{


    /**
     * @param $url
     * @param $patterns
     * @param null $obj_tag
     */
    public function getTags($url, $patterns, $obj_tag = NULL) {
        //Get main page tags
//        $html_main_page_tag = $this->getContentByURL($url);
        //file_put_contents(__DIR__ . '/html/main_page_tags.html', $html_main_page_tag);

        //Get total page
//        $pattern_total_page = $patterns->where('pattern_machine_name', 'tag-total-page')->first();
//        $re_tag_total_page = $pattern_total_page->regular_expressions->first()->regular_expression_value;
//        $total_page = $this->getValue($re_tag_total_page, $html_main_page_tag);
        $total_page = 1788;
        $per_page = 36;

        //Regular Expression
        $pattern = $patterns->where('pattern_machine_name', 'tag-name')->first();
        $re_tag_name = @$pattern->regular_expressions->first()->regular_expression_value;;

        $pattern = $patterns->where('pattern_machine_name', 'tag-url')->first();
        $re_tag_url = @$pattern->regular_expressions->first()->regular_expression_value;


        $pattern = $patterns->where('pattern_machine_name', 'tag-overview')->first();
        $re_tag_overview = @$pattern->regular_expressions->first()->regular_expression_value;

        $pattern = $patterns->where('pattern_machine_name', 'tag-number-questions')->first();
        $re_tag_num_questions = @$pattern->regular_expressions->first()->regular_expression_value;

        $pattern = $patterns->where('pattern_machine_name', 'tag-other')->first();
        $re_tag_other = @$pattern->regular_expressions->first()->regular_expression_value;

        for ($i = 1; $i < 1789; $i++) {

            $data = [];

            //Get content html
            $_url = $url . '?' . 'page=' . $i . '&tab=popular';
            $html_main_page_tag = $this->getContentByURL($_url);

            /**
             * Parse content by pattern
             */
            $data = [
                'tag_name' => $this->getValues($re_tag_name, $html_main_page_tag),
                'tag_url' => $this->getValues($re_tag_url, $html_main_page_tag),
                'tag_overview' => $this->getValues($re_tag_overview, $html_main_page_tag),
                'tag_num_questions' => $this->getValues($re_tag_num_questions, $html_main_page_tag),
                'tag_other' => $this->getValues($re_tag_other, $html_main_page_tag),
            ];

            /**
             * Insert into tags
             */
            if (!empty($obj_tag)) {
                $obj_tag->insertItems($data);
            }
            return true;
        }
    }
}
