<?php

namespace Foostart\Pexcel\Helper;

use App\Invoice;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Files\LocalTemporaryFile;

class CourseExportTemplate implements WithEvents {

    public $items;
    public $courseName;
    public $course;
    public $counterUnCompany;

    public $ids;

    public function __constructor() {
        $this->ids = [];
    }

    /**
     * ref: https://github.com/SpartnerNL/Laravel-Excel/issues/2068
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function(BeforeWriting $event) {
                $templateFile = new LocalTemporaryFile(storage_path('app/public/course_export_template.xlsx'));
                $event->writer->reopen($templateFile, Excel::XLSX);
                $sheet = $event->writer->getSheetByIndex(1);

                $this->populateSheet($sheet);

                $event->writer->getSheetByIndex(1)->export($event->getConcernable()); // call the export on the first sheet

                return $event->getWriter()->getSheetByIndex(0);
            },
        ];
    }

    private function populateSheet(&$sheet){

        $rows = [
            'mssv' => 'B',
            'full_name' => 'C',
            'phone' => 'F',
            'class' => 'G',
            'company' => 'H',
            'instructor' => 'L',
        ];
        $index = 14;
        foreach ($this->items as $item) {

            $sheet->setCellValue($rows['mssv'].$index, $item['user_name']);
            $sheet->setCellValue($rows['full_name'].$index, $item['first_name'] . ' ' . $item['last_name']);
            $sheet->setCellValue($rows['phone'].$index, @$item['student_phone']);
            $sheet->setCellValue($rows['class'].$index, @$item['student_class']);

            $company = @$item['company_name'] . PHP_EOL  . PHP_EOL .
                "Địa chỉ: " . @$item['company_address'] . PHP_EOL . PHP_EOL .
                "Số điện thoại: " . @$item['company_phone'];
            $sheet->setCellValue($rows['company'].$index,$company);

            $in = @$item['company_instructor'] . PHP_EOL . PHP_EOL .
                "Số điện thoại: ". @$item['company_instructor_phone'];
            $sheet->setCellValue($rows['instructor'].$index, $in);

            $this->getCourseYear($item['user_name']);

            $index++;
        }
        sort($this->ids);
        $years = implode(', ', $this->ids);
        $sheet->setCellValue('D3', $years);

        $courseInfo = $this->getCourseInfo($this->course);
        $sheet->setCellValue('D4', $courseInfo['start']);
        $sheet->setCellValue('D5', $courseInfo['end']);
        $sheet->setCellValue('D6', $courseInfo['year_start'] . ' - ' . $courseInfo['year_end']);
        $sheet->setCellValue('D7', $courseInfo['hk']);
    }

    public function getCourseYear($string) {
        $yr = (int)substr($string, 0, 2);
        $this->ids[$yr] = $yr;
    }

    public function getCourseInfo($course) {
        $start = $course['course_start_date'];
        $end = $course['course_end_date'];
        $year_start = (int)substr($course['course_start_date'], -4);
        $year_end = $year_start + 1;
        $month = (int)substr($year_start, -7, 2);

        $courseInfo = [
          'start' => $start,
          'end' => $end,
          'year_start' => $year_start,
          'year_end' => $year_end,
          'month' => $month,
          'hk' => $month > 9 ? 'I':'II'
        ];
        return $courseInfo;
    }

}
