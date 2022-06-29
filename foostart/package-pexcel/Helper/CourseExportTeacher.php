<?php

namespace Foostart\Pexcel\Helper;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class CourseExportTeacher implements FromCollection {

    public $course;
    public $view;
    public $courseName;
    public $counterUnCompany;

    public $ids;



    public function collection()
    {
        $this->ids = join(",",$this->ids);
        $sql ="
                    SELECT *, count(*)
                    FROM (
                        SELECT
                            classes_users.`course_id`,
                            company_name,
                            company_instructor_phone,
                            CONCAT_WS('\n', company_address, company_phone) as company_address
                        FROM `classes_users`
                        INNER JOIN `internship` ON `internship`.user_id = `classes_users`.user_id
                        WHERE
                              (classes_users.`course_id`  IN (" . $this->ids . "))
                        GROUP BY internship.`user_id`, classes_users.`course_id`
                        ORDER BY classes_users.`course_id`
                    ) AS company_info
                    GROUP BY company_info.company_instructor_phone
                    ORDER BY company_info.course_id;
                ";


        $data = DB::select(DB::raw(
                $sql
                ));

        return new Collection($data);
    }

}
