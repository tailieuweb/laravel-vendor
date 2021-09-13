<?php namespace Foostart\Crawler\Scripts\Work;
use Foostart\Crawler\Scripts\Work\VietnamWorks;
use Foostart\Crawler\Scripts\Work\ITviec;
use Foostart\Crawler\Scripts\Work\BaseSite;

class SiteFactory {
    public function createObject($site) {
        $object = null;
        if (!empty($site)) {
            switch ($site->site_name) {
                case 'VietnamWorks':
                    $object = new VietnamWorks(['perPage' => -1]);
                    break;
                case 'ITviec':
                    $object = new ITviec(['perPage' => -1]);
                    break;
            }
        }
        return $object;
    }
}
