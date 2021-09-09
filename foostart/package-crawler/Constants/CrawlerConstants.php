<?php namespace Foostart\Crawler\Constants;

class CrawlerConstants {
    //Stackoverflow
    const SITE_TYPE_STACKOVERFLOW = 10;

    //Work
    const SITE_TYPE_WORK = 50;

    //List of sites
    const SITE_TYPES = [
        10 => [
            'name' => 'StackOverflow',
            'route' => 'crawler.site.stackoverflow.tag.list'
        ],
        50 => [
            'name' => 'Work',
            'route' => 'crawler.work.job.list'
        ]

    ];
}
