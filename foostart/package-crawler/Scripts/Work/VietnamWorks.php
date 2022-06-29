<?php namespace Foostart\Crawler\Scripts\Work;

use Foostart\Crawler\Scripts\Work\BaseSite;
use Foostart\Crawler\Models\Works\WorksCategories;
use GuzzleHttp\Client;

class VietnamWorks extends BaseSite {
    protected $siteName = 'VietnamWorks';
    protected $obj_works_categories;
    protected $patterns;
    protected $dir_html;
    protected $baseUrl = 'https://www.vietnamworks.com/';
    protected $hitsPerPage = 200;
    public function __construct()
    {
        $this->obj_works_categories = new WorksCategories(['perPage' => -1]);
        $this->dir_html = __DIR__ . '/html/';
        parent::__construct();
    }

    public function getJobsByCategory($category) {

        //Request URL
        $url = 'https://ms.vietnamworks.com/job-search/v1.0/search';

        //Query string parameters
        $queryStringParameters = [
            'x-algolia-agent' => 'Algolia for JavaScript (3.35.1); Browser',
            'x-algolia-application-id' => 'JF8Q26WWUD',
            'x-algolia-api-key' => 'ecef10153e66bbd6d54f08ea005b60fc',
        ];
        //Generate full url
        $url = $url . http_build_query($queryStringParameters);
        //$url = 'https://jf8q26wwud-2.algolianet.com/1/indexes/*/queries?x-algolia-agent=Algolia%20for%20JavaScript%20(3.35.1)%3B%20Browser&x-algolia-application-id=JF8Q26WWUD&x-algolia-api-key=ecef10153e66bbd6d54f08ea005b60fc';
        $header = [
            "Accept" => '*/*',
            'Accept-Language' => 'en-US,en;q=0.9,vi;q=0.8',
            'Connection' => 'keep-alive',
            'Content-Type' => 'application/json',
            'Origin' => 'https://www.vietnamworks.com',
            'Referer' => 'https://www.vietnamworks.com/',
            'Sec-Fetch-Site' => 'same-site',
            'Sec-Fetch-Mode' => 'cors',
            'Sec-Fetch-Dest' => 'empty',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36',
            'X-Source' => 'Page-Container',
            'sec-ch-ua' => '" Not A;Brand";v="99", "Chromium";v="101", "Google Chrome";v="101"',
            'sec-ch-ua-mobile' => '?0',
            'sec-ch-ua-platform' => '"Windows"',
        ];
        $queryFormData = [
            'filter' => [
                [
                    'field' => 'industries.industryId',
                    'value' => '-1,35',
                ],
                [
                    'field' => 'workingLocations.cityId',
                    'value' => '29',
                ]
            ],
            "hitsPerPage" => $this->hitsPerPage,
            'order' => [
              [
                  'field' => "priorityOrder",
                  'value' => '-1,35',
              ]
            ],
            'page' => 0,
            'query' => '',
            'ranges' => [],
            'retrieveFields' => [
                "benefits",
                "jobTitle",
                "salaryMax",
                "isSalaryVisible",
                "jobLevelVI",
                "isShowLogo",
                "salaryMin",
                "companyLogo",
                "userId",
                "jobLevel",
                "jobId",
                "companyId",
                "approvedOn",
                "isAnonymous",
                "alias",
                "expiredOn",
                "industries",
                "workingLocations",
                "services",
                "companyName",
                "salary",
                "onlineOn",
                "simpleServices",
                "visibilityDisplay",
                "isShowLogoInSearch",
                "priorityOrder",
            ],

        ];
        $http = new Client;
        $total = 1000;
        for ($i = 0; $i < $total; $i++) {
            $queryFormData['page'] = $i;
            $bodyString =
                '{"requests":[{'.
                '"indexName":"vnw_job_v2_35",'.
                '"params":"query=&'.http_build_query($queryFormData).'"'.

                '}]}';

            $response = $http->post($url, [
                'headers'=> $header,
                'body' => $bodyString
            ]);

            $data =  json_decode((string) $response->getBody(), true);
            if (!empty($data) & !empty($data['results'])) {
                $this->insertJobOverview($data['results']['0']);
                $nbHits = $data['results']['0']['nbHits'];
                $total = ceil($nbHits/$this->hitsPerPage);
            } else {
                break;
            }
        }
    }

    public function insertJobOverview($jobs) {
        if (!empty($jobs) && !empty($jobs['hits'])) {
            foreach ($jobs['hits'] as $hit) {
                $job = [
                    'root_id' => $hit['jobId'],
                    'job_name' => $hit['jobTitle'],
                    'job_url' => $this->baseUrl . $hit['alias'].'-'.$hit['jobId'].'-jv'
                ];
                $this->obj_works_jobs->insertItem($job);
            }
        }
    }
    public function crawlJobUrlByCategory($siteWork, $patterns) {
        $this->patterns = $patterns;
        $params = [
            'site_id' => $siteWork->site_id
        ];

        $categories = $this->obj_works_categories->selectItems($params);

        foreach ($categories as $category) {

            $numberJobs = $this->getJobsByCategory($category);
        }

    }

    public function crawlJobDetailByUrl($siteWork, $patterns) {
        $params = [
            'status' => NULL
        ];
        $jobs = $this->obj_works_jobs->selectItems($params);
        $this->patterns = $patterns;
        $jobPatterns = [
            'job_description' => $this->patterns->where('pattern_machine_name', 'job-description')->first(),
            'job_requirements' => $this->patterns->where('pattern_machine_name', 'job-requirements')->first(),
        ];

        if(!empty($jobs)) {
            foreach ($jobs as $job) {
                if (!empty($job['job_url'])) {
                    $jobDescription = '';
                    $jobRequirements = '';
                    $htmlJobDetail = $this->getContentByURL($job['job_url']);

                    $pattern_value = $jobPatterns['job_description']->values->first();
                    if (!empty($pattern_value) && !empty($pattern_value)) {
                        $jobDescription = $this->getValues($pattern_value->regular_expression_value, $htmlJobDetail);
                        if (!empty($jobDescription[0])) {
                            $jobDescription = trim($jobDescription[0]);
                        }
                    }

                    $pattern_value = $jobPatterns['job_requirements']->values->first();
                    if (!empty($pattern_value) && !empty($pattern_value)) {
                        $jobRequirements = $this->getValues($pattern_value->regular_expression_value, $htmlJobDetail);
                        if (!empty($jobRequirements[0])) {
                            $jobRequirements = trim($jobRequirements[0]);
                        }
                    }

                    $job->job_description = $jobDescription;
                    $job->job_requirements = $jobRequirements;

                    $job->save();

                }

            }
        }
    }


}
