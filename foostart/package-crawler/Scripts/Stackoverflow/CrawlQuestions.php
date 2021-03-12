<?php namespace Foostart\Crawler\Scripts\Stackoverflow;

use Foostart\Crawler\Scripts\Site;

class CrawlQuestions extends Site{


    /**
     * @param $url
     * @param $patterns
     * @param null $obj_tag
     */
    public function getQuestions($patterns, $tags, $obj_question = NULL) {

        $domain = 'https://stackoverflow.com';

        foreach ($tags as $tag) {
            $url_question = $domain . $tag->tag_url;


            //Regular Expression
            $pattern = $patterns->where('pattern_machine_name', 'tag-name')->first();
            $re_tag_name = @$pattern->regular_expressions->first()->regular_expression_value;;


            //Regular Expression
            $pattern = $patterns->where('pattern_machine_name', 'question-name')->first();
            $re_question_name = @$pattern->regular_expressions->first()->regular_expression_value;

            $pattern = $patterns->where('pattern_machine_name', 'question-url')->first();
            $re_question_url = @$pattern->regular_expressions->first()->regular_expression_value;

            $total_pages = round($tag->tag_num_questions / 50);

            for ($index = 1; $index <= $total_pages; $index++) {
                $_url = $url_question . '?tab=newest&pagesize=50&page=' . $index;

                $data = [];

                $html_question_by_tag = $this->getContentByURL($_url);
                file_put_contents(__DIR__ . '/html/question_by_tag.html', $html_question_by_tag);

                /**
                 * Parse content by pattern
                 */
                $data = [
                    'question_name' => $this->getValues($re_question_name, $html_question_by_tag),
                    'question_url' => $this->getValues($re_question_url, $html_question_by_tag),
                ];


                /**
                 * Insert into tags
                 */
                if (!empty($obj_question)) {
                    $obj_question->insertItems($data);
                }


            }

            return true;//TODO: crawl one tag
        }


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
