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

    /**
     * Get list of site types
     */
    public function getSiteTypes() {
        $siteTypes = CrawlerConstants::SITE_TYPES;
        return $siteTypes;
    }

}
