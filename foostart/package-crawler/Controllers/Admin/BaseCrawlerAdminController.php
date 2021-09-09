<?php namespace Foostart\Crawler\Controllers\Admin;

/*
|-----------------------------------------------------------------------
| CrawlerAdminController
|-----------------------------------------------------------------------
| @author: Kang
| @website: http://foostart.com
| @date: 28/12/2017
|
*/


use Illuminate\Http\Request;
use URL, Route, Redirect;
use Foostart\Category\Library\Controllers\FooController;
use Foostart\Crawler\Constants\CrawlerConstants;


class BaseCrawlerAdminController extends FooController {

    public array $siteTypes;
    public array $siteTypeSelect;

    public function __construct()
    {
        parent::__construct();

        $this->data_view = array_merge($this->data_view, [
            'siteTypes' => $this->getSiteTypes(),
            'siteTypeSelect' => $this->getSiteTypeSelect(),
        ]);
    }
    /**
     * Get list of site types
     */
    public function getSiteTypes() {
        $siteTypes = CrawlerConstants::SITE_TYPES;
        return $siteTypes;
    }

    /**
     * Get list of site types with format selection
     */
    public function getSiteTypeSelect() {
        $siteTypes = $this->getSiteTypes();
        $siteTypeSelect = [];
        foreach ($siteTypes as $key => $siteType) {
            $siteTypeSelect[$key] = $siteType['name'];
        }

        return $siteTypeSelect;
    }

}
