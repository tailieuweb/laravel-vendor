<?php namespace Foostart\Crawler\Scripts\Work;

use Foostart\Crawler\Scripts\Work\BaseSite;
use Foostart\Crawler\Models\Works\WorksCategories;

class ITviec extends BaseSite {
    protected $siteName = 'ItViec';
    protected $obj_works_categories;
    protected $patterns;
    protected $dir_html;
    public function __construct()
    {
        $this->obj_works_categories = new WorksCategories(['perPage' => -1]);
        $this->dir_html = __DIR__ . '/html/';

    }

    public function getNumberObJobsByCategory($category) {
        $numberJobs = 0;
        $htmlCategory = $this->getContentByURL($category->category_url);
        file_put_contents($this->dir_html . 'html_category.html', $htmlCategory);

        return $numberJobs;
    }
    public function crawlJobUrlByCategory($siteWork, $patterns) {
        $this->patterns = $patterns;
        $params = [
          'site_id' => $siteWork->site_id
        ];

        $categories = $this->obj_works_categories->selectItems($params);

        foreach ($categories as $category) {

            $numberJobs = $this->getNumberObJobsByCategory($category);
        }

    }

    public function crawlJobDetailByUrl($siteWork, $patterns) {

    }


}
