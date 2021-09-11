<?php namespace Foostart\Crawler\Helper;

use Foostart\Pexcel\Helper\PexcelParser;
class JobExport extends PexcelParser {
    public $jobExport;
    public function collection()
    {
        return $this->jobExport;
    }

    public function exportJobs($items = []) {

        $temp = realpath(public_path('/files/1/1-pexcels/thong-ke-viec-lam.xls'));

        $columns =  ['A' => 'A', 'B' => 'B', 'C' => 'C' , 'D' => 'D', 'E' => 'E', 'F' => 'F'];

        $fromrow = 2;

        $data = [
            '0' => [
                'A' => 'a',
                'B' => 'b',
                'C' => 'c',
                'D' => 'd',
                'E' => 'e',
                'f' => 'f',
            ],
            '1' => [
                'A' => 'a',
                'B' => 'b',
                'C' => 'c',
                'D' => 'd',
                'E' => 'e',
                'f' => 'f',
            ]
        ];

        return $this->download('test.xlsx');

    }
}
