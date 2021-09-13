<?php namespace Foostart\Crawler\Scripts\Work;

use Foostart\Crawler\Scripts\Site;
use Foostart\Crawler\Models\Works\WorksJobs;

class BaseSite extends Site {
    protected $siteName;

    protected $obj_works_jobs;
    public function __construct()
    {
        $this->obj_works_jobs = new WorksJobs(['perPage' => -1]);
    }

}
