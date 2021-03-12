<?php namespace Foostart\Crawler\Scripts\Stackoverflow;

use Foostart\Crawler\Scripts\Site;

class CrawlAnswers extends Site{


    /**
     * @param $url
     * @param $patterns
     * @param null $obj_tag
     */
    public function getAnswers($patterns, $questions, $obj_answer = NULL) {

        $domain = 'https://stackoverflow.com';

        foreach ($questions as $question) {


            $url_answers = $domain . $question->question_url;
            $html = $this->getContentByURL($url_answers);

//            file_put_contents(__DIR__ . '/html/answer_by_question.html', $html);


            //Regular Expression
            $pattern = $patterns->where('pattern_machine_name', 'answer-counter')->first();
            $re_counter = @$pattern->regular_expressions->first()->regular_expression_value;

            $counter = $this->getValue($re_counter, $html);

            $pages = intval(ceil($counter / 30));
            $pages = ($pages == 0) ? 1 : $pages;

            $data = [];

            $flag = true;
            for ($index = 1; $index <= $pages; $index++ ) {
                $url = $url_answers . '?page=' . $index;
                $html = $this->getContentByURL($url);

                $pattern = $patterns->where('pattern_machine_name', 'answer-description')->first();
                $re_answer_description = @$pattern->regular_expressions->first()->regular_expression_value;

                //
                /**
                 * Parse content by pattern
                 */
                $data = [
                    'answer_description' => $this->getValues($re_answer_description, $html),
                    'question_id' => $question->question_id
                ];

                if ($flag) {
                    $flag = false;
                    $question->question_description = array_shift($data['answer_description']);
                    $question->save();
                }

                /**
                 * Insert into answers
                 */
                if (!empty($obj_answer)) {
                    $obj_answer->insertItems($data);
                }

            }

        }
    }
}
