<?php namespace Foostart\Crawler\Scripts\Work;
use Foostart\Crawler\Constants\CrawlerConstants;
use Foostart\Crawler\Models\Sites;
use Foostart\Crawler\Scripts\Work\BaseSite;
use Foostart\Crawler\Models\Patterns;

class Jobs {

    protected $obj_sites;
    protected $siteWorks;
    protected $siteFactory;
    protected $obj_patterns;

    public function __construct() {
        $this->obj_sites = new Sites();
        $this->obj_sites->setPerPage(0);
        $params = [
          'site_type' => CrawlerConstants::SITE_TYPE_WORK
        ];
        $this->siteWorks = $this->obj_sites->selectItems($params);
        $this->siteFactory = new SiteFactory();
        $this->obj_patterns = new Patterns(['perPage' => -1]);
    }

    public function crawler() {

        if ($this->siteWorks) {
            foreach ($this->siteWorks as $siteWork) {
                $site = $this->siteFactory->createObject($siteWork);
                if (!empty($site)) {
                    $patterns = $this->obj_patterns->selectItems(['site_id' => $siteWork->site_id]);
                    $site->crawlJobUrlByCategory($siteWork, $patterns);
                    $site->crawlJobDetailByUrl($siteWork, $patterns);
                }
            }
        }
    }


}
